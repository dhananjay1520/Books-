<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filter extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Filter_model');
        $this->load->helper(array('url', 'security'));
    }

    public function index()
    {
        $category = trim((string)$this->input->get('category_slug'));
        $min_price = $this->input->get('min_price');
        $max_price = $this->input->get('max_price');

        $min_price = ($min_price !== '' && is_numeric($min_price)) ? (float)$min_price : null;
        $max_price = ($max_price !== '' && is_numeric($max_price)) ? (float)$max_price : null;

        $data = array(
            'category_slug' => $category,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'categories' => $this->Filter_model->categories(),
            'books' => $this->Filter_model->books($category, $min_price, $max_price)
        );

        $this->load->view('layout/header', array('title' => 'Browse Books'));
        $this->load->view('filter/index', $data);
        $this->load->view('layout/footer');
    }
}
