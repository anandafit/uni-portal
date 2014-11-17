<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App extends MY_Controller {
  private $data;

  function __construct()
  {
    parent::__construct();
    $this->load->model('Users_model');
    $this->load->model('Subjects_model');
    $this->load->model('Exams_model');
    $this->load->library('uniportal');
    $this->load->helper(array('form', 'url'));
    if (!$this->uniportal->logged_in()){
      redirect("auth/index");
    }
  }

  public function index() {
    $data  = array();
    $data["authUser"] = $this->session->userdata("auth_user");

    if($data["authUser"]["usertype"] == "ADMIN"){
      $data["teachers"] = $this->Users_model->getUsers("teacher");
      $data["teacherBySubjects"] = $this->Subjects_model->getSubjectByInstructors($data["teachers"], null);
      $data["pendingExams"] = $this->Exams_model->getAllPendingApplication();

    }

    elseif($data["authUser"]["usertype"] == "TEACHER"){
      $data["exams"] = $this->Exams_model->getAllExams(false, false, $data["authUser"]["id"]);
      $data["subjects"] = $this->Subjects_model->getSubjectByInstructors(null,$data["authUser"]["id"]);
      $data["studentSubmissions"] = $this->Exams_model->getAllPendingApplication(false, null, $data["authUser"]["id"]);
    }
    else{
      $data["newExams"] = $this->Exams_model->getNewExamsForStudents();
      $data["myExams"] = $this->Exams_model->getAllPendingApplication(false, $data["authUser"]["id"]);
    }

    $this->load->view('app_view', $data);
  }

  public function assign_subjects(){
    if($this->Subjects_model->assingSubjectToTeachers($this->input->post('subjectsIds'), $this->input->post('teacherId'))){
      $data["success"] = true;
    }else{
      $data["success"] = false;
      $data["message"] = $this->uniportal->errors_array();
    }

    extjs_output($data);
  }

}