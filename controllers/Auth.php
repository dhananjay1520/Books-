<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('url', 'form'));
        $this->load->model('User_model');
    }

    // ---------------------------------------------------------
    // 1. LOGIN PAGE
    // ---------------------------------------------------------
    public function login() {
        if ($this->session->userdata('logged_in')) {
            redirect('home');
        }
        $this->load->view('auth/login');
    }

    public function process_login() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('auth/login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->User_model->get_user_by_email($email);

            if ($user && password_verify($password, $user->password)) {
                $userdata = array(
                    'user_id'   => $user->id,
                    'name'      => $user->name,
                    'email'     => $user->email,
                    'image'     => !empty($user->image) ? $user->image : '',
                    'logged_in' => TRUE,
                    'login'     => TRUE
                );
                $this->session->set_userdata($userdata);
                redirect('home');
            } else {
                $this->session->set_flashdata('error', 'Incorrect email or password.');
                redirect('auth/login');
            }
        }
    }

    // ---------------------------------------------------------
    // 2. SIGNUP PAGE
    // ---------------------------------------------------------
    public function signup() {
        if ($this->session->userdata('logged_in')) {
            redirect('home');
        }

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');

            if ($this->form_validation->run() == FALSE) {
                $data['signupshowerror'] = form_error('email') ? true : false;
                $data['signuppassworderror'] = form_error('cpassword') ? true : false;
                $this->load->view('auth/signup', $data);
            } else {
                $insert_data = array(
                    'name'     => $this->input->post('name'),
                    'email'    => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
                );

                if ($this->User_model->insert_user($insert_data)) {
                    $this->session->set_flashdata('message', 'Registration successful! You can now log in.');
                    redirect('auth/login');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
                    redirect('auth/signup');
                }
            }
        } else {
            $data['signupshowerror'] = false;
            $data['signuppassworderror'] = false;
            $this->load->view('auth/signup', $data);
        }
    }

    // ---------------------------------------------------------
    // 3. FORGOT PASSWORD
    // NOTE: direct flow — email + new password same page, koi
    // reset link / email verification nahi hai. Dev/internal
    // tool ke liye theek hai, real users ke liye risky hai
    // kyunki koi bhi registered email jaan kar password badal
    // sakta hai.
    // ---------------------------------------------------------
    public function forgot_password() {
        $this->load->view('auth/forgot_password');
    }

    public function process_reset() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('auth/forgot_password');
        } else {
            $email = $this->input->post('email');
            $user = $this->User_model->get_user_by_email($email);

            if ($user) {
                $new_password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                $this->User_model->update_password_by_email($email, $new_password);
                $this->session->set_flashdata('message', 'Password updated successfully! You can now log in.');
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('error', 'No account found with that email.');
                redirect('auth/forgot_password');
            }
        }
    }

    // ---------------------------------------------------------
    // 4. LOGOUT
    // logout.php standalone file ki jagah, ab yahan controller
    // method hai — pehle session_unset()+session_destroy() tha,
    // ab CI ka session library isi kaam ko karta hai.
    // ---------------------------------------------------------
    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
