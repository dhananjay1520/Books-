<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Category Controller
|--------------------------------------------------------------------------
| category.php ke andar jo session/DB/filter logic tha, wo sab yahan hai.
| View sirf HTML render karta hai.
*/

class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Product_model');
    }

    // URL: category?category_slug=...&min_price=...&max_price=... (GET)
    public function index() {
        $data['loggedIn']  = (bool) $this->session->userdata('login');
        $data['cartCount'] = 0;

        if ($data['loggedIn']) {
            $data['name'] = $this->session->userdata('name');
        }

        $category_slug = $this->input->get('category_slug') ? $this->input->get('category_slug') : '';
        $min_price      = $this->input->get('min_price') ? $this->input->get('min_price') : '';
        $max_price      = $this->input->get('max_price') ? $this->input->get('max_price') : '';

        $data['category_slug'] = $category_slug;
        $data['min_price']     = $min_price;
        $data['max_price']     = $max_price;

        $data['products'] = $this->Product_model->get_products_by_category($category_slug, $min_price, $max_price);

        $user_id = $this->session->userdata('user_id');

        if ($data['loggedIn'] && $user_id) {
            $data['cartCount'] = $this->Product_model->get_cart_count($user_id);
        }

        $cartStatus = [];
        foreach ($data['products'] as $product) {
            $cartStatus[$product['id']] = $user_id
                ? (bool) $this->Product_model->is_in_cart($user_id, $product['id'])
                : false;
        }
        $data['cartStatus'] = $cartStatus;

        $this->load->view('partials/navbar', $data);
        $this->load->view('category/index', $data);
        $this->load->view('partials/footer');
    }
}
