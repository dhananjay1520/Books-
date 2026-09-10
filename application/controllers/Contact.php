<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    // AJAX: handles the "Send a Message" form on the About/Contact
    // section of the home page.
    public function send() {
        $this->form_validation->set_rules('name', 'Name', 'required|trim|max_length[150]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('message', 'Message', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'error', 'message' => strip_tags(validation_errors())]);
            return;
        }

        $data = array(
            'name'    => $this->input->post('name', TRUE),
            'email'   => $this->input->post('email', TRUE),
            'message' => $this->input->post('message', TRUE),
        );

        // Table maujood na ho to bhi site crash na ho - error gracefully handle karo
        if ($this->db->table_exists('contact_messages') && $this->db->insert('contact_messages', $data)) {
            echo json_encode(['status' => 'success', 'message' => 'Your message has been sent successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Could not send your message right now. Please try again later or reach us directly by phone/email.']);
        }
    }
}
