<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
  <link href="<?= $this->config->item('assets_url'); ?>/dist/css/bootstrap.css" rel="stylesheet">
  <meta charset="UTF-8">
  <title>Sample Invoice</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <style>
    @import url(http://fonts.googleapis.com/css?family=Bree+Serif);
    body, h1, h2, h3, h4, h5, h6{
      font-family: 'Bree Serif', serif;
    }
  </style>
</head>
<body>

<div class="container">

  <div class="row">
    <div class="col-xs-6">
      <h1>
        <a href="#">
          PGIS Examination
        </a>
      </h1>
    </div>
  </div>


  <div class="row">
    <form name="online-exam-paper" action="/upload/save_paper" method="POST" id="online-exam-paper">
      <input type="hidden" value="<?= $exam_id ?>" name="exam_id">
      <input type="hidden" value="<?= $st_ex_id ?>" name="st_exam_id">
    <div>
      <?php
      $i = 1;
      foreach($quections as $quection){
        $answers  = explode(";", $quection["ANSWERS"]);
        ?>
        <div class="span7">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h4><?= $i ?>. <?= $quection["QUECTION"] ?></h4>
            </div>
            <div class="panel-body">
              <p>
                <?php
                  foreach($answers as $answer){
                  $checked = "";
                    if(trim($answer) == trim($quection["ST_ANSWER"])){
                      $checked = 'checked="checked"';
                    }
                  ?>
                    <input type="radio" name="answer-<?= $quection["ID"] ?>" value="<?= $answer ?>" <?= $checked ?>> <?= $answer ?><br>
                  <?php
                  }
                ?>

              </p>
            </div>
          </div>
        </div>

        <?php
        $i++;
      }
      ?>

    </div>
    </form>
    <div style="text-align: right"><button type="button" class="btn btn-default" id="close-exam-paper">Close</button>
      <button type="button" class="btn btn-primary" id="submit-exam-paper">Save changes</button></div>
  </div>
  </br></br></br>

</div>

<script src="<?= $this->config->item('assets_url'); ?>/dist/js/jquery-2.1.1.min.js"></script>
<script src="<?= $this->config->item('assets_url'); ?>/appjs/paper.js"></script>

</body>
</html>