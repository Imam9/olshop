<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Belanja extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->model('m_admin');
    $this->load->model('m_transaksi');
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
    $this->session->set_flashdata('pesan', 'Keranjang berhasil diupdate');
    redirect('belanja');
  }

  public function clear(){
    $this->cart->destroy();
    redirect('belanja');
  }


  public function cekout(){
    
    $this->pelanggan_login->proteksi_halaman();

    $this->form_validation->set_rules('provinsi', 'Provinsi', 'required', array(
      'required' => 'provinsi Barang Wajib Diisi !!'
    ));
    $this->form_validation->set_rules('kota', 'Kota', 'required', array(
      'required' => 'Kota Barang Wajib Diisi !!'
    ));
    $this->form_validation->set_rules('expedisi', 'Expedisi', 'required', array(
      'required' => 'Expedisi Wajib Diisi !!'
    ));
    $this->form_validation->set_rules('paket', 'Paket', 'required', array(
      'required' => 'Paket Wajib Diisi !!'
    ));
    
    if ($this->form_validation->run() == FALSE) {
      $data = array(
        'title' => 'Chek Out Belanja',
        // 'total_barang' => $this->m_admin->total_barang(),
        'isi' => 'v_cekout'
      );
      $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    } else {
      //simpan dalam tbl_transaksi
      $data = array(
        'no_order' => $this->input->post('no_order'),
        'id_pelanggan' => $this->session->userdata('id_pelanggan'),
        'tgl_order' => date('Y-m-d'),
        'provinsi' => $this->input->post('provinsi'),
        'nama_penerima' => $this->input->post('nama_penerima'),
        'hp_penerima' => $this->input->post('hp_penerima'),
        'kota' => $this->input->post('kota'),
        'alamat' => $this->input->post('alamat'),
        'kode_pos' => $this->input->post('kode_pos'),
        'expedisi' => $this->input->post('expedisi'),
        'paket' => $this->input->post('paket'),
        'estimasi' => $this->input->post('estimasi'),
        'ongkir' => $this->input->post('ongkir'),
        'berat' => $this->input->post('berat'),
        'grand_total' => $this->input->post('grand_total'),
        'total_bayar' => $this->input->post('total_bayar'),
        'status_bayar' => '0',
        'status_order' => '0'
      );

      $this->m_transaksi->simpan_transaksi($data);
      //simpan ke data rinci
       
      $i = 1;
      foreach ($this->cart->contents() as $items){
        $data_rinci = array(
          'no_order' => $this->input->post('no_order'),
          'id_barang' => $items['id'],
          'qty'   => $this->input->post('qty'.$i++)
        );
        $this->m_transaksi->rinci($data_rinci);
      }

      $this->session->set_flashdata('pesan', 'Pesanan berhasil diproses');
      $this->cart->destroy();
      redirect('pesanan_saya');   
    }
    

    
  }
}

?>