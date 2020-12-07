<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gambarbarang extends CI_Controller{


  public function __construct(){
    parent::__construct();
    $this->load->model('m_gambarbarang');
    $this->load->model('m_barang');
  }

  public function index(){
    $data = array(
      'title' => 'Gambar Barang',
      'gambarbarang' => $this->m_gambarbarang->get_all_data(),
      'isi' => 'gambarbarang/v_index'
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  public function add($id_barang){

    $this->form_validation->set_rules('ket', 'Nama Barang', 'required', array(
      'required' => 'Keterangan Gambar Barang Wajib Diisi !!'
    ));

    if($this->form_validation->run() == TRUE){
      $config['upload_path'] = 'assets/gambarbarang/';
      $config['allowed_types'] = 'jpeg|ico|gif|jpg|png';
      $config['max_size']     = '2000';
      // $config['max_width'] = '1024';
      // $config['max_height'] = '768';
      $this->upload->initialize($config);
      $field_name = "gambar";

      if(!$this->upload->do_upload($field_name)){
        $data = array(
          'title' => 'Add Gambar Barang',
          'barang' => $this->m_barang->get_data($id_barang),
          'error_upload' => $this->upload->display_errors(),
          'gambar' => $this->m_gambarbarang->get_gambar($id_barang),
          'isi' => 'gambarbarang/v_add'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
      }else{
        $this->load->library('upload', $config);
        $gambar = $this->upload->data('file_name');
        $data = array(
          'id_barang' => $id_barang,
          'ket' => $this->input->post('ket', TRUE),
          'gambar' => $gambar
        );

        $this->m_gambarbarang->add($data);
        $this->session->set_flashdata('pesan', 'Data Gambar berhasil untuk di tambahkan');
        redirect('gambarbarang/add/'.$id_barang);
      }
    }
    $data = array(
      'title' => 'Add Gambar Barang',
      'barang' => $this->m_barang->get_data($id_barang),
      'gambar' => $this->m_gambarbarang->get_gambar($id_barang),
      'isi' => 'gambarbarang/v_add'
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    
  }

  public function delete($id_barang , $id_gambar){

    $gambar =  $this->m_gambarbarang->get_data($id_gambar);

    if($gambar->gambar != ''){
      unlink('assets/gambarbarang/'.$gambar->gambar);
    }
    $data = array('id_gambar' => $id_gambar);
    $this->m_gambarbarang->delete($data);
    $this->session->set_flashdata('pesan', 'Data Gambar Berhasil Dihapus!!');
    redirect('gambarbarang/add/'.$id_barang);
  }

}

?>