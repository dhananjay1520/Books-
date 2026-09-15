<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library(['form_validation','session','upload']);
        $this->load->helper(['url','form']);
        $this->load->model('User_model');

        if (!$this->session->userdata('login') || !$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $user_id = (int)$this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        if (!$data['user']) {
            $this->session->sess_destroy();
            redirect('auth/login');
        }
        $data['page_title'] = 'My Profile';
        $this->load->view('partials/navbar', $data);
        $this->load->view('profile/profile', $data);
        $this->load->view('partials/footer');
    }

    public function upload_image() {
        $user_id = (int)$this->session->userdata('user_id');
        $upload_path = FCPATH . 'uploads/profile/';
        if (!is_dir($upload_path) && !mkdir($upload_path, 0755, TRUE)) {
            return $this->json(['status'=>'error','message'=>'Profile upload folder could not be created.']);
        }

        $config = [
            'upload_path'      => $upload_path,
            'allowed_types'    => 'jpg|jpeg|png|webp',
            'max_size'        => 2048,
            'encrypt_name'     => TRUE,
            'detect_mime'      => TRUE,
            'mod_mime_fix'     => TRUE,
            'remove_spaces'    => TRUE
        ];
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('profile_image')) {
            return $this->json(['status'=>'error','message'=>strip_tags($this->upload->display_errors('', ''))]);
        }

        $uploaded = $this->upload->data();
        $new_image = $uploaded['file_name'];
        $user = $this->User_model->get_user_by_id($user_id);

        if (!$this->User_model->update_profile_image($user_id, $new_image)) {
            @unlink($upload_path . $new_image);
            return $this->json(['status'=>'error','message'=>'Profile image could not be saved.']);
        }

        if ($user && !empty($user->image) && is_file($upload_path . $user->image)) {
            @unlink($upload_path . $user->image);
        }

        $this->session->set_userdata('image', $new_image);
        $this->json([
            'status'=>'success',
            'message'=>'Profile photo updated successfully.',
            'image_url'=>base_url('uploads/profile/' . rawurlencode($new_image))
        ]);
    }

    public function update_account() {
        $user_id = (int)$this->session->userdata('user_id');
        $user = $this->User_model->get_user_by_id($user_id);
        if (!$user) return $this->json(['status'=>'error','message'=>'Account not found.']);

        $name = trim((string)$this->input->post('name', TRUE));
        $email = strtolower(trim((string)$this->input->post('email', TRUE)));
        $current = (string)$this->input->post('current_password', FALSE);
        $new = (string)$this->input->post('new_password', FALSE);
        $confirm = (string)$this->input->post('confirm_password', FALSE);

        if ($name === '') return $this->json(['status'=>'error','message'=>'Please enter your name.']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return $this->json(['status'=>'error','message'=>'Please enter a valid email address.']);
        if ($this->User_model->get_user_by_email_except_id($email, $user_id)) return $this->json(['status'=>'error','message'=>'This email is already registered with another account.']);

        $change_password = ($current !== '' || $new !== '' || $confirm !== '');
        if ($change_password) {
            if ($current === '') return $this->json(['status'=>'error','message'=>'Current password is required to change your password.']);
            if ($new === '') return $this->json(['status'=>'error','message'=>'Please enter a new password.']);
            if (strlen($new) < 6) return $this->json(['status'=>'error','message'=>'New password must be at least 6 characters.']);
            if ($new !== $confirm) return $this->json(['status'=>'error','message'=>'New password and confirm password do not match.']);
            if (!password_verify($current, $user->password)) return $this->json(['status'=>'error','message'=>'Current password is incorrect.']);
            if (password_verify($new, $user->password)) return $this->json(['status'=>'error','message'=>'New password cannot be the same as your current password.']);
        }

        $profile_data = ['name'=>$name,'email'=>$email];
        foreach (['mobile','address','city','state','country','pincode'] as $field) {
            $value = $this->input->post($field, TRUE);
            if ($value !== NULL) $profile_data[$field] = trim((string)$value);
        }

        $new_image = '';
        if (!empty($_FILES['profile_image']['name'])) {
            $upload_path = FCPATH . 'uploads/profile/';
            if (!is_dir($upload_path) && !mkdir($upload_path, 0755, TRUE)) return $this->json(['status'=>'error','message'=>'Profile upload folder could not be created.']);
            $config = ['upload_path'=>$upload_path,'allowed_types'=>'jpg|jpeg|png|webp','max_size'=>2048,'encrypt_name'=>TRUE,'detect_mime'=>TRUE,'mod_mime_fix'=>TRUE,'remove_spaces'=>TRUE];
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('profile_image')) return $this->json(['status'=>'error','message'=>strip_tags($this->upload->display_errors('', ''))]);
            $new_image = $this->upload->data('file_name');
            $profile_data['image'] = $new_image;
        }

        $this->db->trans_start();
        $this->User_model->update_profile($user_id, $profile_data);
        if ($change_password) $this->User_model->update_password($user_id, password_hash($new, PASSWORD_DEFAULT));
        $this->db->trans_complete();

        if (!$this->db->trans_status()) {
            if ($new_image) @unlink(FCPATH.'uploads/profile/'.$new_image);
            return $this->json(['status'=>'error','message'=>'Unable to save profile changes.']);
        }

        if ($new_image && !empty($user->image) && is_file(FCPATH.'uploads/profile/'.$user->image)) @unlink(FCPATH.'uploads/profile/'.$user->image);
        $session = ['name'=>$name,'email'=>$email]; if ($new_image) $session['image']=$new_image; $this->session->set_userdata($session);
        $response=['status'=>'success','message'=>$change_password?'Profile, photo and password updated successfully.':'Profile details saved successfully.'];
        if ($new_image) $response['image_url']=base_url('uploads/profile/'.$new_image);
        $this->json($response);
    }

    private function json($payload) {
        $this->output->set_content_type('application/json')->set_output(json_encode($payload));
    }
}
