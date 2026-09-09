<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_user_by_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return ($query->num_rows() == 1) ? $query->row() : false;
    }

    public function update_password_by_email($email, $new_password) {
        $data = array('password' => $new_password);
        $this->db->where('email', $email);
        return $this->db->update('users', $data);
    }

    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }
}
