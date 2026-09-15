<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ebooks extends CI_Controller {
 public function __construct(){parent::__construct();$this->load->library('session');$this->load->helper(['url','product']);$this->load->model('Product_model');}
 public function index(){$books=[];$table=false;if($this->db->table_exists('ebooks')){$table=true;$books=$this->db->order_by('id','DESC')->get('ebooks')->result_array();}if(!$table)$books=$this->Product_model->get_new_arrivals(8);$uid=(int)$this->session->userdata('user_id');$wish=$this->session->userdata('wishlist_ids');if(!is_array($wish))$wish=[];$data=['books'=>$books,'is_ebook_table'=>$table,'cartCount'=>$uid?$this->Product_model->get_cart_count($uid):0,'wishlistCount'=>count($wish),'loggedIn'=>(bool)$this->session->userdata('login')];$this->load->view('partials/navbar',$data);$this->load->view('ebooks/index',$data);$this->load->view('partials/footer');}
}
