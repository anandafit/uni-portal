<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exams_model extends CI_Model {

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

//  function get_all_entries($filter = array(), $limit = '45', $offset = '0', $order = '') {
//    $this->db->select(implode(', ', array_merge($this->table_fields, $this->table_fields_join)));
//    $this->db->from($this->table["EXAMS"]);
//
//    if (is_array($filter) && count($filter) > 0) generate_filter($filter);
//
//    if ($order > '') {
//      $this->db->order_by($order);
//    }
//
//    $this->db->limit($limit, $offset);
//
//    $news_db_query = $this->db->get();
//
//    if ($news_db_query->num_rows > 0) {
//      return $news_db_query->result();
//    } else {
//      return false;
//    }
//  }

  function getNewExamsForStudents($approved = false){

    $selected_fields = array(
      $this->table["EXAMS"] . '.ID AS EXAMS_ID',
      $this->table["EXAMS"] . '.YEAR',
      $this->table["EXAMS"] . '.SEMESTER',
      $this->table["EXAMS"] . '.CREATED_BY',
      $this->table["EXAMS"] . '.CREATED_ON',
      $this->table["EXAMS"] . '.DUE_DATE',
      $this->table["EXAMS"] . '.TITLE  AS EXAMS_TITLE',
      $this->table["EXAMS"] . '.STATUS',
      $this->table["EXAMS"] . '.DESCRIPTION',
      $this->table["EXAMS"] . '.FILE_NAME',
      $this->table["EXAMS"] . '.EXAM_CODE',
      $this->table['SUBJECTS'] . '.ID  AS SUBJECTS_ID',
      $this->table['SUBJECTS'] . '.TITLE  AS SUBJECTS_TITLE',
      $this->table["STUDENTS_EXAMS"] . '.ID'
    );

    $this->db->select($selected_fields);

    $this->db->where($this->table["EXAMS"] . '.DUE_DATE >=', date("Y-m-d h:m:s"));
    $this->db->where($this->table["EXAMS"] . '.STATUS =', "PUBLISHED");
    $this->db->where($this->table["STUDENTS_EXAMS"] . '.ID', NULL);

    $this->db->from($this->table["EXAMS"]);
    $this->db->join($this->table['SUBJECTS'], $this->table["EXAMS"] . '.SUBJECT_CODE = '. $this->table['SUBJECTS'] . '.ID', 'left');
    $this->db->join($this->table['STUDENTS_EXAMS'], $this->table["EXAMS"] . '.ID = '. $this->table['STUDENTS_EXAMS'] . '.EXAMS_ID', 'left');

    $query = $this->db->get();
    $result = $query->result_array();

    return $result;
  }

  function getAllExams($includeDraft = false, $examId = null, $teacherId = false) {

    $users_db_search_data = array();
    if($examId !=null){
      $users_db_search_data[ $this->table["EXAMS"] . '.ID'] = $examId;
    }

    if(!$includeDraft){
      $users_db_search_data[ $this->table["EXAMS"] . '.STATUS'] = "PUBLISHED";
    }

    if($teacherId){
      $users_db_search_data[ $this->table["EXAMS"] . '.CREATED_BY'] = $teacherId;
    }

    $selected_fields = array(
      $this->table["EXAMS"] . '.ID AS EXAMS_ID',
      $this->table["EXAMS"] . '.YEAR',
      $this->table["EXAMS"] . '.SEMESTER',
      $this->table["EXAMS"] . '.CREATED_BY',
      $this->table["EXAMS"] . '.CREATED_ON',
      $this->table["EXAMS"] . '.DUE_DATE',
      $this->table["EXAMS"] . '.TITLE  AS EXAMS_TITLE',
      $this->table["EXAMS"] . '.STATUS',
      $this->table["EXAMS"] . '.DESCRIPTION',
      $this->table["EXAMS"] . '.FILE_NAME',
      $this->table["EXAMS"] . '.EXAM_CODE',
      $this->table['SUBJECTS'] . '.ID  AS SUBJECTS_ID',
      $this->table['SUBJECTS'] . '.TITLE  AS SUBJECTS_TITLE',
    );

    $this->db->select($selected_fields);
    if(!empty($users_db_search_data)){
      $this->db->where($users_db_search_data);
    }

    $this->db->from($this->table["EXAMS"]);
    $this->db->join($this->table['SUBJECTS'], $this->table["EXAMS"] . '.SUBJECT_CODE = '. $this->table['SUBJECTS'] . '.ID', 'left');

    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
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

  function subscribeExam($data){
    $this->db->insert($this->table["STUDENTS_EXAMS"], $data);

    if($this->db->affected_rows() == 1) {
      return $this->db->insert_id();
    } else {
      return false;
    }
  }

  function getAllPendingApplication($foradmin = true, $studentId = null, $teacherId = null){
    if($foradmin){
      $users_db_search_data[ $this->table["STUDENTS_EXAMS"] . '.STATUS'] = "SUBSCRIBED";
    }elseif($teacherId !=null){
//      $users_db_search_data[$this->table["EXAMS"] . '.CREATED_BY'] = $teacherId;
//      $users_db_search_data[ $this->table["STUDENTS_EXAMS"] . '.STATUS'] = "";
      $users_db_search_data =  "(".$this->table["STUDENTS_EXAMS"].".STATUS='WRITING' OR ".$this->table["STUDENTS_EXAMS"].".STATUS='SUBMITTED' OR ".$this->table["STUDENTS_EXAMS"].".STATUS='MARKED') AND ".$this->table["EXAMS"].".CREATED_BY=".intval($teacherId);
    }
    elseif($studentId !=null){
      $users_db_search_data[$this->table["USERS"] . '.ID'] = $studentId;
    }

    $selected_fields = array(
      $this->table["STUDENTS_EXAMS"] . '.ID',
      $this->table["USERS"] . '.FIRST_NAME',
      $this->table["USERS"] . '.MIDDLE_NAME',
      $this->table["USERS"] . '.LAST_NAME',
      $this->table["USERS"] . '.ID AS SID',
      $this->table["EXAMS"] . '.ID AS EID',
      $this->table["EXAMS"] . '.DUE_DATE',
      $this->table["EXAMS"] . '.TITLE  AS EXAMS_TITLE',
      $this->table["SUBJECTS"] . '.TITLE  AS SUBJECT_TITLE',
      $this->table["STUDENTS_EXAMS"] . '.STATUS',
      $this->table["STUDENTS_EXAMS"] . '.MARKS'
//      "CASE
//  WHEN EXAMS.DUE_DATE < ".date("Y-m-d h:m:s")." THEN '1'
// ELSE '0'
// END as IS_DUE"
    );

    $this->db->select($selected_fields);
    $this->db->where($users_db_search_data);


    $this->db->from($this->table["STUDENTS_EXAMS"]);
    $this->db->join($this->table['USERS'], $this->table["USERS"] . '.ID = '. $this->table['STUDENTS_EXAMS'] . '.USER_ID', 'left');
    $this->db->join($this->table['EXAMS'], $this->table["EXAMS"] . '.ID = '. $this->table['STUDENTS_EXAMS'] . '.EXAMS_ID', 'left');
    $this->db->join($this->table['SUBJECTS'], $this->table["SUBJECTS"] . '.ID = '. $this->table['EXAMS'] . '.SUBJECT_CODE', 'left');

    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  function changeSubscriptionStatus($filter, $data){
    if (is_array($filter) && count($filter) > 0) generate_filter($filter);
    $this->db->update($this->table["STUDENTS_EXAMS"], $data, $filter);

    if($this->db->affected_rows() == 1) {
      return true;
    } else {
      return false;
    }
  }

  function update_entry($filter = array(), $data) {
    if (is_array($filter) && count($filter) > 0) generate_filter($filter);
    $this->db->update($this->table["EXAMS"], $data, $filter);

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


  function deleteQuection($filter = array()) {
    if (is_array($filter) && count($filter) > 0) generate_filter($filter);

    $this->db->where($filter);
    $this->db->delete($this->table["QUECTIONS"]);

    if($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  function deleteExistingAnserwers($filter = array()) {
    if (is_array($filter) && count($filter) > 0) generate_filter($filter);

    $this->db->where($filter);
    $this->db->delete($this->table["ANSWERS"]);

    if($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  function getAllExamQuections($exam_id, $quection_id = null, $st_ex_id= 0){
    $selected_fields = array(
      $this->table["QUECTIONS"] . '.ID',
      $this->table["QUECTIONS"] . '.EXAM_ID',
      $this->table["QUECTIONS"] . '.QUECTION_REFF_ID',
      $this->table["QUECTIONS"] . '.QUECTION',
      $this->table["QUECTIONS"] . '.ANSWERS',
      $this->table["QUECTIONS"] . '.CORRECT_ANSWERS',
      $this->table['ANSWERS'] . '.ANSWER AS ST_ANSWER',
    );

    $this->db->select($selected_fields);
    if($exam_id != null){
      $this->db->where("EXAM_ID =", $exam_id);
    }

    if($quection_id !=null){
      $this->db->where("ID =", $quection_id);
    }

    $this->db->from($this->table["QUECTIONS"]);
//    $this->db->join($this->table['ANSWERS'], $this->table["ANSWERS"] . '.QUECTION_ID = '. $this->table['QUECTIONS'] . '.ID AND '.$this->table["ANSWERS"] . '.STUDENT_EXAM_ID ='.$st_ex_id, 'left');
    $this->db->join($this->table['ANSWERS'], "ANSWERS.QUECTION_ID = QUECTIONS.ID AND ANSWERS.STUDENT_EXAM_ID = ".$st_ex_id, 'left');

    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  function addAnserwers($data){
    $this->db->insert($this->table["ANSWERS"], $data);
  }

}