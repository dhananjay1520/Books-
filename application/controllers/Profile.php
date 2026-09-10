<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load required libraries, helpers, and the User model[cite: 1]
        $this->load->library(array('form_validation', 'session', 'upload'));
        $this->load->helper(array('url', 'form'));
        $this->load->model('User_model');
        
        // Ensure user is logged in using session data[cite: 1, 3]
        if (!$this->session->userdata('login') || !$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    // Load the profile view
    public function index() {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);

        $data['loggedIn'] = (bool) $this->session->userdata('login');
        if ($data['loggedIn']) {
            $data['name'] = $this->session->userdata('name');
        }

        $this->load->view('partials/navbar', $data);
        $this->load->view('profile/profile', $data);
        $this->load->view('partials/footer');
    }

    // AJAX: Update Personal Information
    public function update_profile() {
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|trim|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        $user_id = $this->session->userdata('user_id');
        $data = array(
            'name'    => $this->input->post('name', TRUE),
            'mobile'  => $this->input->post('mobile', TRUE),
            'address' => $this->input->post('address', TRUE),
            'city'    => $this->input->post('city', TRUE),
            'state'   => $this->input->post('state', TRUE),
            'country' => $this->input->post('country', TRUE),
            'pincode' => $this->input->post('pincode', TRUE)
        );

        if ($this->User_model->update_profile($user_id, $data)) {
            // Update session name if it was changed
            $this->session->set_userdata('name', $data['name']);
            echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully!']);
        } else {
            $db_error = $this->db->error();
            $message  = 'Failed to update profile.';
            if (!empty($db_error['message'])) {
                $message .= ' (' . $db_error['message'] . ')';
            }
            echo json_encode(['status' => 'error', 'message' => $message]);
        }
    }

    // AJAX: Upload/Change Profile Image
    public function upload_image() {
        $config['upload_path']   = './uploads/profile/';
        $config['allowed_types'] = 'jpg|jpeg|png|webp'; 
        $config['max_size']      = 2048; // Max 2MB 
        $config['encrypt_name']  = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('profile_image')) {
            echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors('', '')]);
        } else {
            $user_id = $this->session->userdata('user_id');
            $upload_data = $this->upload->data();
            $image_name = $upload_data['file_name'];

            // Delete old image from server to save space
            $user = $this->User_model->get_user_by_id($user_id);
            if (!empty($user->image) && file_exists('./uploads/profile/' . $user->image)) {
                unlink('./uploads/profile/' . $user->image);
            }

            $this->User_model->update_profile_image($user_id, $image_name);

            // Session bhi turant update karo taaki navbar ka avatar
            // bina re-login kiye naya image dikhaye
            $this->session->set_userdata('image', $image_name);

            $image_url = base_url('uploads/profile/' . $image_name);
            echo json_encode(['status' => 'success', 'message' => 'Image updated successfully!', 'image_url' => $image_url]);
        }
    }

    // AJAX: Change Password
    public function change_password() {
        $this->form_validation->set_rules('current_password', 'Current Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        $user_id = $this->session->userdata('user_id');
        $user = $this->User_model->get_user_by_id($user_id);
        
        $current_password = $this->input->post('current_password');
        $new_password = $this->input->post('new_password');

        // Verify current password using password_verify[cite: 1]
        if (!password_verify($current_password, $user->password)) {
            echo json_encode(['status' => 'error', 'message' => 'Current password is incorrect.']);
            return;
        }

        // Check if new password is same as old
        if (password_verify($new_password, $user->password)) {
            echo json_encode(['status' => 'error', 'message' => 'New password cannot be the same as the current password.']);
            return;
        }

        // Hash using PASSWORD_DEFAULT[cite: 1] and update
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        if ($this->User_model->update_password($user_id, $hashed_password)) {
            echo json_encode(['status' => 'success', 'message' => 'Password updated successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update password.']);
        }
    }

    // AJAX: Update Unified Account (Profile + Optional Password)
    public function update_account() {
        // Validate Personal Info
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|trim|numeric');
        
        // Check if user is trying to change their password
        if (!empty($this->input->post('new_password'))) {
            $this->form_validation->set_rules('current_password', 'Current Password', 'required');
            $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');
        }

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        $user_id = $this->session->userdata('user_id');
        $user = $this->User_model->get_user_by_id($user_id);
        
        // 1. Update Password (if fields are filled)
        if (!empty($this->input->post('new_password'))) {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');

            if (!password_verify($current_password, $user->password)) {
                echo json_encode(['status' => 'error', 'message' => 'Current password is incorrect. Profile not updated.']);
                return;
            }
            if (password_verify($new_password, $user->password)) {
                echo json_encode(['status' => 'error', 'message' => 'New password cannot be the same as the current password.']);
                return;
            }

            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $this->User_model->update_password($user_id, $hashed_password);
        }

        // 2. Update Personal Info
        $profile_data = array(
            'name'    => $this->input->post('name', TRUE),
            'mobile'  => $this->input->post('mobile', TRUE),
            'address' => $this->input->post('address', TRUE),
            'city'    => $this->input->post('city', TRUE),
            'state'   => $this->input->post('state', TRUE),
            'country' => $this->input->post('country', TRUE),
            'pincode' => $this->input->post('pincode', TRUE)
        );

        if ($this->User_model->update_profile($user_id, $profile_data)) {
            $this->session->set_userdata('name', $profile_data['name']);
            echo json_encode(['status' => 'success', 'message' => 'Account updated successfully!']);
        } else {
            $db_error = $this->db->error();
            $message  = 'Failed to update account.';
            if (!empty($db_error['message'])) {
                $message .= ' (' . $db_error['message'] . ')';
            }
            echo json_encode(['status' => 'error', 'message' => $message]);
        }
    }
}