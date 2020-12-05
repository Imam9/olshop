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
    $data = array(
      'title' => 'Add Barang',
      'kategori' => $this->m_kategori->get_all_data(),
      'isi' => 'barang/v_add'
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

//   public function add(){
//     $data = array(
//       'nama_user' => $this->input->post('nama_user'),
//       'username' => $this->input->post('username'),
//       'password' => $this->input->post('password'),
//       'level_user' => $this->input->post('level_user')
//     );

//     $this->m_user->add($data);
//     $this->session->set_flashdata('pesan', 'Data berhasil untuk di tambahkan');
//     redirect('user');
//   }

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