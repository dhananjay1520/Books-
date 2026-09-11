<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cart_model');
        $this->load->helper(array('url', 'security'));
        $this->load->library('session');
        $this->config->load('bookstore');
    }

    private function user_id()
    {
        $id = (int)$this->session->userdata('user_id');
        if (!$id) redirect('auth/login');
        return $id;
    }

    public function index()
    {
        $user_id = $this->user_id();
        $items = $this->Cart_model->get_items($user_id);
        $total = 0;

        foreach ($items as $item) {
            $total += (float)$item['price'] * (int)$item['quantity'];
        }

        $data = array(
            'items' => $items,
            'total' => $total,
            'count' => count($items),
            'cartCount' => $this->Cart_model->get_cart_count($user_id),
            'paypal_client_id' => $this->config->item('paypal_client_id'),
            'currency' => $this->config->item('currency')
        );

        $this->load->view('partials/navbar', $data);
        $this->load->view('checkout/index', $data);
        $this->load->view('partials/footer');
    }

    public function success()
    {
        $user_id = $this->user_id();
        $order_id = trim((string)$this->input->get('paymentId'));
        $data = array(
            'order_id' => $order_id,
            'cartCount' => $this->Cart_model->get_cart_count($user_id)
        );
        $this->load->view('partials/navbar', $data);
        $this->load->view('checkout/success', $data);
        $this->load->view('partials/footer');
    }
}
