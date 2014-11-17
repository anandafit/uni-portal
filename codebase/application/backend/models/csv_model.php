<?php

class Csv_model extends CI_Model {

  function __construct() {
    parent::__construct();
    $this->load->config('uniportal', TRUE);
  }


  function insert_csv($data) {
    $this->db->insert("QUECTIONS", $data);
  }
}
/*END OF FILE*/