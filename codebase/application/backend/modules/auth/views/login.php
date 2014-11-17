<!DOCTYPE html>

<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="http://getbootstrap.com/assets/ico/favicon.ico">

  <title>User signin</title>

  <!-- Bootstrap core CSS -->
  <link href="<?= $this->config->item('assets_url'); ?>/dist/css/bootstrap-combined.min.css" rel="stylesheet">
  <link href="<?= $this->config->item('assets_url'); ?>/dist/css/datepicker.css" rel="stylesheet">

  <!--  Custom css-->
  <link href="<?= $this->config->item('assets_url'); ?>/css/signin.css" rel="stylesheet">
  <link href="<?= $this->config->item('assets_url'); ?>/css/master.css" rel="stylesheet">

  <script src="<?= $this->config->item('assets_url'); ?>/dist/js/jquery-2.1.1.min.js"></script>
  <script src="<?= $this->config->item('assets_url'); ?>/dist/js/jquery-validation-1.12.0/dist/jquery.validate.min.js"></script>


  <script src="<?= $this->config->item('assets_url'); ?>/dist/js/bootstrap.min.js"></script>
  <script src="<?= $this->config->item('assets_url'); ?>/dist/js/bootstrap-datepicker.js"></script>

  <script src="<?= $this->config->item('assets_url'); ?>/appjs/login.js"></script>

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>

<div class="container">
    <div class="row">
      <div class="span12">
        <div class="" id="loginModal">
          <div class="modal-header">
<!--            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
            <h3>University Web Portal</h3>
          </div>
          <div class="modal-body" id="signin-cont">

              <ul class="nav nav-tabs">
                <li class="active"><a href="#login" data-toggle="tab">Login</a></li>
                <li><a href="#create" data-toggle="tab">Create Account</a></li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="login">
                  <div class="alert alert-error" id="login-alert-error">

                    <strong>Error!</strong>
                    <div class="message"></div>
                  </div>
                  <form id="form-login" action='#' method="POST">
                    <fieldset>
                      <div id="legend">
                        <legend class="">Login</legend>
                      </div>
                      <div class="control-group">
                        <!-- Username -->
                        <label class="control-label"  for="username">Username</label>
                        <div class="controls">
                          <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
                        </div>
                      </div>

                      <div class="control-group">
                        <!-- Password-->
                        <label class="control-label" for="password">Password</label>
                        <div class="controls">
                          <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
                        </div>
                      </div>


                      <div class="control-group">
                        <!-- Button -->
                        <div class="controls">
                          <button class="btn btn-success" id="but-login">Login</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
                <div class="tab-pane fade" id="create">

                  <div class="alert alert-error" id="register-alert-error">

                    <strong>Error!</strong>
                    <div class="message"></div>
                  </div>

                  <form id="form-register">
                    <div class="col-md-2">
                      <label>First Name</label>
                      <input type="text" name="first_name" id="first_name" value="" class="input-xlarge">
                      <label>Middle Name</label>
                      <input type="text" name="middle_name" id="middle_name" value="" class="input-xlarge">
                      <label>Last Name</label>
                      <input type="text" name="last_name" id="last_name" value="" class="input-xlarge">
                      <label>Gender</label>
                      <select class="selectpicker" id="gender" name="gender">
                        <option>Male</option>
                        <option>Female</option>
                      </select>


                      <label>Date of Birth</label>
                      <div class="input-append date" id="date_birth_cont" data-date-format="yyyy-mm-dd">
                        <input class="span2" size="16" type="text" value="" name="date_birth" id="date_birth" contenteditable="false">
                        <span style="display: none" class="add-on"></span>
                      </div>

                      <label>Marital status</label>
                      <select class="selectpicker" name="marital_status" id="marital_status">
                        <option>Singal</option>
                        <option>Married</option>
                        <option>Widowed</option>
                        <option>Divorced</option>
                      </select>
                    </div>
                    <div class="col-md-10">
                      <label>User Name</label>
                      <input type="text" name="reusername" id="reusername" value="" class="input-xlarge">
                      <label>Password</label>
                      <input type="password" name="repassword" id="repassword" value="" class="input-xlarge">
                      <label>Confirm password</label>
                      <input type="password" name="password_confirm" id="password_confirm" value="" class="input-xlarge">
                      <label>Email</label>
                      <input type="text" name="email" id="email" value="" class="input-xlarge">
                      <label>User type</label>
                      <select class="selectpicker" name="user_type" id="user_type">
                        <option>Student</option>
                        <option>Teacher</option>
                      </select>
                      <div id="teacher-info" style="display: none">
                        <label>Employee No</label>
                        <input type="text" name="employee_no" id="employee_no" value="" class="input-xlarge">
                      </div>
                      <div id="student-info">
                        <label>Academic year</label>
                        <select class="selectpicker" name="academic_year" id="academic_year">
                          <option>2010</option>
                          <option>2011</option>
                          <option>2012</option>
                          <option>2013</option>
                          <option>2014</option>
                          <option>2015</option>
                          <option>2016</option>
                          <option>2017</option>
                          <option>2018</option>
                          <option>2019</option>
                          <option>2020</option>
                        </select>

                        <label>Registration No</label>
                        <input type="text" name="registration_no" id="registration_no" value="" class="input-xlarge">
                      </div>
                      <div>
                        <button class="btn btn-primary">Create Account</button>
                      </div>
                    </div>



                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<div id="footer" style="background-color: #000000; padding-top: 7px">
  <div class="container" style="text-align: center">
    <p class="text-muted">All right reserved.</p>
  </div>
</div>
</body>
</html>
