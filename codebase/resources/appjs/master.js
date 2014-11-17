/*
 Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
 */
$(document).ready(function(){

  var selectedExam  = {};
  var approveId = null;

  var examSubscribeApprove = function(ex_st_id, status){
    $.ajax( {
      url      : "exams/change_subscription",
      dataType : 'json',
      type     : 'POST',
      data     : {
        student_exam_id : ex_st_id,
        status : status
      },
      success  : function( data, status ) {
        console.log(status);
        if(data["success"]){
          $("#st-ex-"+ex_st_id).remove();
        }else{
          alert("Error happen when save infor. Please try again");
        }
      },
      error    : function() {
        alert("Error happen when save infor. Please try again");
      }
    })
  };
  var examSubscribe = function(examId){
    $.ajax( {
      url      : "exams/exam_subscribe",
      dataType : 'json',
      type     : 'POST',
      data     : {
        examId : examId
      },
      success  : function( data, status ) {
        console.log(status);
        if(data["success"]){
          $("#new-exam-subscribe-cancel").trigger("click");
          $("#subscribe-new-exam-"+examId).hide();
          $("#pending-to-approve-"+examId).show();


        }else{
          alert("Error happen when save infor. Please try again");
        }
      },
      error    : function() {
        alert("Error happen when save infor. Please try again");
      }
    })
  }



  var assignTeachers  = function(subjectsIds, teacherId){
//    $("#login-alert-error").hide();

    $.ajax( {
      url      : "app/assign_subjects",
      dataType : 'json',
      type     : 'POST',
      data     : {
        subjectsIds : subjectsIds,
        teacherId : teacherId
      },
      success  : function( data, status ) {
        console.log(status);
        if(data["success"]){
          $("#teacher-subjects-cancel").trigger("click");
        }else{
          alert("Error happen when save infor");
        }
      },
      error    : function() {
        alert("Error happen when save infor");
      }
    })
  };

  $('.filterable .btn-filter').click(function(){
    var $panel = $(this).parents('.filterable'),
      $filters = $panel.find('.filters input'),
      $tbody = $panel.find('.table tbody');
    if ($filters.prop('disabled') == true) {
      $filters.prop('disabled', false);
      $filters.first().focus();
    } else {
      $filters.val('').prop('disabled', true);
      $tbody.find('.no-result').remove();
      $tbody.find('tr').show();
    }
  });

  $(".filters input").click(function(){
    $(this).focus();
  });

  $('.filterable .filters input').keyup(function(e){
    /* Ignore tab key */
    var code = e.keyCode || e.which;
    if (code == '9') return;
    /* Useful DOM data and selectors */
    var $input = $(this),
      inputContent = $input.val().toLowerCase(),
      $panel = $input.parents('.filterable'),
      column = $panel.find('.filters th').index($input.parents('th')),
      $table = $panel.find('.table'),
      $rows = $table.find('tbody tr');
    /* Dirtiest filter function ever ;) */
    var $filteredRows = $rows.filter(function(){
      var value = $(this).find('td').eq(column).text().toLowerCase();
      return value.indexOf(inputContent) === -1;
    });
    /* Clean previous no-result if exist */
    $table.find('tbody .no-result').remove();
    /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
    $rows.show();
    $filteredRows.hide();
    /* Prepend no-result row if all rows are filtered */
    if ($filteredRows.length === $rows.length) {
      $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
    }
  });

  //hide when initial load
  $(".web-tab").hide();

  $(".side-nav li").click(function(){
    $(".web-tab").hide();
    $(".side-nav li").removeClass("active");
    var tabid = $(this).attr("id");
    $(this).addClass("active");
    $("#"+tabid+"-tab").show();
  });

  $( ".side-nav li" ).first().trigger( "click" );

  $("#teacher-subjects").click(function(){
    var selectedSubjects = [];
    $( ".subjeccts-group" ).each(function() {
      if(this.checked){
        selectedSubjects.push($(this).attr('value'));
      }
    });
    console.log(selectedSubjects);
    assignTeachers(selectedSubjects, $("#subjeccts-group-teacher-id").val());
  });

  $(".edit-subject").click(function(){
    $("#subjeccts-group-teacher-id").val($(this).attr("teacherid"));

    $( ".subjeccts-group" ).each(function() {
      $(this).attr("checked", false);
    });

    var subIds = $(this).attr("subids").split(",");
    $.each(subIds, function( index, value ) {
      $(".subjeccts-group[value="+value+"]").prop("checked", true);
    });
  });

  $("#teacher-new-exam").click(function(){

  });

  var date = new Date(), y = date.getFullYear(),m=date.getMonth(), d = date.getDate();
  $('#due_date_cont').datetimepicker({
    use24hours: false,
    minDate:new Date(y, m, d)
  });

  $("#but-new-exam").click(function(){
    $("#teacher-new-exam-label").text("New Exam");
    $("#exam_id").val(null);
    $("#exam_code").val("");
    $("#exam_title").val("");
    $("#exam_subject_code").val("");
    $("#exam_year").val("");
    $("#exam_semester").val("");
    $("#exam_due_date").val("");
    $("#exam_status").val("");
    $("#exam-description").val("");
    $("#new-exam").slideDown();
  });

  $("#new-exam-cancel").click(function(){
    $("#new-exam").slideUp();
  });

  $("#new-exam-save").click(function(){
    $("#form-new-exam").submit();
  });

  $(".subscribe-new-exam").click(function(){
    $("#selected-exam-subscribe").val($(this).attr("exam-id"));
  });

  $(".subscribe-new-exam").click(function(){
    $("#selected-exam-subscribe").val($(this).attr("exam-id"));
  });

  $("#new-exam-subscribe").click(function(){
    examSubscribe($("#selected-exam-subscribe").val());
  });

  //when click on teacher's exam edit button
  $(".edit-teacher-exam").click(function(){
    selectedExam = {
      "EXAMS_ID":$(this).attr("exam-id"),
      "YEAR":$(this).attr("year"),
      "SEMESTER":$(this).attr("semester"),
      "DUE_DATE":$(this).attr("due"),
      "EXAMS_TITLE":$(this).attr("title"),
      "STATUS":$(this).attr("status"),
      "DESCRIPTION":$(this).attr("des"),
      "FILE_NAME":$(this).attr("file"),
      "SUBJECTS_ID":$(this).attr("subject_id"),
      "EXAM_CODE":$(this).attr("code")
    }

    $("#exam_id").val(selectedExam["EXAMS_ID"]);
    $("#exam_code").val(selectedExam["EXAM_CODE"]);
    $("#exam_title").val(selectedExam["EXAMS_TITLE"]);
    $("#exam_subject_code").val(selectedExam["SUBJECTS_ID"]);
    $("#exam_year").val(selectedExam["YEAR"]);
    $("#exam_semester").val(selectedExam["SEMESTER"]);
    $("#exam_due_date").val(selectedExam["DUE_DATE"]);
    $("#exam_status").val(selectedExam["STATUS"]);
    $("#exam-description").val(selectedExam["DESCRIPTION"]);
//    $("#exam_id").val(selectedExam["EXAMS_ID"]);

    $("#teacher-new-exam-label").text("Edit Exam");
    $("#new-exam").slideDown();
  });

  $(".admin-app-confirm-but").click(function(){
    approveId = $(this).attr("st_ex_id")
  });

  $("#exam-approve-cancel").click(function(){
    examSubscribeApprove(approveId, "REJECTED");
  });

  $("#exam-approve-confirm").click(function(){
    examSubscribeApprove(approveId, "WRITING");
  });

  $(".go-to-exam").click(function(){
    var st_ex_id = $(this).attr("st_ex_id");
    var ex_id = $(this).attr("ex_id");
    var st_ex_status = $(this).attr("st_ex_status");
    window.open("/upload/go_to_exam/"+ex_id+"/"+st_ex_id+"/"+st_ex_status,null,
      "status=yes,menubar=no,location=no");
  });

  $(".teacher-mark-paper").click(function(){
    var stexamid = $(this).attr("st_ex_id");
    $.ajax( {
      url      : "exams/change_subscription",
      dataType : 'json',
      type     : 'POST',
      data     : {
        student_exam_id : stexamid,
        status : "MARKED"
      },
      success  : function( data, status ) {
        if(data["success"]){
          $("#mark-but-"+stexamid).hide();
          $("#mark-p-"+stexamid).show();
        }else{
          alert("Error happen when save infor. Please try again");
        }
      },
      error    : function() {
        alert("Error happen when save infor. Please try again");
      }
    })

  });








});