<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Belanja extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->model('m_admin');
  }

    
  public function index(){

    if(empty($this->cart->contents())){
      redirect('home');
    }
      $data = array(
          'title' => 'Keranjang Belanja',
          // 'total_barang' => $this->m_admin->total_barang(),
          'isi' => 'v_belanja'
      );
      $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
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

  public function delete($rowid){

    $this->cart->remove($rowid);
    redirect('belanja');
  }

  public function update(){
    
    $i = 1;
    foreach ($this->cart->contents() as $items){
      $data = array(
        'rowid' => $items['rowid'],
        'qty'   => $this->input->post($i.'[qty]'),
      );
      $this->cart->update($data);
      $i++;
    }
    redirect('belanja');
  }

  public function clear(){
    $this->cart->destroy();
    redirect('belanja');
  }


  public function cekout(){
    $this->pelanggan_login->proteksi_halaman();
    $data = array(
      'title' => 'Chek Out Belanja',
      // 'total_barang' => $this->m_admin->total_barang(),
      'isi' => 'v_cekout'
  );
  $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
  }
}

?>