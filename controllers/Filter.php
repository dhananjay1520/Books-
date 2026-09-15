<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filter extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Filter_model');
        $this->load->helper(array('url', 'security', 'product'));
        $this->load->library('session');
        $this->load->model('Product_model');
    }

    public function index()
    {
        $category = trim((string)$this->input->get('category_slug'));
        $min_price = $this->input->get('min_price');
        $max_price = $this->input->get('max_price');

        $min_price = ($min_price !== '' && is_numeric($min_price)) ? (float)$min_price : null;
        $max_price = ($max_price !== '' && is_numeric($max_price)) ? (float)$max_price : null;

        $wishlist_ids = $this->session->userdata('wishlist_ids');
        if (!is_array($wishlist_ids)) $wishlist_ids = array();
        $wishlist_ids = array_flip(array_map('intval', $wishlist_ids));
        $cartCount = 0;
        $userId = (int)$this->session->userdata('user_id');
        if ($userId) $cartCount = $this->Product_model->get_cart_count($userId);
        $data = array(
            'category_slug' => $category,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'categories' => $this->Filter_model->categories(),
            'books' => $this->Filter_model->books($category, $min_price, $max_price),
            'cartCount' => $cartCount,
            'wishlistCount' => count($wishlist_ids),
            'wishlistStatus' => $wishlist_ids
        );

        $this->load->view('partials/navbar', $data);
        $this->load->view('filter/index', $data);
        $this->load->view('partials/footer');
    }
}
