<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Help extends CI_Controller {
 public function __construct(){parent::__construct();$this->load->library('session');$this->load->helper('url');$this->load->model('Product_model');}
 public function index(){$uid=(int)$this->session->userdata('user_id');$wish=$this->session->userdata('wishlist_ids');if(!is_array($wish))$wish=[];$data=['cartCount'=>$uid?$this->Product_model->get_cart_count($uid):0,'wishlistCount'=>count($wish),'loggedIn'=>(bool)$this->session->userdata('login')];$this->load->view('partials/navbar',$data);$this->load->view('help/index');$this->load->view('partials/footer');}
}
