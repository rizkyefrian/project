<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Autentikasi extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model("ModelPegawai", "pegawai");
    $this->load->model("ModelBidang", "bidang");
    $this->load->model("ModelSuratMasuk", "surat_masuk");
    
  }
  
  public function login()
  {
    if(isset($_SESSION['username']))
    {
      header('Location: '.site_url('beranda'));
    }
    else
    {
      $this->view('login');
    }
  }
  public function prosesLogin()
  {
    $data_pegawai = $this->pegawai->cekLogin($this->input->post('username'), $this->input->post('password'));
    $data_bidang = [
      "id_bidang" => null
    ];
    if(empty($data_pegawai))
    {
      header('Location: '.site_url('login?salah=true'));
    }
    else
    {
      if($data_pegawai['level'] == "Kepala Bidang")
      {
        $data_bidang_sementara = $this->bidang->data($data_pegawai["nip"]);
        $data_bidang["id_bidang"] = $data_bidang_sementara["id"];
        $_SESSION = array_merge($data_pegawai, $data_bidang);
      }
      
      $_SESSION = array_merge($data_pegawai, $data_bidang);
      $_SESSION['banyak_surat_masuk'] = $this->surat_masuk->hitungBanyakSuratMasuk();
      $_SESSION['surat_masuk'] = $this->surat_masuk->suratYangBelumDidisposisi();
      
      header('Location: '.site_url('beranda'));
    }
  }
  
  public function prosesLogout()
  {
    session_destroy();
    header('Location: '.site_url('login?logout=true'));
  }
  public function dilarang()
  {
    $this->view('dilarang');
  }
}
