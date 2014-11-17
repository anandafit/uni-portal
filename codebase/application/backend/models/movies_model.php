<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movies_model extends CI_Model {

	private $table;
	private $table_fields;
	private $table_fields_join;

    function __construct() {
      parent::__construct();
      $this->load->config('uniportal', TRUE);
      $this->table = $this->config->item('tables', 'uniportal');

      $this->table_fields = array(
        $this->table['EXAMS'].'.id',
        $this->table['EXAMS'].'.title',
        $this->table['EXAMS'].'.year',
        $this->table['EXAMS'].'.runtime',
        $this->table['EXAMS'].'.description'
      );

		  $this->table_fields_join = array();
    }

    function get_all_entries($filter = array(), $limit = '45', $offset = '0', $order = '') {
		$this->db->select(implode(', ', array_merge($this->table_fields, $this->table_fields_join)));
		$this->db->from($this->table["EXAMS"]);

		if (is_array($filter) && count($filter) > 0) generate_filter($filter);

		if ($order > '') {
		    $this->db->order_by($order);
		}

		$this->db->limit($limit, $offset);

		$news_db_query = $this->db->get();

		if ($news_db_query->num_rows > 0) {
		    return $news_db_query->result();
		} else {
		    return false;
		}
    }

	function count_all_entries($filter = array()) {
        $this->db->from($this->table["EXAMS"]);

		if (is_array($filter) && count($filter) > 0) generate_filter($filter);

        return $this->db->count_all_results();
    }

    function insert_entry($data) {
        $this->db->insert($this->table["EXAMS"], $data);

        if($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    function update_entry($filter = array(), $data) {
        if (is_array($filter) && count($filter) > 0) generate_filter($filter);

        $this->db->update($this->table["EXAMS"], $data);

        if($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function delete_enry($filter = array()) {
        if (is_array($filter) && count($filter) > 0) generate_filter($filter);

        $this->db->delete($this->table["EXAMS"]);

        if($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}