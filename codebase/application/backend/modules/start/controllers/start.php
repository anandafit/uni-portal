<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Start extends MY_Controller {
  function __construct()
  {
    parent::__construct();
    $this->load->library('uniportal');
  }

	public function index(){
    if ($this->uniportal->logged_in()){
      redirect("app/index");
    }else{
      redirect("auth/index");
    }
	}

}