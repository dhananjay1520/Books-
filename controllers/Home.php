<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Home Controller
|--------------------------------------------------------------------------
| Pehle ye sab logic seedha index.php ke top par likha hua tha
| (session_start, DB query, cart count). Ab yahan controller me hai,
| aur view ('home/index') ko sirf clean $data array milta hai.
*/

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['url', 'product']);
        $this->load->library('session');
        $this->load->model('Product_model');
    }

    public function index() {
        $data['loggedIn']  = (bool) $this->session->userdata('login');
        $data['cartCount'] = 0;

        if ($data['loggedIn']) {
            $data['name'] = $this->session->userdata('name');
        }

        $user_id = $this->session->userdata('user_id');
        $data['user_id'] = $user_id;

        // products fetch
        $data['products']     = $this->Product_model->get_all_products();
        $data['bestsellers']  = $this->Product_model->get_bestsellers();
        $data['new_arrivals'] = $this->Product_model->get_new_arrivals();

        // cart count for logged-in user
        if ($data['loggedIn'] && $user_id) {
            $data['cartCount'] = $this->Product_model->get_cart_count($user_id);
        }

        // har section ke products ke liye cart-status map bana do,
        // taaki view me dobara DB call na karni pade
        $data['cartStatusBestsellers']  = $this->build_cart_status($data['bestsellers'], $user_id);
        $data['cartStatusNewArrivals']  = $this->build_cart_status($data['new_arrivals'], $user_id);
        $wish_ids = $this->session->userdata('wishlist_ids');
        if (!is_array($wish_ids)) $wish_ids = array();
        $wish_ids = array_flip(array_map('intval', $wish_ids));
        $data['wishlistStatusBestsellers'] = $this->build_wishlist_status($data['bestsellers'], $wish_ids);
        $data['wishlistStatusNewArrivals'] = $this->build_wishlist_status($data['new_arrivals'], $wish_ids);

        // navbar/footer partials bhi yahin se pass ho jayenge
        $this->load->view('partials/navbar', $data);
        $this->load->view('home/index', $data);
        $this->load->view('partials/footer');
    }

    // helper: given a product list + user_id, build [product_id => bool] cart map
    private function build_cart_status($products, $user_id) {
        $status = [];
        foreach ($products as $product) {
            $status[$product['id']] = $user_id
                ? (bool) $this->Product_model->is_in_cart($user_id, $product['id'])
                : false;
        }
        return $status;
    }

    // helper: given a product list + flipped wishlist-id map, build [product_id => bool] wishlist map
    private function build_wishlist_status($products, $wish_ids) {
        $status = [];
        foreach ($products as $product) {
            $status[$product['id']] = isset($wish_ids[$product['id']]);
        }
        return $status;
    }
}
