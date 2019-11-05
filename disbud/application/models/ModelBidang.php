<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelBidang extends MY_Model {
  // Nama Tabel
  private $table = "bidang";      // nama tabelnya
  private $primaryKey = "nip"; // primary keynya
  
  
  //  Method untuk menampilkan data
  // kalau idnya tidak diatur alias kosong data() , maka ambil semua data
  // kalau idnya diatur data("P0001") maka data P0001 yang akan diambil
	public function data($id = null)
	{
    if($id != null)
    {
      return $this->db->get($this->table, "*", [$this->primaryKey => $id]);
    }
    else
    {
       // return $this->db->query("SELECT bidang.*, pegawai.nama FROM bidang JOIN pegawai ON bidang.nip = pegawai.nip")->fetchAll(PDO::FETCH_ASSOC);
     return $this->db->query("SELECT * from bidang")->fetchAll(PDO::FETCH_ASSOC);
    }
	}
  
  public function dataWhere($where)
  {
    return $this->db->select($this->table, "*", $where);
  }
  
  // method untuk menambah data
  public function tambah($data)
  {
    $this->db->insert($this->table, [
      "nip" => $data["nip"],
      "bidang" => $data["bidang"],
      "nama" => $data["nama"]
    ]);
    
    return $this->db->id();
  }
  
  // method untuk edit data
  public function edit($id, $data)
  {
    $this->db->update($this->table, [
      "nip" => $data["nip"],
      "bidang" => $data["bidang"],
      "nama" => $data["nama"]
    ],[
      $this->primaryKey => $id
    ]);
    return true;
  }
  
  // method untuk hapus data
  public function hapus($id)
  {
    $this->db->delete($this->table, [ $this->primaryKey => $id]);
    return true;
  }
  
 
}
