<?php


class Upload extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Exams_model');
    $this->load->library('uniportal');
    $this->load->model('csv_model');

    if (!$this->uniportal->logged_in()){
      redirect("auth/index");
    }
  }

  public function go_to_exam($ex_id, $st_ex_id, $st_ex_status){
    $data = array();
    $examQuections = null;
    //start first time
    $examQuections = $this->Exams_model->getAllExamQuections($ex_id, null, $st_ex_id);
    $data["examInfo"] = $this->Exams_model->getAllExams(false, $ex_id);

    $data["quections"] = $examQuections;
    $data["exam_id"] = $ex_id;
    $data["st_ex_id"] = $st_ex_id;

    $this->load->view('upload_form', $data);
  }

  public function save_paper(){
    $exam_id = $this->input->post('exam_id');
    $st_exam_id = $this->input->post('st_exam_id');

    $examQuections = $this->Exams_model->getAllExamQuections($exam_id);
//    var_dump($examQuections);
    $numOfCorrectAns = 0;

//    $anserwers = array();
    $qCount = 0;

    //delete existing answers
    $this->Exams_model->deleteExistingAnserwers(array(
      "STUDENT_EXAM_ID" => $st_exam_id
    ));

    foreach($examQuections as $examQuection){
      $qCount++;
      $st_anserwer = $this->input->post('answer-'.$examQuection["ID"]);
      if(trim($st_anserwer) == trim($examQuection["CORRECT_ANSWERS"])){
        $numOfCorrectAns++;
      }


      //insert for student answers
      if(!(!isset($st_anserwer) || $st_anserwer == null || trim($st_anserwer) == "")){
        $this->Exams_model->addAnserwers(array(
          'ANSWER'=>trim($st_anserwer),
          'STUDENT_EXAM_ID'=>$st_exam_id,
          'QUECTION_ID'=>$examQuection["ID"],
        ));
      }

    }

    $marks = intval(100 * $numOfCorrectAns/$qCount);
    $this->Exams_model->changeSubscriptionStatus(array(
        "ID" => $st_exam_id
      ), array(
        "MARKS" => $marks,
        "STATUS" => "SUBMITTED"
    ));

    $examQuections = $this->Exams_model->getAllExamQuections($exam_id, null, $st_exam_id);

    $data["examInfo"] = $this->Exams_model->getAllExams(false, $exam_id);
    $data["quections"] = $examQuections;
    $data["exam_id"] = $exam_id;
    $data["st_ex_id"] = $st_exam_id;

    $this->load->view('upload_form', $data);

  }

}
?>