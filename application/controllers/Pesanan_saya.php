<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_saya extends CI_Controller {

    public function __construct(){
      parent::__construct();
      $this->load->model('m_transaksi');
    }

    // List all your items
    public function index(){
      $data = array(
        'title' => 'Pesanan Saya',
        'belum_bayar' => $this->m_transaksi->belum_bayar(),
        'isi' => 'v_pesanan_saya'
      );
      $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }

    // Add a new item
    public function add()
    {

    }

    //Update one item
    
}

/* End of file Controllername.php */

