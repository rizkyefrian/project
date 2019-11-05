<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model("ModelPegawai", "pegawai");
  }
  //  Method untuk menampilkan data
	public function daftar()
	{
    $this->_dts['data_list'] = $this->pegawai->data();  // Proses pengambilan data dari database
		$this->view('admin.pegawai.daftar', $this->_dts); // Oper data dari database ke view
	}
  
  // Method untuk menampilkan form tambah data
  public function tambah()
  {
    $this->view('admin.pegawai.tambah'); // Langsung tampilkan view tambah data
  }
  
  // Method untuk memproses penambahan data
  // Method diakses dalam metode POST
  public function prosesTambah()
  {
    $data = $this->input->post(NULL, TRUE);
    if(file_exists($_FILES['foto']['tmp_name']) || is_uploaded_file($_FILES['foto']['tmp_name']))
    {
      $data['foto'] = fileUpload($_FILES["foto"], "./assets/images/");
    }
    else
    {
      $data['foto'] = null;
    }
    $this->pegawai->tambah($data);
    header("Location: ".site_url("admin/pegawai")); // Arahkan kembali user ke halaman daftar
  }
  
  // Method untuk menampilkan form edit
  public function edit()
  {
    $this->_dts['detail'] = $this->pegawai->data($this->input->get('id')); // Ambil data yang akan diedit berdasarkan ID
    $this->view('admin.pegawai.edit', $this->_dts); // Oper data ke view
  }
  
  // Method untuk memproses data yang akan diedit
  public function prosesEdit()
  {
    $data = $this->input->post(NULL, TRUE);
    if(file_exists($_FILES['foto']['tmp_name']) || is_uploaded_file($_FILES['foto']['tmp_name']))
    {
      $data['foto'] = fileUpload($_FILES["foto"], "./assets/images/");
    }
    else
    {
      $data['foto'] = null;
    }
    $this->pegawai->edit($this->input->post("id"), $data);
    header("Location: ".site_url("admin/pegawai")); // Arahkan user kembali ke halaman daftar
  }
  
  // Method untuk menghapus data
  public function prosesHapus()
  {
    $this->pegawai->hapus($this->input->get('id')); // Proses hapus data
    header("Location: ".site_url("admin/pegawai")); // // Arahkan user kembali ke halaman daftar
  }
  
  public function gantiPassword()
  {
    $this->view("gantipassword");
  }
  public function prosesGantiPassword()
  {
    $data = $this->input->post(NULL, true);
    if($this->pegawai->gantiPassword($data['id'], $data['password_lama'], $data['password_baru'], $data['password_baru_cek']))
    {
      header("Location: ".site_url("logout")); // // Arahkan user kembali ke halaman daftar
    }
    else
    {
      $this->gantiPassword();
    }
  }
}
