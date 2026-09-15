<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rent extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('session');
        $this->load->helper(array('url','form','security','product'));
    }

    private function require_login()
    {
        $id = (int)$this->session->userdata('user_id');
        if (!$id) { redirect('auth/login'); exit; }
        return $id;
    }

    public function index($id = null)
    {
        $user_id = $this->require_login();
        $id = $id ?: (int)$this->input->get('id');
        $product = $id ? $this->Product_model->get_product_by_id((int)$id) : null;
        if (!$product) show_404();

        $data = array(
            'product' => $product,
            'cartCount' => $this->Product_model->get_cart_count($user_id),
            'title' => 'Rent '.($product['pr_name'] ?? 'Book')
        );
        $this->load->view('partials/navbar', $data);
        $this->load->view('rent/index', $data);
        $this->load->view('partials/footer');
    }

    public function save()
    {
        $user_id = $this->require_login();
        $product_id = (int)$this->input->post('product_id');
        $start = trim((string)$this->input->post('start_date'));
        $end = trim((string)$this->input->post('end_date'));
        $product = $this->Product_model->get_product_by_id($product_id);

        if (!$product || !$start || !$end) {
            redirect('rent/'.$product_id);
            return;
        }

        $start_ts = strtotime($start);
        $end_ts = strtotime($end);
        if (!$start_ts || !$end_ts || $end_ts < $start_ts || $start < date('Y-m-d')) {
            redirect('rent/'.$product_id);
            return;
        }

        $days = max(1, (int)floor(($end_ts - $start_ts) / 86400) + 1);
        $total = (float)$product['pr_price'] * $days;

        $this->db->insert('rent', array(
            'user_id' => $user_id,
            'book_name' => $product['pr_name'],
            'book_image' => $product['image'],
            'start_date' => date('Y-m-d', $start_ts),
            'end_date' => date('Y-m-d', $end_ts),
            'total_rent' => $total
        ));
        redirect('cart');
    }
}
