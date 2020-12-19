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
   public function bayar($id_transaksi){

    $this->form_validation->set_rules('atas_nama', 'Atas Nama', 'required', array(
      'required' => 'Atas Nama Wajib Diisi !!'
    ));

    if($this->form_validation->run() == TRUE){
      $config['upload_path'] = 'assets/bukti_bayar/';
      $config['allowed_types'] = 'jpeg|ico|gif|jpg|png';
      $config['max_size']     = '2000';
      // $config['max_width'] = '1024';
      // $config['max_height'] = '768';
      $this->upload->initialize($config);
      $field_name = "bukti_bayar";

      if(!$this->upload->do_upload($field_name)){
        $data = array(
          'title' => 'Pembayaran',
          'bayar' => $this->m_transaksi->detail_pesanan($id_transaksi),
          'error_upload' => $this->upload->display_errors(),
          'rekening' => $this->m_transaksi->rekening(),
          'isi' => 'v_bayar'
        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
      }else{
        $this->load->library('upload', $config);
        $bukti_bayar = $this->upload->data('file_name');
        $data = array(
          'id_transaksi' => $id_transaksi,
          'atas_nama' => $this->input->post('atas_nama', TRUE),
          'nama_bank' => $this->input->post('nama_bank', TRUE),
          'no_rek' => $this->input->post('no_rek', TRUE),
          'status_bayar' => '1',
          'bukti_bayar' => $bukti_bayar
        );

        $this->m_transaksi->upload_bukti_bayar($data);
        $this->session->set_flashdata('pesan', 'Bukti Pembayaran berhasil diupload');
        redirect('pesanan_saya');
      }
    }
    $data = array(
      'title' => 'Pembayaran',
      'bayar' => $this->m_transaksi->detail_pesanan($id_transaksi),
      'rekening' => $this->m_transaksi->rekening(),
      'isi' => 'v_bayar'
    );
    $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
   }
    
}

/* End of file Controllername.php */

