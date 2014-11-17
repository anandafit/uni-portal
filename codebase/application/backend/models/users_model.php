<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model
{

  private $table;

  function __construct()
  {
    parent::__construct();

    $this->load->config('uniportal', TRUE);
    $this->table = $this->config->item('tables', 'uniportal');
    $this->load->helper('date');
  }

  function check_login($username, $password, $decode_pass = true)
  {
    $password = $decode_pass ? sha1($password) : $password;
    $users_db_search_data = array(
      $this->table['USERS'] . '.USERNAME' => $username,
        $this->table['USERS'] . '.PASSWORD' => $password,
    );

    $this->db->select($this->table['USERS'].'.*');
    $this->db->where($users_db_search_data);
    $this->db->from($this->table['USERS']);
    $query = $this->db->get();
    $result = $query->row();

    if ($query->num_rows == 1) {
      $name= "";
      if($result->FIRST_NAME != null && count(trim($result->FIRST_NAME))>0){
        $name = $result->FIRST_NAME." ";
      }

      if($result->MIDDLE_NAME != null && count(trim($result->MIDDLE_NAME))>0){
        $name = $name.$result->MIDDLE_NAME." ";
      }

      if($result->LAST_NAME != null && count(trim($result->LAST_NAME))>0){
        $name = $name.$result->LAST_NAME;
      }

      $session_data = array(
        "username" => $result->USERNAME,
        'id' => $result->ID, //kept for backwards compatibility
        'usertype' => $result->USERTYPE, //everyone likes to overwrite id so we'll use user_id
        'name' => $name,
        'active' => $result->ACTIVE
      );
      return $session_data;
    } else {
      return false;
    }
  }

  function userdata_by_id($id)
  {
    $users_db_search_data = array(
        $this->table['USERS'] . '.ID' => $id,
    );

    $this->db->where($users_db_search_data);
    $this->db->from($this->table['USERS']);
    $users_db_query = $this->db->get();

    if ($users_db_query->num_rows == 1) {
      return $users_db_query;
    } else {
      return false;
    }
  }


  /**
   * Checks email
   *
   * @return bool
   * @author Mathew
   * */
  public function email_check($email = '')
  {
    if (empty($email)) {
      return FALSE;
    }
    return $this->db->where('EMAIL', $email)
      ->count_all_results($this->table['USERS']) > 0;
  }

  /**
   * Checks username
   *
   * @return bool
   * @author Mathew
   * */
  public function username_check($username = '')
  {
    if (empty($username)) {
      return FALSE;
    }

    return $this->db->where('USERNAME', $username)
      ->count_all_results($this->table['USERS']) > 0;
  }

  /**
   * Register both student and teachers
   * @param $username
   * @param $password
   * @param $email
   * @param $user_type
   * @param $additional_data
   * @return bool
   */
  function createUser($username, $password, $email, $user_type, $additional_data)
  {

    //check email avialability
    if ($this->email_check($email)) {
      $this->uniportal->set_error('Email already exist.');
      return FALSE;
    }

    //check username avialability
    if ($this->username_check($username)) {
      $this->uniportal->set_error('User name already exit.');
      return FALSE;
    }

    $password = sha1($password);

    // USERS table.
    $data = array(
      'USERNAME' => $username,
      'PASSWORD' => $password,
      'EMAIL' => $email,
      'USERTYPE' => $user_type,
      'FIRST_NAME' => $additional_data['first_name'],
      'MIDDLE_NAME' => $additional_data['middle_name'],
      'LAST_NAME' => $additional_data['last_name'],
      'GENDER' => $additional_data['gender'],
      'DATE_BIRTH' => $additional_data['date_birth'],
      'MARITAL_STAUS' => $additional_data['marital_staus'],
      'ACADEMIC_YEAR' => $additional_data['academic_year'],
      'REGISTRATION_NUMBER' => $additional_data['registration_no'],
      'EMPLOYEE_NUMBER' => $additional_data['employee_no'],
      'CREATED_ON' => now(),
      'LAST_LOGIN' => now(),
      'ACTIVE' => 1,
    );

    $this->db->insert($this->table['USERS'], $data);

    // Meta table.
    $id = $this->db->insert_id();
    return $this->db->affected_rows() > 0 ? $id : false;
  }


  function getUsers($type){

    $users_db_search_data = array(
      $this->table['USERS'] . '.USERTYPE' => strtoupper($type),
    );

    $selected_fields = array(
      'ID',
      'USERNAME',
      'FIRST_NAME',
      'MIDDLE_NAME',
      'LAST_NAME',
      'EMPLOYEE_NUMBER',
      'ACTIVE',
    );

    $this->db->select($selected_fields);
    $this->db->where($users_db_search_data);
    $this->db->from($this->table['USERS']);

    $query = $this->db->get();
    $result = $query->result_array();


    return $result;
  }
}