<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller{


  public function __construct(){
    parent::__construct();
    $this->load->model('m_barang');
    $this->load->model('m_kategori');
  }

  public function index(){
    $data = array(
      'title' => 'Barang',
      'barang' => $this->m_barang->get_all_data(),
      'isi' => 'barang/v_barang'
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  public function add(){

    $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required', array(
      'required' => 'Nama Barang Wajib Diisi !!'
    ));
    $this->form_validation->set_rules('harga', 'Harga', 'required', array(
      'required' => 'Harga Wajib Diisi !!'
    ));$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', array(
      'required' => 'Deskripsi Wajib Diisi !!'
    ));
    $this->form_validation->set_rules('id_kategori', 'Id Kategori', 'required', array(
      'required' => 'Kategori Wajib Diisi !!'
    ));

    if($this->form_validation->run() == TRUE){
      $config['upload_path'] = 'assets/gambar/';
      $config['allowed_types'] = 'jpeg|ico|gif|jpg|png';
      $config['max_size']     = '2000';
      // $config['max_width'] = '1024';
      // $config['max_height'] = '768';
      $this->upload->initialize($config);
      $field_name = "gambar";

      if(!$this->upload->do_upload($field_name)){
        $data = array(
          'title' => 'Add Barang',
          'kategori' => $this->m_kategori->get_all_data(),
          'error_upload' => $this->upload->display_errors(),
          'isi' => 'barang/v_add'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
      }else{
        $this->load->library('upload', $config);
        $gambar = $this->upload->data('file_name');
        $data = array(
          'nama_barang' => $this->input->post('nama_barang', TRUE),
          'id_kategori' => $this->input->post('id_kategori', TRUE),
          'harga' => $this->input->post('harga', TRUE),
          'deskripsi' => $this->input->post('deskripsi', TRUE),
          'gambar' => $gambar
        );

        $this->m_barang->add($data);
        $this->session->set_flashdata('pesan', 'Data berhasil untuk di tambahkan');
        redirect('barang');
      }
    }
    $data = array(
      'title' => 'Add Barang',
      'kategori' => $this->m_kategori->get_all_data(),
      'isi' => 'barang/v_add'
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  public function edit($id_user){
    $data = array(
      'id_user' => $id_user,
      'nama_user' => $this->input->post('nama_user'),
      'username' => $this->input->post('username'),
      'password' => $this->input->post('password'),
      'level_user' => $this->input->post('level_user')
    );

    $this->m_user->edit($data);
    $this->session->set_flashdata('pesan', 'Data berhasil untuk di edit !!');
    redirect('user');
  }

  public function delete($id){
    $data = array('id_user' => $id);
    $this->m_user->delete($data);
    $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!!');
    redirect('user');
  }

}

?>