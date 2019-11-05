<?php
use Medoo\Medoo;

class MY_Model extends CI_Model {
	protected $db;
  function __construct()
  {
    parent::__construct();
    $this->db = new Medoo([
      'database_type' => 'mysql',
      'database_name' => 'dinas_kominfo',
      'server' => 'localhost',
      'username' => 'root',
      'password' => ''
    ]);
  }
}
