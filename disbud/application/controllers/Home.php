<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model("ModelSuratMasuk", "suratmasuk");
    $this->load->model("ModelSuratKeluar", "suratkeluar");
  }
	public function beranda()
	{
    $this->_dts = array_merge($this->suratmasuk->dataStatistikSuratMasuk($_SESSION["id_bidang"]), $this->suratkeluar->dataStatistikSuratKeluar($_SESSION["id_bidang"]));
		return $this->view('beranda', $this->_dts);
	}
}