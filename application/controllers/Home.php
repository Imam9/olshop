<?php 


class Home extends CI_Controller{
    
    public function index(){
        $data = array(
            'title' => 'Home',
            'isi' => 'v_home'
        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }
}

?>