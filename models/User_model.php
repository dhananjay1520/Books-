<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // ---------------------------------------------------------
    // EXISTING AUTHENTICATION METHODS
    // ---------------------------------------------------------

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

    // ---------------------------------------------------------
    // NEW PROFILE MANAGEMENT METHODS
    // ---------------------------------------------------------

    // Get user details by their ID (used for loading the profile)

    public function get_user_by_email_except_id($email, $user_id) {
        $this->db->where('email', $email);
        $this->db->where('id !=', (int)$user_id);
        $query = $this->db->get('users');
        return ($query->num_rows() > 0) ? $query->row() : false;
    }

    public function get_user_by_id($user_id) {
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        return ($query->num_rows() == 1) ? $query->row() : false;
    }

    // Update personal information (name, mobile, address, etc.)
    public function update_profile($user_id, $data) {
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }

    // Update only the profile image filename
    public function update_profile_image($user_id, $image_name) {
        $this->db->where('id', $user_id);
        return $this->db->update('users', array('image' => $image_name));
    }

    // Update password using the logged-in user's ID
    public function update_password($user_id, $hashed_password) {
        $this->db->where('id', $user_id);
        return $this->db->update('users', array('password' => $hashed_password));
    }
}
