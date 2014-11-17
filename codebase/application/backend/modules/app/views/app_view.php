<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dashboard - SB Admin</title>


  <!-- Bootstrap core CSS -->
  <link href="<?= $this->config->item('assets_url'); ?>/dist/css/bootstrap.css" rel="stylesheet">

  <!-- Add custom CSS here -->
  <link href="<?= $this->config->item('assets_url'); ?>/dist/css/bootstrap-multiselect.css" rel="stylesheet">
  <link href="<?= $this->config->item('assets_url'); ?>/dist/css/morris-0.4.3.min.css" rel="stylesheet">
  <link href="<?= $this->config->item('assets_url'); ?>/css/sb-admin.css" rel="stylesheet">
  <link href="<?= $this->config->item('assets_url'); ?>/css/master.css" rel="stylesheet">
  <link href="<?= $this->config->item('assets_url'); ?>/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?= $this->config->item('assets_url'); ?>/dist/css/bootstrap-datetimepicker.css" rel="stylesheet">

</head>

<body>

<div id="wrapper">

<!-- Sidebar -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="/app">University Web Protal - <?php echo $authUser["usertype"] ?></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav type-<?= $authUser["usertype"] ?>" >

      <!--      admin tabs-->
      <?php
      if($authUser["usertype"] == "ADMIN"){
      ?>
        <li class="active" id="web-tab-teacher-li"><a href="#"><i class="fa fa-dashboard"></i>Teachers</a></li>
        <li id="web-tab-applications-li"><a href="#"><i class="fa fa-bar-chart-o"></i> Applicaions</a></li>
      <?php
      }
      ?>

      <!--      teachers tabs-->
      <?php
      if($authUser["usertype"] == "TEACHER"){
        ?>
        <li class="active" id="web-tab-teacher-exams-li"><a href="#"><i class="fa fa-dashboard"></i>My Papers</a></li>
        <li id="web-tab-student-submissions-li"><a href="#"><i class="fa fa-bar-chart-o"></i> Submissions</a></li>
      <?php
      }
      ?>

      <!--      students  tabs-->
      <?php
      if($authUser["usertype"] == "STUDENT"){
        ?>
        <li class="active" id="web-tab-new-exams-li"><a href="#"><i class="fa fa-dashboard"></i>New Exams</a></li>
        <li id="web-tab-previous-exams-result-li"><a href="#"><i class="fa fa-bar-chart-o"></i>My Exams</a></li>
      <?php
      }
      ?>


    </ul>

    <ul class="nav navbar-nav navbar-right navbar-user">
      <li class="dropdown messages-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge">7</span> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li class="dropdown-header">7 New Messages</li>
<!--          <li class="message-preview">-->
<!--            <a href="#">-->
<!--              <span class="avatar"><img src="http://placehold.it/50x50"></span>-->
<!--              <span class="name">John Smith:</span>-->
<!--              <span class="message">Hey there, I wanted to ask you something...</span>-->
<!--              <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>-->
<!--            </a>-->
<!--          </li>-->
<!--          <li class="divider"></li>-->
<!--          <li class="message-preview">-->
<!--            <a href="#">-->
<!--              <span class="avatar"><img src="http://placehold.it/50x50"></span>-->
<!--              <span class="name">John Smith:</span>-->
<!--              <span class="message">Hey there, I wanted to ask you something...</span>-->
<!--              <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>-->
<!--            </a>-->
<!--          </li>-->
<!--          <li class="divider"></li>-->
<!--          <li class="message-preview">-->
<!--            <a href="#">-->
<!--              <span class="avatar"><img src="http://placehold.it/50x50"></span>-->
<!--              <span class="name">John Smith:</span>-->
<!--              <span class="message">Hey there, I wanted to ask you something...</span>-->
<!--              <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>-->
<!--            </a>-->
<!--          </li>-->
          <li class="divider"></li>
          <li><a href="#">View Inbox <span class="badge">7</span></a></li>
        </ul>
      </li>
      <li class="dropdown hide-eara">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>
        <ul class="dropdown-menu hide-eara">
<!--          <li><a href="#">Default <span class="label label-default">Default</span></a></li>-->
<!--          <li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>-->
<!--          <li><a href="#">Success <span class="label label-success">Success</span></a></li>-->
<!--          <li><a href="#">Info <span class="label label-info">Info</span></a></li>-->
<!--          <li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>-->
<!--          <li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>-->
<!--          <li class="divider"></li>-->
<!--          <li><a href="#">View All</a></li>-->
        </ul>
      </li>
      <li class="dropdown user-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $authUser["name"] ?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li class="hide-eara"><a href="#"><i class="fa fa-user"></i> Profile</a></li>
          <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
          <li class="hide-eara"><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
          <li class="divider"></li>
          <li><a href="/auth/logout"><i class="fa fa-power-off"></i> Log Out</a></li>
        </ul>
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">

  <!-- Modal select teacher subjects -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Select subjects</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <input type="hidden" id="subjeccts-group-teacher-id">
            <div class="checkbox">
              <label>
                <input type="checkbox" class="subjeccts-group" code="botany" value="1" name="sb-botany">
                Botany
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" class="subjeccts-group" code="chemistry" value="2" name="sb-chemistry">
                Chemistry
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" class="subjeccts-group" code="computer-science" value="3" name="sb-computer-science">
                Computer Science
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" class="subjeccts-group" code="geology" value="4"  name="sb-geology">
                Geology
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" class="subjeccts-group" code="mathematics" value="5" name="sb-mathematics">
                Mathematics
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" class="subjeccts-group" code="molecular-biology" value="6" name="sb-molecular-biology">
                Molecular biology
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" class="subjeccts-group" code="physics" value="7" name="sb-physics">
                Physics
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" class="subjeccts-group" code="statistics" value="8" name="sb-statistics">
                Statistics
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" class="subjeccts-group" code="zoology" value="9" name="sb-zoology">
                Zoology
              </label>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="teacher-subjects-cancel">Close</button>
          <button type="button" class="btn btn-primary" id="teacher-subjects">Save changes</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal Subscribe to exam -->
  <div class="modal fade" id="exam-subscribe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Subscribe confirmation</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="selected-exam-subscribe">
          <p>After subscribe for exam university will approve it. Do you really want to subscribe for this exam?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="new-exam-subscribe-cancel">No</button>
          <button type="button" class="btn btn-primary" id="new-exam-subscribe">Yes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Subscribe to exam -->
  <div class="modal fade" id="exam-approve" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Approve?</h4>
        </div>
        <div class="modal-body">
          <p>With the aprovel of the admin only student can face to their examinations. Do you really want allow this student to sit for the exam? </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="exam-approve-cancel">No</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="exam-approve-confirm">Yes</button>
        </div>
      </div>
    </div>
  </div>

  <div class="web-tab" id="web-tab-teacher-li-tab" style="display: NONE">
    <div class="row">
      <div class="col-lg-12">
        <h1><small>Registered Teachers</small></h1>
      </div>
    </div><!-- /.row -->

    <div class="row">
      <div class="panel panel-primary filterable">
        <div class="panel-heading">
          <h3 class="panel-title">Teachers</h3>
          <div class="pull-right">
            <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
          </div>
        </div>


        <table class="table">
          <thead>

          <tr class="filters">
            <th><input type="text" class="form-control" placeholder="Employee No" disabled></th>
            <th><input type="text" class="form-control" placeholder="Name" disabled></th>
            <th><input type="text" class="form-control" placeholder="Username" disabled></th>
            <th><input type="text" class="form-control" placeholder="Status" disabled></th>
            <th><input type="text" class="form-control" placeholder="Subjects" disabled></th>
          </tr>
          </thead>
          <tbody>
          <?php
          foreach($teachers as $teacher){
            $subString  = $teacherBySubjects["STITLES"][$teacher["ID"]];
            $idString = $teacherBySubjects["SIDS"][$teacher["ID"]];
            if($subString == ""){
              $subString = "N/A";
            }else{
              $subString = substr($subString, 0, -1);
            }

            if($idString !=""){
              $idString = substr($idString, 0, -1);;
            }
            echo "<tr>";
            echo "<td>".$teacher["EMPLOYEE_NUMBER"]."</td>
                  <td>".$teacher["FIRST_NAME"]." ".$teacher["MIDDLE_NAME"]." ".$teacher["LAST_NAME"]."</td>
                  <td>".$teacher["USERNAME"]."</td>
                  <td>".$teacher["ACTIVE"]."</td>"
                  ?>
                  <td>
                    <button subids = "<?php echo $idString ?>" teacherid = "<?php echo $teacher["ID"] ?>" type="submit" class="btn btn-default edit-subject" data-toggle="modal" data-target="#myModal"><?php echo $subString; ?></button>
                  </td>
                  <?php
            echo "</tr>";
          }
          ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
  <div class="web-tab" id="web-tab-applications-li-tab" style="display: NONE">
    <div class="row">
      <div class="col-lg-12">
        <h1><small>Pending approvals</small></h1>
      </div>
    </div><!-- /.row -->

    <div class="row">
      <div class="panel panel-primary filterable">
        <div class="panel-heading">
          <h3 class="panel-title">Teachers</h3>
          <div class="pull-right">
            <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
          </div>
        </div>


        <table class="table">
          <thead>

          <tr class="filters">
            <th><input type="text" class="form-control" placeholder="Student Name" disabled></th>
            <th><input type="text" class="form-control" placeholder="Exam Title" disabled></th>
            <th><input type="text" class="form-control" placeholder="Subject Titile" disabled></th>
            <th><input type="text" class="form-control" placeholder="Actions" disabled></th>
          </tr>
          </thead>
          <tbody>
          <?php
          foreach($pendingExams as $pendingExam){
            $name = $pendingExam["FIRST_NAME"]." ".$pendingExam["MIDDLE_NAME"]." ".$pendingExam[LAST_NAME];

            echo "<tr id='st-ex-".$pendingExam["ID"]."'>";
            echo "<td>".$name."</td>
                  <td>".$pendingExam["EXAMS_TITLE"]."</td>
                  <td>".$pendingExam["SUBJECT_TITLE"]."</td>";
            ?>
            <td>
              <button st_ex_id = "<?= $pendingExam["ID"] ?>" class="btn btn-default admin-app-confirm-but" data-toggle="modal" data-target="#exam-approve">Approve</button>
            </td>
            <?php
            echo "</tr>";
          }
          ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>

<!--  For teacherss tabs-->
  <div class="web-tab" id="web-tab-teacher-exams-li-tab" style="display: NONE">
    <div class="row">
      <div class="col-lg-12">
        <h1><small>My Exams</small></h1>
      </div>
    </div><!-- /.row -->

    <div class="row " id="new-exam" style="display: none">
        <div class="well well-sm">
          <?php
          $attributes =  array('id'=>'form-new-exam', 'class'=>'form-horizontal');
          echo form_open_multipart('exams/create',$attributes); ?>

          <fieldset>
            <legend class="text-center" id="teacher-new-exam-label">New Exam</legend>
            <!-- Name input-->
            <input type="hidden" name="exam_id" id="exam_id">
            <div class="form-group">
              <label class="col-md-3 control-label" for="code">Exam code</label>
              <div class="col-md-5">
                <input id="exam_code"  name="exam_code" type="text" placeholder="Exam code" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label" for="name">Title</label>
              <div class="col-md-5">
                <input id="exam_title" name="title" type="text" placeholder="Paper title" class="form-control">
              </div>
            </div>

            <!-- Email input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="email">Subject</label>
              <div class="col-md-5">
                <select class="form-control" name="subject_code" id="exam_subject_code">
                  <?php
                  foreach($subjects as &$subject){
                    echo '<option value="'.$subject["SID"].'">'.$subject["STITLE"].'</option>';
                  }
                  ?>
                </select>
                <?php

                ?>
              </div>
            </div>

            <!-- Email input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="email">Year</label>
              <div class="col-md-5">
                <select class="form-control" name="year" id="exam_year">
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
              </div>
            </div>

            <!-- Email input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="email">Semester</label>
              <div class="col-md-5">
                <select class="form-control" name="semester" id="exam_semester">
                  <option value="1">Semester 1</option>
                  <option value="2">Semester 2</option>
                </select>
              </div>
            </div>

            <!-- Email input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="email">Due date</label>
              <div class="col-md-5">
                <div class='input-group date' id="due_date_cont" data-date-format="YYYY-MM-DD hh:mm:00">
                  <input type='text' name="due_date" id="exam_due_date" class="form-control"/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
              </div>
            </div>



            <!-- Email input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="email">Status</label>
              <div class="col-md-5">
                <select class="form-control" name="status" id="exam_status">
                  <option value="DRAFT">Draft</option>
                  <option value="PUBLISHED">Published</option>
                </select>
              </div>
            </div>

            <!-- Email input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="email">Exam paper</label>
              <div class="col-md-5">
                <input type="file" name="userfile" size="20" />
              </div>
            </div>

            <!-- Message body -->
            <div class="form-group">
              <label class="col-md-3 control-label" for="message">Description</label>
              <div class="col-md-5">
                <textarea class="form-control" id="exam-description" name="description" placeholder="Please enter your description here..." rows="5"></textarea>
              </div>
            </div>

          </fieldset>

          </form>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" id="new-exam-cancel">Close</button>
            <button type="button" class="btn btn-primary" id="new-exam-save">Save changes</button>
          </div>
        </div>


    </div>


      <div style="text-align: right"><button type="button" class="btn btn-primary" id="but-new-exam">New Exam</button></div>
      <div class="panel panel-primary filterable">
        <div class="panel-heading">
          <h3 class="panel-title">Papers</h3>
          <div class="pull-right">
            <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
          </div>
        </div>


        <table class="table">
          <thead>

          <tr class="filters">
            <th><input type="text" class="form-control" placeholder="Exam Code" disabled></th>
            <th><input type="text" class="form-control" placeholder="Title" disabled></th>
            <th><input type="text" class="form-control" placeholder="Subject" disabled></th>
            <th><input type="text" class="form-control" placeholder="Exam date" disabled></th>
            <th><input type="text" class="form-control" placeholder="Status" disabled></th>
            <th><input type="text" class="form-control" placeholder="Action" disabled></th>
          </tr>
          </thead>
          <tbody>
          <?php
          if(count($exams) >0){
          foreach($exams as $exam){


            echo "<tr id='tr-".$exam["EXAMS_ID"]."' des='".$exam["DESCRIPTION"]."' year='".$exam["YEAR"]." semester=".$exam["SEMESTER"]."'>";
            echo "<td>".$exam["EXAM_CODE"]."</td>
                  <td>".$exam["EXAMS_TITLE"]."</td>
                  <td>".$exam["SUBJECTS_TITLE"]."</td>
                  <td>".$exam["DUE_DATE"]."</td>
                  <td>".$exam["STATUS"]."</td>";
            ?>
            <td>
              <button type="submit" exam-id="<?= $exam["EXAMS_ID"] ?>" due="<?= $exam["DUE_DATE"] ?>" file="<?= $exam["FILE_NAME"] ?>" title="<?= $exam["EXAMS_TITLE"] ?>" subject_id="<?= $exam["SUBJECTS_ID"] ?>" status="<?=$exam["STATUS"] ?>" code="<?= $exam["EXAM_CODE"]?>"  des="<?= $exam["DESCRIPTION"] ?>" year="<?= $exam["YEAR"]?>" semester="<?= $exam["SEMESTER"]?>" exam-id="<?= $exam["EXAMS_ID"] ?>" class="btn btn-default edit-teacher-exam">Edit exam</button>
            </td>
            </tr>
            <?php
          }

          }else{
            ?>
              <tr>
                <td colspan="5" style="text-align: center"><h4><small><< Records not found >></small></h4></td>
              </tr>
            <?php
          }
          ?>
          </tbody>
        </table>
      </div>
    </div>

  <div class="web-tab" id="web-tab-student-submissions-li-tab" style="display: NONE">
    <div class="row">
      <div class="col-lg-12">
        <h1><small>Students Submissions</small></h1>
      </div>
    </div><!-- /.row -->

    <div class="row">
      <div class="panel panel-primary filterable">
        <div class="panel-heading">
          <h3 class="panel-title">Submissions</h3>
          <div class="pull-right">
            <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
          </div>
        </div>


        <table class="table">
          <thead>

          <tr class="filters">
            <th><input type="text" class="form-control" placeholder="Student Name" disabled></th>
            <th><input type="text" class="form-control" placeholder="Exam Title" disabled></th>
            <th><input type="text" class="form-control" placeholder="Subject Titile" disabled></th>
            <th><input type="text" class="form-control" placeholder="Due date/time" disabled></th>
            <th><input type="text" class="form-control" placeholder="Status" disabled></th>
            <th><input type="text" class="form-control" placeholder="Actions" disabled></th>
          </tr>
          </thead>
          <tbody>
          <?php
          foreach($studentSubmissions as $submissions){
            $name = $submissions["FIRST_NAME"]." ".$submissions["MIDDLE_NAME"]." ".$submissions["LAST_NAME"];
            $hideCalssBut = "";
            $hideCalssP = "";
            if($submissions["STATUS"] == "WRITING" || $submissions["STATUS"] == "SUBMITTED"){
              $hideCalssBut = "";
              $hideCalssP = " hide-eara";
            }else{
              $hideCalssBut = " hide-eara";
              $hideCalssP = "";
            }

            echo "<tr id='st-ex-".$submissions["ID"]."'>";
            echo "<td>".$name."</td>
                  <td>".$submissions["EXAMS_TITLE"]."</td>
                  <td>".$submissions["SUBJECT_TITLE"]."</td>
                  <td>".$submissions["DUE_DATE"]."</td>
                  <td>".$submissions["STATUS"]."</td>";
            ?>
            <td>
              <button id="mark-but-<?= $submissions["ID"] ?>" st_ex_id = "<?= $submissions["ID"] ?>" class="btn btn-default teacher-mark-paper<?= $hideCalssBut ?>">Mark the paper</button>
              <p id="mark-p-<?= $submissions["ID"] ?>" class="st-marks<?= $hideCalssP ?>" stsyle="display: none">Marks: <b class="st-marks-b"><?= $submissions["MARKS"] ?>%</b></p>
            </td>
            <?php
            echo "</tr>";
          }
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--  For teacherss tabs end-->

  <!--  For student tabs-->
  <div class="web-tab" id="web-tab-new-exams-li-tab" style="display: NONE">
    <div class="row">
      <div class="col-lg-12">
        <h1><small>Available exams</small></h1>
      </div>
    </div>


    <div class="panel panel-primary filterable">
      <div class="panel-heading">
        <h3 class="panel-title">Avialable exams</h3>
        <div class="pull-right">
          <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
        </div>
      </div>


      <table class="table">
        <thead>

        <tr class="filters">
          <th><input type="text" class="form-control" placeholder="Exam Code" disabled></th>
          <th><input type="text" class="form-control" placeholder="Subject" disabled></th>
          <th><input type="text" class="form-control" placeholder="Exam date" disabled></th>
          <th><input type="text" class="form-control" placeholder="Status" disabled></th>
          <th><input type="text" class="form-control" placeholder="Action" disabled></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(count($newExams) >0){
          foreach($newExams as $newExam){


            echo "<tr id='tr-".$newExam["EXAMS_ID"]."' des='".$newExam["DESCRIPTION"]."' year='".$newExam["YEAR"]." semester=".$newExam["SEMESTER"]."'>";
            echo "<td>".$newExam["EXAM_CODE"]."</td>
                  <td>".$newExam["SUBJECTS_TITLE"]."</td>
                  <td>".$newExam["DUE_DATE"]."</td>
                  <td>".$newExam["STATUS"]."</td>";
            ?>
            <td>
                <button type="submit" id="subscribe-new-exam-<?= $newExam["EXAMS_ID"] ?>"  exam-id="<?= $newExam["EXAMS_ID"] ?>" class="btn btn-default subscribe-new-exam" data-toggle="modal" data-target="#exam-subscribe">Subscribe</button>
              <p id="pending-to-approve-<?= $newExam["EXAMS_ID"] ?>" class="pending-to-approve-text hide-eara">Pedning to approve</p>
            </td>
            </tr>
          <?php
          }

        }else{
          ?>
          <tr>
            <td colspan="5" style="text-align: center"><h4><small><< Records not found >></small></h4></td>
          </tr>
        <?php
        }
        ?>
        </tbody>
      </table>
    </div>

  </div>

  <div class="web-tab" id="web-tab-previous-exams-result-li-tab" style="display: NONE">
    <div class="row">
      <div class="col-lg-12">
        <h1><small>My All Exams</small></h1>
      </div>
    </div><!-- /.row -->

    <div class="row">
      <div class="panel panel-primary filterable">
        <div class="panel-heading">
          <h3 class="panel-title">Exams</h3>
          <div class="pull-right">
            <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
          </div>
        </div>


        <table class="table">
          <thead>

          <tr class="filters">

            <th><input type="text" class="form-control" placeholder="Exam Title" disabled></th>
            <th><input type="text" class="form-control" placeholder="Subject Titile" disabled></th>
            <th><input type="text" class="form-control" placeholder="Due Date/Time" disabled></th>
            <th><input type="text" class="form-control" placeholder="Status" disabled></th>
            <th><input type="text" class="form-control" placeholder="Actions" disabled></th>
          </tr>
          </thead>
          <tbody>
          <?php
          foreach($myExams as $myExam){
            $name = $myExam["FIRST_NAME"]." ".$myExam["MIDDLE_NAME"]." ".$myExam["LAST_NAME"];

            echo "<tr id='st-ex-".$myExam["ID"]."'>";
            echo "<td>".$myExam["EXAMS_TITLE"]."</td>
                  <td>".$myExam["SUBJECT_TITLE"]."</td>
                  <td>".$myExam["DUE_DATE"]."</td>
                  <td>".$myExam["STATUS"]."</td>";
            ?>
            <td>
              <?php
              if($myExam["STATUS"] == "WRITING" || $myExam["STATUS"] == "SUBMITTED"){
              ?>
                <button ex_id = "<?= $myExam["EID"] ?>"  st_ex_id = "<?= $myExam["ID"] ?>" st_ex_status = "<?= strtolower($myExam["STATUS"]) ?>" class="btn btn-default go-to-exam">Go to exam</button>
              <?php
              }elseif($myExam["STATUS"] == "REJECTED"){
                echo "<p>University has rejected your application.</p>";
              }elseif($myExam["STATUS"] == "SUBSCRIBED"){
                echo "<p>Please wait until university accept the application.</p>";
              }elseif($myExam["STATUS"] == "MARKED"){
                echo "<p>Marks : ".$myExam["MARKS"]."%</p>";
              }
              ?>

            </td>
            <?php
            echo "</tr>";
          }
          ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
  <!--For student tabs end-->

</div><!-- /#wrapper -->

<!-- JavaScript -->
<script src="<?= $this->config->item('assets_url'); ?>/dist/js/jquery-2.1.1.min.js"></script>
<script src="<?= $this->config->item('assets_url'); ?>/dist/js/jquery-validation-1.12.0/dist/jquery.validate.min.js"></script>
<script src="<?= $this->config->item('assets_url'); ?>/dist/js/bootstrap.min.js"></script>

<!-- Page Specific Plugins -->

<script src="<?= $this->config->item('assets_url'); ?>/dist/js/moment.js"></script>
<script src="<?= $this->config->item('assets_url'); ?>/dist/js/bootstrap-datetimepicker.js"></script>
<script src="<?= $this->config->item('assets_url'); ?>/dist/js/bootstrap-datetimepicker.ru.js"></script>

<script src="<?= $this->config->item('assets_url'); ?>/dist/js/raphael-min.js"></script>
<script src="<?= $this->config->item('assets_url'); ?>/dist/js/morris-0.4.3.min.js"></script>
<script src="<?= $this->config->item('assets_url'); ?>/dist/js/morris/chart-data-morris.js"></script>
<script src="<?= $this->config->item('assets_url'); ?>/dist/js/tablesorter/jquery.tablesorter.js"></script>
<script src="<?= $this->config->item('assets_url'); ?>/dist/js/tablesorter/tables.js"></script>
<script src="<?= $this->config->item('assets_url'); ?>/dist/js/bootstrap-multiselect.js"></script>

<script src="<?= $this->config->item('assets_url'); ?>/appjs/master.js"></script>


</body>
</html>