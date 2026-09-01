<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper(array('url', 'form'));
    }

    public function signup()
    {
        $data = array(
            'signupshowerror'     => false,
            'signuppassworderror' => false
        );

        if ($this->input->method() === 'post') {

            $name      = trim($this->input->post('name'));
            $email     = trim($this->input->post('email'));
            $password  = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');

            if ($this->User_model->email_exists($email)) {

                $data['signupshowerror'] = true;

            } elseif ($password !== $cpassword) {

                $data['signuppassworderror'] = true;

            } else {

                $insertData = array(
                    'name'     => $name,
                    'email'    => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT)
                );

                if ($this->User_model->create_user($insertData)) {
                    redirect('auth/login');
                }
            }
        }

        $this->load->view('auth/signup', $data);
    }

    public function login()
    {
        $this->load->view('auth/login');
    }
}