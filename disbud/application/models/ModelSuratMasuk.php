<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelSuratMasuk extends MY_Model {
  // Nama Tabel
  private $table = "suratmasuk";      // nama tabelnya
  private $primaryKey = "id"; // primary keynya
  
  
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
      return $this->db->query("SELECT a.*, b.bidang FROM suratmasuk a JOIN bidang b ON a.id_bidang = b.id")->fetchAll(PDO::FETCH_ASSOC);
    }
	}
  public function dataWhere($where)
  {
    return $this->db->select($this->table, ["[><]bidang" => ["id_bidang" => "id"]], "*", $where);
  }
  
  // method untuk menambah data
  public function tambah($data)
  {
    $data_tmp = [
      "nomorsm" => $data["nomorsm"],
      "tglsurat" => $data["tglsurat"],
      "tglditerima" => $data["tglditerima"],
      "asalsurat" => $data["asalsurat"],
      "email" => $data["email"],
      "perihalsurat" => $data["perihalsurat"],
      "alamatsurat" => $data["alamatsurat"],
      "kodepos" => $data["kodepos"],
      "website" => $data["website"],
      "ket" => $data["ket"]
    ];
    if(isset($data['filesurat']) || !empty($data['filesurat']))
    {
      $data_tmp["filesurat"] = $data["filesurat"];
    }
    $this->db->insert($this->table, $data_tmp);
    
    return $this->db->id();
  }
  
  // method untuk edit data
  public function edit($id, $data)
  {
    $data_tmp = [
      "nomorsm" => $data["nomorsm"],
      "tglsurat" => $data["tglsurat"],
      "tglditerima" => $data["tglditerima"],
      "asalsurat" => $data["asalsurat"],
      "email" => $data["email"],
      "perihalsurat" => $data["perihalsurat"],
      "alamatsurat" => $data["alamatsurat"],
      "kodepos" => $data["kodepos"],
      "website" => $data["website"],
      "ket" => $data["ket"]
    ];
    if(isset($data['filesurat']) || !empty($data['filesurat']))
    {
      $data_tmp["filesurat"] = $data["filesurat"];
    }
    $this->db->update($this->table, $data_tmp,[
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
  
  public function dataDisposisi()
	{
    return $this->db->query("SELECT a.*, b.bidang FROM suratmasuk a JOIN bidang b ON a.id_bidang = b.id WHERE a.status = 'Belum Di disposisi'")->fetchAll(PDO::FETCH_ASSOC);
	}
  
  public function prosesDisposisi($id, $data)
  {
    $this->db->update($this->table, [
      "ket" => $data['ket'],
      "id_bidang" => $data['id_bidang'],
      "status" => $data['status'],
      "isidisposisi" => $data['isidisposisi'],
      "tgldisposisi" => $data['tgldisposisi']
    ],[
      $this->primaryKey => $id
    ]);
    return true;
  }
  
  public function dataStatistikSuratMasuk($id_bidang = null)
  {
    $data = [];
    if($id_bidang == null)
    {
      $data = $this->db->query("
                SELECT 
                (SELECT COUNT(id) FROM suratmasuk WHERE status = 'Belum Di Disposisi') AS belum,
                (SELECT COUNT(id) FROM suratmasuk WHERE status = 'acc') AS acc,
                (SELECT COUNT(id) FROM suratmasuk WHERE status = 'ditolak') AS ditolak;
              ")->fetch(PDO::FETCH_ASSOC);
    }
    else
    {
      $data = $this->db->query("
                                  SELECT 
                                  (SELECT COUNT(id) FROM suratmasuk WHERE status = 'Belum Di Disposisi') AS belum,
                                  (SELECT COUNT(id) FROM suratmasuk WHERE status = 'acc' AND id_bidang = ".$id_bidang.") AS acc,
                                  (SELECT COUNT(id) FROM suratmasuk WHERE status = 'ditolak' AND id_bidang = ".$id_bidang.") AS ditolak;
                                ")->fetch(PDO::FETCH_ASSOC);
    }
    return $data;
  }
  public function hitungBanyakSuratMasuk()
  {
  	return $this->db->count($this->table, ["status" => "Belum Di disposisi"]);
  }
  public function suratYangBelumDidisposisi()
  {
  	return $this->db->select($this->table, "*", ["status" => "Belum Di disposisi"]);
  }

  public function jumlah()
  {
    return $this->db->count($this->table, ["status" => "Acc"]);
  }
  
 
}
