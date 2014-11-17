<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Subjects_model extends CI_Model
{

  private $table;

  function __construct()
  {
    parent::__construct();

    $this->load->config('uniportal', TRUE);
    $this->table = $this->config->item('tables', 'uniportal');
    $this->load->helper('date');
  }

  function getSubjectByInstructors($teachers, $teacherId = null){

    if($teacherId !=null){
      $users_db_search_data = array(

      );
    }else{
      $users_db_search_data = array(
        $this->table['TEACHERS_SUBJECTS'] . '.TEACHER_ID' => $teacherId,
      );
    }

    $selected_fields = array(
      $this->table['TEACHERS_SUBJECTS'] . '.TEACHER_ID AS TTEACHER_ID',
      $this->table['TEACHERS_SUBJECTS'] . '.SUBJECT_ID  AS TSUBJECT_ID',
      $this->table['TEACHERS_SUBJECTS'] . '.TEACHER_ID  AS TTEACHER_ID',
      $this->table['SUBJECTS'] . '.ID  AS SID',
      $this->table['SUBJECTS'] . '.TITLE  AS STITLE',
    );

    $this->db->select($selected_fields);
    if($teacherId !=null){
      $this->db->where($users_db_search_data);
    }

    $this->db->from($this->table['TEACHERS_SUBJECTS']);
    $this->db->join($this->table['SUBJECTS'], $this->table['TEACHERS_SUBJECTS'] . '.SUBJECT_ID = '. $this->table['SUBJECTS'] . '.ID', 'left');

    $query = $this->db->get();
    $result = $query->result_array();

    if($teachers == null){
      $assingedSubject = array();
      foreach($result as &$row){
        array_push($assingedSubject, array(
          "SID" => $row["SID"],
          "STITLE" => $row["STITLE"]
        ));
      }
      return $assingedSubject;
    }else{
      $teachersSubject = array();
      $teachersSubjectSt = array();
      foreach($teachers as &$teacher){
        $teachersSubject[$teacher["ID"]] = "";
        $teachersSubjectSt[$teacher["ID"]] = "";
      }

      foreach($result as &$row){
        if($row["TTEACHER_ID"]!=null){
          $teachersSubject[$row["TTEACHER_ID"]] .=  $row["SID"].",";
          $teachersSubjectSt[$row["TTEACHER_ID"]] .=  $row["STITLE"].",";
        }
      }
      return array("SIDS"=>$teachersSubject, "STITLES" =>$teachersSubjectSt);
    }


  }

  function assingSubjectToTeachers($subjectCodes, $tacherId){
    $data = array();
    //delete existing ones;
    $this->db->delete( $this->table['TEACHERS_SUBJECTS'], array('TEACHER_ID' => $tacherId));

    //inset new records
    foreach ($subjectCodes as &$subjectCode){
      array_push($data,
        array(
          $this->table['TEACHERS_SUBJECTS'] . '.TEACHER_ID' => $tacherId ,
          $this->table['TEACHERS_SUBJECTS'] . '.SUBJECT_ID' => $subjectCode ,
        )
      );
    }
    $this->db->insert_batch($this->table['TEACHERS_SUBJECTS'], $data);
    return true;
  }

}