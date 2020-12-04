<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{
    
  public function login_user(){


    $this->form_validation->set_rules('username', 'Username', 'required', array(
      'required' => 'Username wajib Diisi!!'
    ));
    $this->form_validation->set_rules('password', 'Password', 'required', array(
      'required' => 'Password wajib Diisi!!'
    ));

    if($this->form_validation->run() == TRUE){
      $username = $this->input->post('username');
      $password = $this->input->post('password');

     
     $cek = $this->user_login->login($username, $password);
   
    }else{
      $data = array(
        'title' => 'Login User',
      );

      $this->load->view('v_login_user', $data, FALSE);
    }
    
  }
}

?>