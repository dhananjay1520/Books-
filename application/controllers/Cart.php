<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Cart_model', 'Product_model'));
        $this->load->helper(array('url', 'security'));
        $this->load->library('session');
    }

    private function require_login()
    {
        $id = (int)$this->session->userdata('user_id');
        if (!$id) {
            if ($this->input->is_ajax_request()) {
                $this->json(array('success' => false, 'message' => 'Please login to add books to your cart.', 'redirect' => site_url('auth/login')));
                exit;
            }
            redirect('auth/login');
        }
        return $id;
    }

    private function json($data)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function add()
    {
        $user_id = $this->require_login();
        $product_id = (int)$this->input->post('product_id');
        $quantity = max(1, (int)$this->input->post('quantity'));
        $product = $this->Product_model->get_product_by_id($product_id);

        if (!$product) {
            $this->json(array('success' => false, 'message' => 'Book not found.'));
            return;
        }

        $ok = $this->Cart_model->add_item($user_id, $product_id, $quantity);
        $this->json(array(
            'success' => (bool)$ok,
            'message' => $ok ? 'Book added to cart.' : 'Could not add the book to cart.',
            'cart_count' => $this->Cart_model->get_cart_count($user_id)
        ));
    }

    public function index()
    {
        $user_id = $this->require_login();
        $items = $this->Cart_model->get_items($user_id);
        $total = 0;
        $count = 0;

        foreach ($items as &$item) {
            $item['line_total'] = (float)$item['price'] * (int)$item['quantity'];
            $total += $item['line_total'];
            $count += (int)$item['quantity'];
        }
        unset($item);

        $data = array(
            'items' => $items,
            'total' => $total,
            'count' => $count,
            'cartCount' => $this->Cart_model->get_cart_count($user_id),
            'currency' => '₹'
        );

        $this->load->view('partials/navbar', $data);
        $this->load->view('cart/index', $data);
        $this->load->view('partials/footer');
    }

    public function update()
    {
        $user_id = $this->require_login();
        $id = (int)$this->input->post('id');
        $quantity = max(1, (int)$this->input->post('quantity'));
        $this->Cart_model->update_quantity($user_id, $id, $quantity);
        redirect('cart');
    }

    public function clear()
    {
        $user_id = $this->require_login();
        $this->Cart_model->clear_items($user_id);
        redirect('cart');
    }

    public function remove($id, $type = 'cart')
    {
        $user_id = $this->require_login();
        $type = ($type === 'rent') ? 'rent' : 'cart';
        $this->Cart_model->remove_item($user_id, (int)$id, $type);
        redirect('cart');
    }
}
