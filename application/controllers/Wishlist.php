<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlist extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url', 'security'));
        $this->load->model('Product_model');
    }

    private function ids()
    {
        $ids = $this->session->userdata('wishlist_ids');
        if (!is_array($ids)) $ids = array();
        $clean = array();
        foreach ($ids as $id) {
            $id = (int)$id;
            if ($id > 0) $clean[$id] = $id;
        }
        return array_values($clean);
    }

    private function save_ids($ids)
    {
        $clean = array();
        foreach ((array)$ids as $id) {
            $id = (int)$id;
            if ($id > 0) $clean[$id] = $id;
        }
        $this->session->set_userdata('wishlist_ids', array_values($clean));
        return array_values($clean);
    }

    private function response($data)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function toggle()
    {
        $id = (int)$this->input->post('product_id');
        $product = $this->Product_model->get_product_by_id($id);
        if (!$product) {
            $this->response(array('success'=>false, 'message'=>'Book not found.'));
            return;
        }

        $ids = $this->ids();
        $key = array_search($id, $ids, true);
        if ($key !== false) {
            unset($ids[$key]);
            $added = false;
            $message = 'Removed from wishlist.';
        } else {
            $ids[] = $id;
            $added = true;
            $message = 'Added to wishlist.';
        }
        $ids = $this->save_ids($ids);

        $this->response(array(
            'success' => true,
            'added' => $added,
            'message' => $message,
            'wishlist_count' => count($ids),
            'product_id' => $id
        ));
    }

    public function index()
    {
        $ids = $this->ids();
        $products = $this->Product_model->get_products_by_ids($ids);
        $cartCount = 0;
        $userId = (int)$this->session->userdata('user_id');
        if ($userId) $cartCount = $this->Product_model->get_cart_count($userId);

        $data = array(
            'products' => $products,
            'wishlistCount' => count($ids),
            'cartCount' => $cartCount,
            'loggedIn' => (bool)$this->session->userdata('login')
        );

        $this->load->view('partials/navbar', $data);
        $this->load->view('wishlist/index', $data);
        $this->load->view('partials/footer');
    }

    public function remove($id = 0)
    {
        $ids = $this->ids();
        $id = (int)$id;
        $key = array_search($id, $ids, true);
        if ($key !== false) unset($ids[$key]);
        $this->save_ids($ids);
        redirect('wishlist');
    }

    public function clear()
    {
        $this->save_ids(array());
        redirect('wishlist');
    }
}
