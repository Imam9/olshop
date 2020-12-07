<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Belanja extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->model('m_admin');
  }

    
  public function index(){
    //   $data = array(
    //       'title' => 'Dashboard',
    //       'total_barang' => $this->m_admin->total_barang(),
    //       'isi' => 'v_admin'
    //   );
    //   $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  public function add(){
    $redirect_page = $this->input->post('redirect_page');
    $data = array(
      'id'      => $this->input->post('id', TRUE),
      'qty'     => $this->input->post('qty', TRUE),
      'price'   => $this->input->post('price', TRUE),
      'name'    => $this->input->post('name', TRUE),
     );
    $this->cart->insert($data);

    redirect($redirect_page , 'refresh');
  }
}

?>