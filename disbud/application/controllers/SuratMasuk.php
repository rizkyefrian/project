<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
use Medoo\medoo;
class SuratMasuk extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model("ModelSuratMasuk", "suratmasuk");
    $this->load->model("ModelBidang", "bidang");
    $this->load->model("ModelPegawai", "pegawai");
    $this->load->library('pagination');
  }
  //  Method untuk menampilkan data
	public function daftar()
	{
    
    $this->_dts['bidang'] = $this->bidang->data();  // Proses pengambilan data dari database
    if($_SESSION['level'] == "Kepala Bidang")
    {
      $this->_dts['data_list'] = $this->suratmasuk->dataWhere(["id_bidang" => $_SESSION['id_bidang']]);  // Proses pengambilan data dari database
    }
    else
    {
      $this->_dts['data_list'] = $this->suratmasuk->data();  // Proses pengambilan data dari database
    }
    
		$this->view('admin.suratmasuk.daftar', $this->_dts); // Oper data dari database ke view
	}
  
	public function daftarDisposisi()
	{
    $this->_dts['bidang'] = $this->bidang->data();  // Proses pengambilan data dari database
    $this->_dts['data_list'] = $this->suratmasuk->data();  // Proses pengambilan data dari database
		$this->view('kepaladinas.disposisi.daftar', $this->_dts); // Oper data dari database ke view
	}
  
  // Method untuk menampilkan form tambah data
  public function tambah()
  {
    
    $this->view('admin.suratmasuk.tambah'); // Langsung tampilkan view tambah data
  }
  
  // Method untuk memproses penambahan data
  // Method diakses dalam metode POST
  public function prosesTambah()
  {
    $data = $this->input->post(NULL, TRUE);
    if(file_exists($_FILES['filesurat']['tmp_name']) || is_uploaded_file($_FILES['filesurat']['tmp_name']))
    {
      $data['filesurat'] = fileUpload($_FILES["filesurat"], "./assets/images/");
    }
    else
    {
      $data['filesurat'] = null;
    }
    $this->suratmasuk->tambah($data);
    $_SESSION['banyak_surat_masuk'] = $this->suratmasuk->hitungBanyakSuratMasuk();
    $_SESSION['surat_masuk'] = $this->suratmasuk->suratYangBelumDidisposisi();
    $kepaladinas = $this->pegawai->dataWhere(["level" => "Kepala Dinas"]);
    
    
    foreach($kepaladinas as $dinas)
    {
    	 //kode untuk mengirim notif ke email
    	$from = "noreply@disbud.sumbarprov.go.id";
    	$to = $dinas['email'];
    	$subject = "Pemberitahuan Surat Masuk";
    	$message = "Anda Punya ".$_SESSION['banyak_surat_masuk']." Surat Yang Harus Di Disposisi";
    	$headers = "From:" . $from;
    	mail($to,$subject,$message, $headers);	
    }
    header("Location: ".site_url("admin/suratmasuk")); // Arahkan kembali user ke halaman daftar
  }
  
  // Method untuk menampilkan form edit
  public function edit()
  {
    $this->_dts['detail'] = $this->suratmasuk->data($this->input->get('id')); // Ambil data yang akan diedit berdasarkan ID
    $this->view('admin.suratmasuk.edit', $this->_dts); // Oper data ke view
  }
  
  // Method untuk memproses data yang akan diedit
  public function prosesEdit()
  {
    $data = $this->input->post(NULL, TRUE);
    if(file_exists($_FILES['filesurat']['tmp_name']) || is_uploaded_file($_FILES['filesurat']['tmp_name']))
    {
      $data['filesurat'] = fileUpload($_FILES["filesurat"], "./assets/images/");
    }
    else
    {
      $data['filesurat'] = null;
    }
    $this->suratmasuk->edit($this->input->post("id"), $data);
    header("Location: ".site_url("admin/suratmasuk")); // Arahkan user kembali ke halaman daftar
  }
  
  // Method untuk menghapus data
  public function prosesHapus()
  {
    $this->suratmasuk->hapus($this->input->get('id')); // Proses hapus data
    header("Location: ".site_url("admin/suratmasuk")); // // Arahkan user kembali ke halaman daftar
  }
  
  public function prosesDisposisi()
  {
    $this->suratmasuk->prosesDisposisi($this->input->post("id"), $this->input->post(NULL, true));
    header("Location: ".site_url("kepaladinas/disposisi")); // // Arahkan user kembali ke halaman daftar
  }
  
  public function laporanSuratMasuk()
  {
    $this->view("laporan-surat-masuk");
  }
  
  public function prosesLaporanSuratMasuk()
  {
    $parameter = $this->input->post(NULL, true);
    $tanggal = date("Y-m-d");
    $jenis_laporan = $parameter['jenis_laporan'];
    $where = ["tglsurat" => $tanggal];
    if(isset($parameter['tgl']) && !empty($parameter['tgl']))
    {
      $tanggal = $parameter['tgl'];
    }
    $keterangan_tanggal = explode(" ", TanggalIndo($tanggal));
    switch($jenis_laporan)
    {
      case "Harian":
        $where = Medoo::raw("WHERE DATE(tglsurat) = DATE(:tgl)", [":tgl" => $tanggal]);
        $this->_dts['judul'] = "Laporan Harian Surat Masuk <br> Tanggal ".TanggalIndo($tanggal);
      break;
      case "Bulanan":
        $where = Medoo::raw("WHERE LEFT(tglsurat, 7) = LEFT(:tgl, 7)", [":tgl" => $tanggal]);
        $this->_dts['judul'] = "Laporan Bulanan Surat Masuk <br> Bulan ".$keterangan_tanggal[1]." ".$keterangan_tanggal[2];
      break;
      case "Tahunan":
        $where = Medoo::raw("WHERE LEFT(tglsurat, 4) = LEFT(:tgl, 4)", [":tgl" => $tanggal]);
        $this->_dts['judul'] = "Laporan Tahunan Surat Masuk <br> Tahun ".$keterangan_tanggal[2];
      break;
    }
    $this->_dts['data_list'] = $this->suratmasuk->dataWhere($where);
    $this->_dts['datacount'] = $this->suratmasuk->dataStatistikSuratMasuk();
    $this->view("cetak-laporan-surat-masuk", $this->_dts);
  }

  public function jumlah()
  {
    $this->view("cetak-laporan-surat-masuk");
  }

  
  
}
