<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller {
  private $data;

  function __construct()
  {
    parent::__construct();
    $this->load->model('Users_model');
    $this->load->library('form_validation');
    $this->load->library('uniportal');
    $this->load->config('uniportal', TRUE);
    $this->load->helper('cookie');
    $data = array();
  }

	public function index() {
    if($this->session->userdata(APP_NAME.'_access')){
      redirect('start/', 'refresh');
    }else{
      $this->load->view('login');
    }
	}

  public function signup() {
    $this->load->view('register');
  }

	public function login() {
    $user_data = $this->Users_model->check_login($this->input->post('username'), $this->input->post('password'));
    if($user_data){
    $this->session->set_userdata(array(APP_NAME.'_access' => true));
    $this->session->set_userdata("auth_user", $user_data);

    $cookie = array(
      'name'   => 'auth_user',
      'value'  => json_encode($user_data),
      'expire' => time()+86500
    );
      $this->input->set_cookie($cookie);

			$data['success'] = true;
		} else {
			$data['success'] = false;
		}
		extjs_output($data);
	}

	public function logout() {
		$this->session->unset_userdata(APP_NAME.'_access');
		delete_cookie(APP_NAME.'_access');
		redirect('/auth', 'refresh');
	}

  public function create_user(){
    $userTypeInfo = Array();
    //validate register form input

    //validate user info
    $this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
    $this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
    $this->form_validation->set_rules('middle_name', 'Middle Name', 'required|xss_clean');
    $this->form_validation->set_rules('gender', 'Gender', 'required');
    $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
    $this->form_validation->set_rules('date_birth', 'Date of birth', 'required');
    $this->form_validation->set_rules('marital_status', 'Marital status', 'required');

    //account info
    $this->form_validation->set_rules('username', 'Username', 'required|xss_clean|min_length[4]|max_length[20]');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|matches[password_confirm]');
    $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');

    //user type
    $this->form_validation->set_rules('user_type', 'User Type', 'required');
    if($this->input->post('user_type') == "Teacher"){
      //teacher info
      $this->form_validation->set_rules('employee_no', 'Employee no', 'required');
      $userTypeInfo['academic_year'] = "N/A";
      $userTypeInfo['registration_no'] = "N/A";
      $userTypeInfo['employee_no'] = $this->input->post('employee_no');

    }else{
      //student info
      $this->form_validation->set_rules('registration_no', 'Registration no', 'required');
      $this->form_validation->set_rules('academic_year', 'Academic year', 'required');
      $userTypeInfo['academic_year'] = $this->input->post('academic_year');
      $userTypeInfo['registration_no'] = $this->input->post('registration_no');
      $userTypeInfo['employee_no'] = "N/A";

    }

    if ($this->form_validation->run() == true)
    {
      $username = $this->input->post('username');
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $user_type = $this->input->post('user_type');

      $additional_data = array(
        'first_name' => $this->input->post('first_name'),
        'last_name' => $this->input->post('last_name'),
        'middle_name' => $this->input->post('middle_name'),
        'gender' => strtoupper($this->input->post('gender')),
        'date_birth' => $this->input->post('date_birth'),
        'marital_status' => strtoupper($this->input->post('marital_status')),
        'academic_year' => $userTypeInfo["academic_year"],
        'registration_no' => $userTypeInfo["registration_no"],
        'employee_no' => $userTypeInfo["employee_no"]
      );

      if($this->Users_model->createUser($username, $password, $email, $user_type, $additional_data)){
        $data["success"] = true;
      }else{
        $data["success"] = false;
        $data["message"] = $this->uniportal->errors_array();
      }
    }else{
      $data["message"] = $this->form_validation->error_array();
      $data["success"] = false;
    }
    extjs_output($data);
  }

  /**
   * get the already authencticated uer
   */
  public function get_authenticated_user(){
    $data = Array();
    $data["items"] = $this->session->userdata("auth_user");
    $data['success'] = true;
    extjs_output($data);
  }
}