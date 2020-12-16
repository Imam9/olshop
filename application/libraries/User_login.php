<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_login{
    
  protected $ci;

 public function __construct(){
     $this->ci = &get_instance();
     $this->ci->load->model('m_auth');
 }


 public function login($username, $password){
    $cek = $this->ci->m_auth->login_user($username, $password);

    if($cek){
    
      $nama_user =  $cek->nama_user;
      $username = $cek->username;
      $level_user = $cek->level_user;

      $this->ci->session->set_userdata('username', $username);
      $this->ci->session->set_userdata('nama_user', $nama_user);
      $this->ci->session->set_userdata('password', $password);

      redirect('admin');
    }else{
    $this->ci->session->set_flashdata('error', 'Username Atau Password salah');
    redirect('auth/login_user');

    }
 }

 public function proteksi_halaman(){
    if($this->ci->session->userdata('username') == ''){
      $this->ci->session->set_flashdata('error', 'Anda belum login');
      redirect('auth/login_user');
    }
 }

 public function logout(){
  $this->ci->session->set_userdata('username');
  $this->ci->session->set_userdata('nama_user');
  $this->ci->session->set_userdata('password');
  $this->ci->session->set_flashdata('pesan', 'Anda berhasil logout');
  redirect('auth/login_user');
 }
}

?>