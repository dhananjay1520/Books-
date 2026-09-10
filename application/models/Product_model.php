<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Product_model
|--------------------------------------------------------------------------
| Yahan wo saare DB queries hain jo pehle index.php aur search.php ke
| andar seedha PDO se likhe hue the. Ab controllers (Home.php / Product.php)
| in methods ko call karenge, koi bhi SQL view ya controller mein nahi hoga.
*/

class Product_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // index.php me: "SELECT * FROM products"
    public function get_all_products() {
        $query = $this->db->get('products');
        return $query->result_array();
    }

    // search.php me: exact match / starts-with / contains search
    public function search_products($searchQuery) {
        if (empty($searchQuery)) {
            return [];
        }

        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('pr_name', $searchQuery);
        $this->db->or_like('pr_name', $searchQuery, 'after');   // starts with
        $this->db->or_like('pr_name', $searchQuery, 'both');    // contains
        $this->db->order_by('pr_name', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }

    // index.php aur search.php dono me: logged-in user ka cart count
    public function get_cart_count($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->count_all_results('add_to_cart');
    }

    // search.php me: check karna ki ye product already user ke cart me hai ya nahi
    public function is_in_cart($user_id, $product_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('add_to_cart');
        return $query->row_array(); // false jaisa hoga agar nahi mila
    }

    // best_seller.php me: "SELECT * FROM products WHERE is_bestseller = 1 LIMIT 5"
    public function get_bestsellers($limit = 5) {
        $this->db->where('is_bestseller', 1);
        $this->db->limit($limit);
        $query = $this->db->get('products');
        return $query->result_array();
    }

    // new_arrivals.php me: "SELECT * FROM products WHERE is_newarrival = 1 LIMIT 5"
    public function get_new_arrivals($limit = 5) {
        $this->db->where('is_newarrival', 1);
        $this->db->limit($limit);
        $query = $this->db->get('products');
        return $query->result_array();
    }

    // category.php me: category_slug + min_price + max_price filter
    public function get_products_by_category($category_slug = '', $min_price = '', $max_price = '') {
        if (!empty($category_slug)) {
            $this->db->where('pr_cate', $category_slug);
        }
        if (!empty($min_price)) {
            $this->db->where('pr_price >=', $min_price);
        }
        if (!empty($max_price)) {
            $this->db->where('pr_price <=', $max_price);
        }
        $query = $this->db->get('products');
        return $query->result_array();
    }

    // Category filter dropdown ke liye: DB mein jitni distinct categories
    // hain wo hi return karo (hardcoded list ki jagah)
    public function get_distinct_categories() {
        $this->db->select('pr_cate');
        $this->db->distinct();
        $this->db->where('pr_cate IS NOT NULL');
        $this->db->where('pr_cate !=', '');
        $this->db->order_by('pr_cate', 'ASC');
        $query = $this->db->get('products');
        return $query->result_array();
    }

    // product_details.php me: single product lookup by id
    public function get_product_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('products');
        return $query->row_array(); // false agar nahi mila
    }
}
