<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filter_model extends CI_Model
{
    public function categories()
    {
        // Change this list to a database-driven category table if your project has one.
        return array('Historical-Fiction', 'Biography', 'Self-Help', 'Fantasy', 'Business');
    }

    public function books($category = '', $min = null, $max = null)
    {
        $this->db->select('id, pr_name, image, pr_price');
        $this->db->from('products');

        // The uploaded filter page exposes these category values. If your products
        // table uses another category column, change `category` below.
        if ($category !== '') {
            $this->db->where('category', $category);
        }
        if ($min !== null) {
            $this->db->where('pr_price >=', $min);
        }
        if ($max !== null) {
            $this->db->where('pr_price <=', $max);
        }

        return $this->db->order_by('id', 'DESC')->get()->result_array();
    }
}
