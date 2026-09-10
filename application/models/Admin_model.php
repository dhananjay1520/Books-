<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_admin_by_username($username) {
        return $this->db->where('username', $username)->get('admin_login')->row();
    }

    public function get_admin_by_id($id) {
        return $this->db->where('id', (int)$id)->get('admin_login')->row();
    }

    public function update_admin($id, $data) {
        return $this->db->where('id', (int)$id)->update('admin_login', $data);
    }

    public function get_dashboard_stats() {
        $stats = [
            'total_pending'   => 0,
            'total_completed' => 0,
            'total_orders'    => 0,
            'total_products'  => 0,
            'total_users'     => 0,
            'total_admins'    => 0,
            'total_accounts'  => 0,
            'total_messages'  => 0,
        ];

        // The current project database may not have an orders table yet.
        // Keep dashboard totals at 0 instead of throwing a DB exception.
        if ($this->db->table_exists('orders')) {
            $orders = $this->db->query("SELECT COALESCE(SUM(CASE WHEN payment_status = 'pending' THEN total_price ELSE 0 END),0) pending,
                        COALESCE(SUM(CASE WHEN payment_status = 'completed' THEN total_price ELSE 0 END),0) completed,
                        COUNT(*) total_orders FROM orders")->row();
            if ($orders) {
                $stats['total_pending'] = $orders->pending;
                $stats['total_completed'] = $orders->completed;
                $stats['total_orders'] = $orders->total_orders;
            }
        }

        $stats['total_products'] = $this->db->count_all('products');
        $stats['total_users'] = $this->db->count_all('users');
        $stats['total_admins'] = $this->db->count_all('admin_login');
        $stats['total_accounts'] = $stats['total_users'] + $stats['total_admins'];

        // The supplied message page uses contact_form_submissions.
        if ($this->db->table_exists('contact_form_submissions')) {
            $stats['total_messages'] = $this->db->count_all('contact_form_submissions');
        } elseif ($this->db->table_exists('messages')) {
            $stats['total_messages'] = $this->db->count_all('messages');
        }

        return $stats;
    }

    public function get_users() {
        return $this->db->select('id,name,email,address,mobile,city,state,country,pincode,image')
            ->from('users')->order_by('id', 'DESC')->get()->result();
    }

    public function get_user($id) {
        return $this->db->where('id', (int)$id)->get('users')->row();
    }

    public function update_user($id, $data) {
        return $this->db->where('id', (int)$id)->update('users', $data);
    }

    public function delete_user($id) {
        return $this->db->where('id', (int)$id)->delete('users');
    }

    public function get_products() {
        return $this->db->order_by('id', 'DESC')->get('products')->result();
    }

    public function get_product($id) {
        return $this->db->where('id', (int)$id)->get('products')->row();
    }

    public function insert_product($data) {
        return $this->db->insert('products', $data);
    }

    public function update_product($id, $data) {
        return $this->db->where('id', (int)$id)->update('products', $data);
    }

    public function delete_product($id) {
        return $this->db->where('id', (int)$id)->delete('products');
    }

    public function get_ebooks() {
        return $this->db->order_by('id', 'DESC')->get('ebooks')->result();
    }

    public function insert_ebook($data) {
        return $this->db->insert('ebooks', $data);
    }

    public function delete_ebook($id) {
        return $this->db->where('id', (int)$id)->delete('ebooks');
    }

    public function get_messages($limit = NULL) {
        if ($this->db->table_exists('contact_form_submissions')) {
            if ($limit !== NULL) $this->db->limit((int)$limit);
            return $this->db->order_by('id', 'DESC')->get('contact_form_submissions')->result();
        }
        if ($this->db->table_exists('messages')) {
            if ($limit !== NULL) $this->db->limit((int)$limit);
            return $this->db->order_by('id', 'DESC')->get('messages')->result();
        }
        return [];
    }

    public function get_message($id) {
        if ($this->db->table_exists('contact_form_submissions')) {
            return $this->db->where('id', (int)$id)->get('contact_form_submissions')->row();
        }
        if ($this->db->table_exists('messages')) {
            return $this->db->where('id', (int)$id)->get('messages')->row();
        }
        return false;
    }

    public function get_inventory_summary() {
        $summary = ['total_stock_units'=>0,'low_stock'=>0,'out_of_stock'=>0,'total_ebooks'=>0];
        if ($this->db->table_exists('products')) {
            $row = $this->db->select('COALESCE(SUM(pr_qty),0) AS total_stock_units', FALSE)
                ->select('COALESCE(SUM(CASE WHEN pr_qty > 0 AND pr_qty <= 5 THEN 1 ELSE 0 END),0) AS low_stock', FALSE)
                ->select('COALESCE(SUM(CASE WHEN pr_qty <= 0 THEN 1 ELSE 0 END),0) AS out_of_stock', FALSE)
                ->get('products')->row();
            if ($row) {
                $summary['total_stock_units'] = (int)$row->total_stock_units;
                $summary['low_stock'] = (int)$row->low_stock;
                $summary['out_of_stock'] = (int)$row->out_of_stock;
            }
        }
        if ($this->db->table_exists('ebooks')) $summary['total_ebooks'] = $this->db->count_all('ebooks');
        return $summary;
    }

    public function get_low_stock_products($limit = 6) {
        if (!$this->db->table_exists('products')) return [];
        return $this->db->select('id,pr_name,pr_qty,pr_cate,image')
            ->from('products')->where('pr_qty <=', 5)
            ->order_by('pr_qty', 'ASC')->order_by('id', 'DESC')
            ->limit((int)$limit)->get()->result();
    }

    public function get_recent_users($limit = 6) {
        if (!$this->db->table_exists('users')) return [];
        return $this->db->select('id,name,email,image')
            ->from('users')->order_by('id', 'DESC')->limit((int)$limit)->get()->result();
    }

    public function get_categories() {
        $rows = $this->db->select('pr_cate, COUNT(*) AS total_books')
            ->from('products')
            ->where('pr_cate IS NOT NULL', NULL, FALSE)
            ->where('pr_cate <>', '')
            ->group_by('pr_cate')
            ->order_by('total_books', 'DESC')
            ->get()->result();
        return $rows ?: [];
    }

    public function get_inventory() {
        return $this->db->select('id,pr_name,pr_author_name,pr_cate,pr_qty,image')
            ->from('products')
            ->order_by('pr_qty', 'ASC')
            ->order_by('id', 'DESC')
            ->get()->result();
    }

    public function get_orders() {
        if (!$this->db->table_exists('orders')) return [];
        return $this->db->order_by('id', 'DESC')->get('orders')->result();
    }

}

