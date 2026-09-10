<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(['session', 'form_validation', 'upload']);
        $this->load->helper(['url', 'form', 'file', 'product']);
        $this->load->model('Admin_model');
    }

    private function require_login() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
    }

    private function render($view, $data = []) {
        $data['admin_username'] = (string)$this->session->userdata('admin_username');
        $data['admin_email'] = (string)$this->session->userdata('admin_email');
        $this->load->view('admin/layout/header', $data);
        $this->load->view($view, $data);
        $this->load->view('admin/layout/footer', $data);
    }

    public function index() {
        $this->require_login();
        $data['stats'] = $this->Admin_model->get_dashboard_stats();
        $data['inventory_summary'] = $this->Admin_model->get_inventory_summary();
        $data['low_stock_products'] = $this->Admin_model->get_low_stock_products(6);
        $data['recent_users'] = $this->Admin_model->get_recent_users(6);
        $data['recent_messages'] = $this->Admin_model->get_messages(5);
        $data['categories_count'] = count($this->Admin_model->get_categories());
        $this->render('admin/dashboard', $data);
    }

    public function login() {
        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin');
        }
        $data['error'] = '';
        if ($this->input->method(TRUE) === 'POST') {
            $username = trim($this->input->post('username', TRUE));
            $password = (string)$this->input->post('password');
            $admin = $this->Admin_model->get_admin_by_username($username);

            // Supports existing plain-text admin password and upgrades it to a hash after login.
            $valid = $admin && ($password === $admin->password || password_verify($password, $admin->password));
            if ($valid) {
                if (!password_needs_rehash($admin->password, PASSWORD_DEFAULT)) {
                    // Keep the existing hash.
                } elseif ($password === $admin->password) {
                    $this->db->where('id', $admin->id)->update('admin_login', ['password' => password_hash($password, PASSWORD_DEFAULT)]);
                }
                $this->session->set_userdata([
                    'admin_logged_in' => TRUE,
                    'admin_id' => $admin->id,
                    'admin_username' => !empty($admin->name) ? $admin->name : $admin->username,
                    'admin_image' => !empty($admin->image) ? $admin->image : '',
                    'admin_email' => (string)($admin->email ?? '')
                ]);
                redirect('admin');
            }
            $data['error'] = 'Invalid username or password.';
        }
        $this->load->view('admin/auth/login', $data);
    }

    public function logout() {
        $this->session->unset_userdata(['admin_logged_in', 'admin_id', 'admin_username', 'admin_image']);
        redirect('admin/login');
    }

    public function profile() {
        $this->require_login();
        $admin = $this->Admin_model->get_admin_by_id((int)$this->session->userdata('admin_id'));
        if (!$admin) {
            $this->logout();
            return;
        }
        $this->render('admin/profile/index', ['admin' => $admin]);
    }

    public function upload_admin_image() {
        $this->require_login();
        $admin_id = (int)$this->session->userdata('admin_id');
        $admin = $this->Admin_model->get_admin_by_id($admin_id);
        if (!$admin) return $this->json_response(['status'=>'error','message'=>'Administrator account not found.']);

        $upload_dir = FCPATH . 'uploads/admin_profile/';
        if (!is_dir($upload_dir) && !mkdir($upload_dir, 0755, TRUE)) {
            return $this->json_response(['status'=>'error','message'=>'Profile upload folder could not be created.']);
        }
        $config = [
            'upload_path'=>$upload_dir,
            'allowed_types'=>'jpg|jpeg|png|webp',
            'max_size'=>2048,
            'encrypt_name'=>TRUE,
            'detect_mime'=>TRUE,
            'mod_mime_fix'=>TRUE,
            'remove_spaces'=>TRUE
        ];
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('profile_image')) {
            return $this->json_response(['status'=>'error','message'=>strip_tags($this->upload->display_errors('', ''))]);
        }
        $file = $this->upload->data('file_name');
        $path = 'uploads/admin_profile/' . $file;
        if (!$this->Admin_model->update_admin($admin_id, ['image'=>$path])) {
            @unlink($upload_dir . $file);
            return $this->json_response(['status'=>'error','message'=>'Profile photo could not be saved.']);
        }
        if (!empty($admin->image)) {
            $old = FCPATH . ltrim($admin->image, '/');
            if (is_file($old) && strpos($admin->image, 'uploads/admin_profile/') === 0) @unlink($old);
        }
        $this->session->set_userdata('admin_image', $path);
        return $this->json_response(['status'=>'success','message'=>'Profile photo updated successfully.','image_url'=>base_url($path)]);
    }

    public function update_profile() {
        $this->require_login();
        $admin_id = (int)$this->session->userdata('admin_id');
        $admin = $this->Admin_model->get_admin_by_id($admin_id);
        if (!$admin) return $this->json_response(['status'=>'error','message'=>'Administrator account not found.']);

        $name = trim((string)$this->input->post('name', TRUE));
        $email = strtolower(trim((string)$this->input->post('email', TRUE)));
        $current = (string)$this->input->post('current_password', FALSE);
        $new = (string)$this->input->post('new_password', FALSE);
        $confirm = (string)$this->input->post('confirm_password', FALSE);

        if ($name === '') return $this->json_response(['status'=>'error','message'=>'Please enter your name.']);
        if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->json_response(['status'=>'error','message'=>'Please enter a valid email address.']);
        }

        $change_password = ($current !== '' || $new !== '' || $confirm !== '');
        $password_info = password_get_info((string)$admin->password);
        $password_ok = ($password_info['algo'] !== 0) ? password_verify($current, $admin->password) : ($current === $admin->password);

        if ($change_password) {
            if ($current === '') return $this->json_response(['status'=>'error','message'=>'Current password is required.']);
            if ($new === '') return $this->json_response(['status'=>'error','message'=>'Please enter a new password.']);
            if (strlen($new) < 6) return $this->json_response(['status'=>'error','message'=>'New password must be at least 6 characters.']);
            if ($new !== $confirm) return $this->json_response(['status'=>'error','message'=>'New password and confirmation do not match.']);
            if (!$password_ok) return $this->json_response(['status'=>'error','message'=>'Current password is incorrect.']);
            if ($password_info['algo'] !== 0 && password_verify($new, $admin->password)) {
                return $this->json_response(['status'=>'error','message'=>'New password cannot be the same as your current password.']);
            }
        }

        $data = ['name'=>$name, 'email'=>$email];
        if ($change_password) $data['password'] = password_hash($new, PASSWORD_DEFAULT);

        // Profile photo is saved only when the user presses "Save changes".
        $new_image_path = '';
        if (!empty($_FILES['profile_image']['name'])) {
            $upload_dir = FCPATH . 'uploads/admin_profile/';
            if (!is_dir($upload_dir) && !mkdir($upload_dir, 0755, TRUE)) {
                return $this->json_response(['status'=>'error','message'=>'Profile upload folder could not be created.']);
            }
            $config = [
                'upload_path'=>$upload_dir,
                'allowed_types'=>'jpg|jpeg|png|webp',
                'max_size'=>2048,
                'encrypt_name'=>TRUE,
                'detect_mime'=>TRUE,
                'mod_mime_fix'=>TRUE,
                'remove_spaces'=>TRUE
            ];
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('profile_image')) {
                return $this->json_response(['status'=>'error','message'=>strip_tags($this->upload->display_errors('', ''))]);
            }
            $new_image_path = 'uploads/admin_profile/' . $this->upload->data('file_name');
            $data['image'] = $new_image_path;
        }

        if (!$this->Admin_model->update_admin($admin_id, $data)) {
            if ($new_image_path) @unlink(FCPATH . $new_image_path);
            return $this->json_response(['status'=>'error','message'=>'Unable to save profile changes.']);
        }

        if ($new_image_path && !empty($admin->image)) {
            $old = FCPATH . ltrim($admin->image, '/');
            if (is_file($old) && strpos($admin->image, 'uploads/admin_profile/') === 0) @unlink($old);
        }

        $session_data = ['admin_username'=>$name, 'admin_email'=>$email];
        if ($new_image_path) $session_data['admin_image'] = $new_image_path;
        $this->session->set_userdata($session_data);

        $payload = [
            'status'=>'success',
            'message'=>$change_password ? 'Profile and password updated successfully.' : 'Profile details updated successfully.'
        ];
        if ($new_image_path) $payload['image_url'] = base_url($new_image_path);
        return $this->json_response($payload);
    }

    public function orders() {
        $this->require_login();
        $data['orders_available'] = $this->db->table_exists('orders');
        $data['orders'] = $data['orders_available'] ? $this->Admin_model->get_orders() : [];
        $this->render('admin/orders/index', $data);
    }

    public function reports() {
        $this->require_login();
        $data['stats'] = $this->Admin_model->get_dashboard_stats();
        $data['categories'] = $this->Admin_model->get_categories();
        $data['inventory'] = $this->Admin_model->get_inventory();
        $data['inventory_summary'] = $this->Admin_model->get_inventory_summary();
        $low = 0; $out = 0;
        foreach ($data['inventory'] as $row) {
            $qty=(int)$row->pr_qty;
            if($qty<=0) $out++; elseif($qty<=5) $low++;
        }
        $data['out_of_stock']=$out; $data['low_stock']=$low;
        $this->render('admin/reports/index', $data);
    }

    private function json_response($payload) {
        return $this->output->set_content_type('application/json')->set_output(json_encode($payload));
    }

    public function users() {
        $this->require_login();
        $data['users'] = $this->Admin_model->get_users();
        $this->render('admin/users/index', $data);
    }

    public function edit_user($id = 0) {
        $this->require_login();
        $user = $this->Admin_model->get_user($id);
        if (!$user) show_404();

        if ($this->input->method(TRUE) === 'POST') {
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('mobile', 'Mobile', 'trim');
            if ($this->form_validation->run()) {
                $data = [
                    'name' => $this->input->post('name', TRUE),
                    'email' => $this->input->post('email', TRUE),
                    'mobile' => $this->input->post('mobile', TRUE),
                    'address' => $this->input->post('address', TRUE),
                    'city' => $this->input->post('city', TRUE),
                    'state' => $this->input->post('state', TRUE),
                    'country' => $this->input->post('country', TRUE),
                    'pincode' => $this->input->post('pincode', TRUE),
                ];
                if ($this->Admin_model->update_user($id, $data)) {
                    $this->session->set_flashdata('success', 'User updated successfully.');
                    redirect('admin/users');
                }
                $data['error'] = 'Unable to update user.';
            }
        }
        $data['user'] = $user;
        $data['error'] = isset($data['error']) ? $data['error'] : '';
        $this->render('admin/users/edit', $data);
    }

    public function delete_user($id = 0) {
        $this->require_login();
        $user = $this->Admin_model->get_user($id);
        if ($user) {
            if (!empty($user->image)) {
                $file = FCPATH . 'uploads/profile/' . basename($user->image);
                if (is_file($file)) @unlink($file);
            }
            $this->Admin_model->delete_user($id);
            $this->session->set_flashdata('success', 'User deleted successfully.');
        }
        redirect('admin/users');
    }

    public function products() {
        $this->require_login();
        $data['products'] = $this->Admin_model->get_products();
        $this->render('admin/products/index', $data);
    }

    public function add_product() {
        $this->require_login();
        if ($this->input->method(TRUE) === 'POST') {
            $this->form_validation->set_rules('pr_name', 'Product Name', 'required|trim');
            $this->form_validation->set_rules('pr_author_name', 'Author Name', 'required|trim');
            $this->form_validation->set_rules('pr_price', 'Price', 'required|numeric');
            $this->form_validation->set_rules('pr_desc', 'Description', 'required|trim');
            $this->form_validation->set_rules('pr_cate', 'Category', 'required|trim');
            $this->form_validation->set_rules('pr_qty', 'Quantity', 'required|integer');
            if ($this->form_validation->run()) {
                $image_path = '';
                if (!empty($_FILES['image']['name'])) {
                    $upload_dir = FCPATH . 'uploads/products/';
                    if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, TRUE);
                    $cfg = [
                        'upload_path' => $upload_dir,
                        'allowed_types' => 'jpg|jpeg|png|webp',
                        'max_size' => 4096,
                        'encrypt_name' => TRUE,
                        'detect_mime' => TRUE,
                        'mod_mime_fix' => TRUE
                    ];
                    $this->upload->initialize($cfg);
                    if (!$this->upload->do_upload('image')) {
                        $data['error'] = strip_tags($this->upload->display_errors());
                    } else {
                        $image_path = 'uploads/products/' . $this->upload->data('file_name');
                    }
                }
                if (!isset($data['error'])) {
                    $insert = [
                        'pr_name' => $this->input->post('pr_name', TRUE),
                        'pr_author_name' => $this->input->post('pr_author_name', TRUE),
                        'pr_price' => $this->input->post('pr_price', TRUE),
                        'pr_desc' => $this->input->post('pr_desc', TRUE),
                        'pr_cate' => $this->input->post('pr_cate', TRUE),
                        'pr_qty' => $this->input->post('pr_qty', TRUE),
                        'is_bestseller' => $this->input->post('is_bestseller') ? 1 : 0,
                        'is_newarrival' => $this->input->post('is_newarrival') ? 1 : 0,
                        'image' => $image_path
                    ];
                    if ($this->Admin_model->insert_product($insert)) {
                        $this->session->set_flashdata('success', 'Product added successfully.');
                        redirect('admin/products');
                    }
                    $data['error'] = 'Unable to add product.';
                }
            }
        }
        $this->render('admin/products/form', ['product' => NULL, 'error' => isset($data['error']) ? $data['error'] : '']);
    }

    public function edit_product($id = 0) {
        $this->require_login();
        $product = $this->Admin_model->get_product($id);
        if (!$product) show_404();
        $data['error'] = '';
        if ($this->input->method(TRUE) === 'POST') {
            $this->form_validation->set_rules('pr_name', 'Product Name', 'required|trim');
            $this->form_validation->set_rules('pr_author_name', 'Author Name', 'required|trim');
            $this->form_validation->set_rules('pr_price', 'Price', 'required|numeric');
            $this->form_validation->set_rules('pr_desc', 'Description', 'required|trim');
            $this->form_validation->set_rules('pr_cate', 'Category', 'required|trim');
            $this->form_validation->set_rules('pr_qty', 'Quantity', 'required|integer');
            if ($this->form_validation->run()) {
                $image_path = $product->image;
                if (!empty($_FILES['image']['name'])) {
                    $upload_dir = FCPATH . 'uploads/products/';
                    if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, TRUE);
                    $cfg = ['upload_path'=>$upload_dir,'allowed_types'=>'jpg|jpeg|png|webp','max_size'=>4096,'encrypt_name'=>TRUE,'detect_mime'=>TRUE,'mod_mime_fix'=>TRUE];
                    $this->upload->initialize($cfg);
                    if (!$this->upload->do_upload('image')) {
                        $data['error'] = strip_tags($this->upload->display_errors());
                    } else {
                        $new_name = $this->upload->data('file_name');
                        $image_path = 'uploads/products/' . $new_name;
                        if (!empty($product->image) && strpos($product->image, 'uploads/products/') === 0) {
                            $old = FCPATH . $product->image;
                            if (is_file($old)) @unlink($old);
                        }
                    }
                }
                if (!$data['error']) {
                    $update = [
                        'pr_name' => $this->input->post('pr_name', TRUE),
                        'pr_author_name' => $this->input->post('pr_author_name', TRUE),
                        'pr_price' => $this->input->post('pr_price', TRUE),
                        'pr_desc' => $this->input->post('pr_desc', TRUE),
                        'pr_cate' => $this->input->post('pr_cate', TRUE),
                        'pr_qty' => $this->input->post('pr_qty', TRUE),
                        'is_bestseller' => $this->input->post('is_bestseller') ? 1 : 0,
                        'is_newarrival' => $this->input->post('is_newarrival') ? 1 : 0,
                        'image' => $image_path
                    ];
                    if ($this->Admin_model->update_product($id, $update)) {
                        $this->session->set_flashdata('success', 'Product updated successfully.');
                        redirect('admin/products');
                    }
                    $data['error'] = 'Unable to update product.';
                }
            }
        }
        $data['product'] = $product;
        $this->render('admin/products/form', $data);
    }

    public function delete_product($id = 0) {
        $this->require_login();
        $product = $this->Admin_model->get_product($id);
        if ($product) {
            if (!empty($product->image) && strpos($product->image, 'uploads/products/') === 0) {
                $file = FCPATH . $product->image;
                if (is_file($file)) @unlink($file);
            }
            $this->Admin_model->delete_product($id);
            $this->session->set_flashdata('success', 'Product deleted successfully.');
        }
        redirect('admin/products');
    }

    public function ebooks() {
        $this->require_login();
        $data['ebooks'] = $this->Admin_model->get_ebooks();
        $this->render('admin/ebooks/index', $data);
    }

    public function add_ebook() {
        $this->require_login();
        $data['error'] = '';
        if ($this->input->method(TRUE) === 'POST') {
            $this->form_validation->set_rules('book_name', 'Book Name', 'required|trim');
            $this->form_validation->set_rules('author_name', 'Author Name', 'required|trim');
            if ($this->form_validation->run()) {
                $img = '';
                $pdf = '';
                $img_dir = FCPATH . 'uploads/ebooks/images/';
                $pdf_dir = FCPATH . 'uploads/ebooks/pdfs/';
                if (!is_dir($img_dir)) mkdir($img_dir, 0755, TRUE);
                if (!is_dir($pdf_dir)) mkdir($pdf_dir, 0755, TRUE);
                if (empty($_FILES['book_image']['name']) || empty($_FILES['book_pdf']['name'])) {
                    $data['error'] = 'Both book image and PDF are required.';
                } else {
                    $this->upload->initialize(['upload_path'=>$img_dir,'allowed_types'=>'jpg|jpeg|png|webp','max_size'=>4096,'encrypt_name'=>TRUE,'detect_mime'=>TRUE,'mod_mime_fix'=>TRUE]);
                    if (!$this->upload->do_upload('book_image')) {
                        $data['error'] = strip_tags($this->upload->display_errors());
                    } else {
                        $img = 'uploads/ebooks/images/' . $this->upload->data('file_name');
                    }
                    if (!$data['error']) {
                        $this->upload->initialize(['upload_path'=>$pdf_dir,'allowed_types'=>'pdf','max_size'=>10240,'encrypt_name'=>TRUE,'detect_mime'=>TRUE,'mod_mime_fix'=>TRUE]);
                        if (!$this->upload->do_upload('book_pdf')) {
                            $data['error'] = strip_tags($this->upload->display_errors());
                        } else {
                            $pdf = 'uploads/ebooks/pdfs/' . $this->upload->data('file_name');
                        }
                    }
                }
                if (!$data['error']) {
                    $ok = $this->Admin_model->insert_ebook([
                        'book_name'=>$this->input->post('book_name', TRUE),
                        'author_name'=>$this->input->post('author_name', TRUE),
                        'book_image'=>$img,
                        'book_pdf'=>$pdf
                    ]);
                    if ($ok) {
                        $this->session->set_flashdata('success', 'eBook added successfully.');
                        redirect('admin/ebooks');
                    }
                    $data['error'] = 'Unable to add eBook.';
                }
            }
        }
        $data['ebooks'] = $this->Admin_model->get_ebooks();
        $this->render('admin/ebooks/index', $data);
    }

    public function delete_ebook($id = 0) {
        $this->require_login();
        $ebook = $this->db->where('id',(int)$id)->get('ebooks')->row();
        if ($ebook) {
            foreach (['book_image','book_pdf'] as $field) {
                if (!empty($ebook->$field)) {
                    $file = FCPATH . ltrim($ebook->$field, '/');
                    if (is_file($file)) @unlink($file);
                }
            }
            $this->Admin_model->delete_ebook($id);
            $this->session->set_flashdata('success', 'eBook deleted successfully.');
        }
        redirect('admin/ebooks');
    }

    public function messages() {
        $this->require_login();
        $data['messages'] = $this->Admin_model->get_messages();
        $this->render('admin/messages/index', $data);
    }

    public function view_message($id = 0) {
        $this->require_login();
        $data['message'] = $this->Admin_model->get_message($id);
        if (!$data['message']) show_404();
        $this->render('admin/messages/view', $data);
    }
}
