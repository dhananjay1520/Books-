<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Product Controller
|--------------------------------------------------------------------------
| search.php ke andar jo PHP logic (session check, DB query, cart check)
| tha, wo sab yahan aa gaya hai. View sirf HTML render karta hai.
*/

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Product_model');
    }

    // URL: product/search?query=... (GET)
    public function search() {
        $data['loggedIn']  = (bool) $this->session->userdata('login');
        $data['cartCount'] = 0;

        if ($data['loggedIn']) {
            $data['name'] = $this->session->userdata('name');
        }

        $searchQuery = $this->input->get('query') ? trim($this->input->get('query')) : '';
        $data['searchQuery'] = $searchQuery;
        $data['products'] = $this->Product_model->search_products($searchQuery);

        $user_id = $this->session->userdata('user_id');

        if ($data['loggedIn'] && $user_id) {
            $data['cartCount'] = $this->Product_model->get_cart_count($user_id);
        }

        // har product ke liye check kar lo ki cart me hai ya nahi,
        // taaki view ke andar dobara DB call na karni pade
        $cartStatus = [];
        foreach ($data['products'] as $product) {
            if ($user_id) {
                $cartStatus[$product['id']] = (bool) $this->Product_model->is_in_cart($user_id, $product['id']);
            } else {
                $cartStatus[$product['id']] = false;
            }
        }
        $data['cartStatus'] = $cartStatus;

        $this->load->view('partials/navbar', $data);
        $this->load->view('product/search_results', $data);
        $this->load->view('partials/footer');
    }

    // URL: product/details/{id}
    public function details($id = null) {
        if (empty($id)) {
            show_404(); // invalid/missing product id
            return;
        }

        $data['loggedIn']  = (bool) $this->session->userdata('login');
        $data['cartCount'] = 0;

        if ($data['loggedIn']) {
            $data['name'] = $this->session->userdata('name');
        }

        $data['product'] = $this->Product_model->get_product_by_id($id);

        if (!$data['product']) {
            show_404(); // product not found
            return;
        }

        $user_id = $this->session->userdata('user_id');

        if ($data['loggedIn'] && $user_id) {
            $data['cartCount'] = $this->Product_model->get_cart_count($user_id);
        }

        $this->load->view('partials/navbar', $data);
        $this->load->view('product/details', $data);
        $this->load->view('partials/footer');
    }
}
