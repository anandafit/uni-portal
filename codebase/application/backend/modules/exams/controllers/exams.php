<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Movies
 *
 *
 * @package    CodeIgniter meets ExtJS
 * @subpackage Movies
 * @author     Richard Jäger <richiejaeger@gmail.com>
 */

class Exams extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('Exams_model');
    $this->load->library('uniportal');
    $this->load->model('csv_model');

    if (!$this->uniportal->logged_in()){
      redirect("auth/index");
    }
  }

  /**
   *
   * CREATE an item
   *
   * @return json encoded array (boolean)
   */

  public function create() {
    $this->load->helper('date');
    $filename = explode(".",$_FILES["userfile"]["name"]) ;
    $authUser = $this->session->userdata("auth_user");
    $item_data = array(
      'EXAM_CODE' => $this->input->post('exam_code'),
      'TITLE' => $this->input->post('title'),
      'SUBJECT_CODE' => $this->input->post('subject_code'),
      'YEAR' => $this->input->post('year'),
      'SEMESTER' => $this->input->post('semester'),
      'DUE_DATE' => $this->input->post('due_date'),
      'STATUS' => $this->input->post('status'),
      'DESCRIPTION' => $this->input->post('description'),
      'CREATED_BY' => $authUser["id"]
    );
    $eam_id = $this->input->post('exam_id');
    $flter = array(
      "ID" => intval($eam_id)
    );

    $config['upload_path'] = 'assets/';
    $config['allowed_types'] = 'csv';
    $config['file_name'] = now().".".$filename[1];

    $this->load->library('upload', $config);

    $filename = now();
    if ( ! $this->upload->do_upload())
    {
      $error = array('error' => $this->upload->display_errors());

      if(isset($eam_id) && $eam_id != null){
        $this->Exams_model->update_entry($flter, $item_data);
      }
      redirect('/app', $error);
    }
    else {
      ////////////////////////////////////////////////////////////

      $file_data = $this->upload->data();
      $file_path =  'assets/'.$file_data['file_name'];

      if ($this->csvimport->get_array($file_path,array("QUECTION_REFF_ID", "QUECTION", "ANSWERS", "CORRECT_ANSWERS"), false, false, "|")) {
        $csv_array = $this->csvimport->get_array($file_path);

        //update existing records when cvs upload success
        if(isset($eam_id) && $eam_id != null){
          $this->Exams_model->update_entry($flter, $item_data);

          //remove existing records related to this exam and insert new records
          $this->Exams_model->deleteQuection(array("EXAM_ID" => $eam_id));
        //inset new exam records when cvs upload success
        }else{
          $eam_id = $this->Exams_model->insert_entry($item_data);
        }

        foreach ($csv_array as $row) {
          $insert_data = array(
            'EXAM_ID'=>$eam_id,
            'QUECTION_REFF_ID'=>$row['QUECTION_REFF_ID'],
            'QUECTION'=>$row['QUECTION'],
            'CORRECT_ANSWERS'=>$row['CORRECT_ANSWERS'],
            'ANSWERS'=>$row['ANSWERS'],
          );
          $this->csv_model->insert_csv($insert_data);
        }

        $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
        redirect('/app');
        //echo "<pre>"; print_r($insert_data);
      } else {

        $data['error'] = "Error occured";

      ///////////////////////////////////////////////////////////

      //only update or insert when upload gets failed
      if(isset($eam_id) && $eam_id != null){
        $this->Exams_model->update_entry($flter, $item_data);
      }else{

        $this->Exams_model->insert_entry($item_data);
      }
        $this->load->view('app_view', $data);
      }
    }
  }

  public function exam_subscribe(){
    $authUser = $this->session->userdata("auth_user");
    $dbData = array(
      "USER_ID" => $authUser["id"],
      "EXAMS_ID" => $this->input->post('examId'),
      "STATUS" =>'SUBSCRIBED'
    );

    if($this->Exams_model->subscribeExam($dbData)){
      $data['success'] = true;
    }else{
      $data['success'] = false;
    }

    extjs_output($data);
  }

  function change_subscription(){
    $student_exam_id = $this->input->post("student_exam_id");
    $status = $this->input->post("status");

    $dbData = array(
      "STATUS" => $status
    );

    $filter = array(
      "ID" => $student_exam_id
    );

    if($this->Exams_model->changeSubscriptionStatus($filter, $dbData)){
      $data['success'] = true;
    }else{
      $data['success'] = false;
    }
    extjs_output($data);
  }

  /**
   *
   * READ/RETRIEVE items
   *
   * @return json encoded array (items)
   */

  public function read() {
    $limit = $this->input->get('limit', TRUE) > '' ? $this->input->get('limit', TRUE) : 45;
    $offset = $this->input->get('start', TRUE);

    $sorts = json_decode($this->input->get('sort', TRUE));
    if ($sorts) {
      foreach ($sorts as $sort) {
        $orders[] = $sort->property.' '.$sort->direction;
      }
      $order_by = implode(', ', $orders);
    } else {
      $order_by = 'id asc';
    }

    $total_entries = $this->Movies_model->count_all_entries($filter = array());
    $entries = $this->Movies_model->get_all_entries($filter = array(), $limit, $offset, $order_by);

    $data['success'] = true;
    $data['total'] = $total_entries;
    $data['items'] = $entries;

    extjs_output($data);
  }

  /**
   *
   * UPDATE an item
   *
   * @return json encoded array (boolean)
   */

  public function update() {
    $items = json_decode($this->input->post('items'));

    $filter = array(
      array(
        'field' => 'id',
        'operator' => '=',
        'value' => $items->id ? $items->id : ''
      )
    );

    $item_data = array(
      'title' => $items->title,
      'year' => $items->year,
      'runtime' => $items->runtime,
      'description' => $items->description,
    );

    $insert = $this->Movies_model->update_entry($filter, $item_data);
    if (intval($insert)) {
      $data['success'] = true;
      $data['total'] = 1;
      $data['items'] = $item_data;
    } else {
      $data['success'] = false;
      $data['title'] = 'Fehler';
      $data['message'] = 'Es besteht ein Problem mit der Datenbank.';
    }

    echo json_encode($data);
  }

  /**
   *
   * DESTROY/DELETE an item
   *
   * @return json encoded array (boolean)
   */

  public function destroy() {
    $items = json_decode($this->input->post('items'));

    $filter = array(
      array(
        'field' => 'id',
        'operator' => '=',
        'value' => $items->id ? $items->id : ''
      )
    );

    if ($this->Movies_model->delete_enry($filter)) {
      $data['success'] = true;
    } else {
      $data['success'] = false;
      $data['title'] = 'Fehler';
      $data['message'] = 'Es besteht ein Problem mit der Datenbank.';
    }

    extjs_output($data, 'html');
  }

  public function exam_mark(){
    $this->input->post('st_examId');


  }

}