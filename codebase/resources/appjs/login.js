/**
 * Created by ananda on 6/17/14.
 */

$(document).ready(function(){

  var loginUser = function() {
    $("#login-alert-error").hide();
    loginFormValidate.resetForm();
    var username = $( '#username' ).val();
    var password = $( '#password' ).val();
    $.ajax( {
      url      : "auth/login",
      dataType : 'json',
      type     : 'POST',
      data     : {
        username : username,
        password : password
      },
      success  : function( data, status ) {
        if(data["success"]){
          window.location.replace("/app");
        }else{
          $("#login-alert-error .message").text("Username and password are not match. Please try again.");
          $("#login-alert-error").show();
        }

//        $( '#login-box-msg' ).empty();
//        $.cookie( {
//            'session_key' : data[ "session_key" ],
//            'first_name'  : data[ "first_name" ],
//            'last_name'   : data[ "last_name" ],
//            'username'	  : data[ "username" ]
//          },
//          {
//            expires: 2555
//          }
//        );
//        unblockComponent('.login .dialog-content');
//        window.location = "main.html";

      },
      error    : function() {
        $("#login-alert-error .message").text("Please check your network connection.");
        $("#login-alert-error").show();
      }
    })
  };

  var registerUser = function(){
    $("#register-alert-error").hide();
    registerFormValidate.resetForm();
    $.ajax( {
      url      : "auth/create_user",
      dataType : 'json',
      type     : 'POST',
      data     : {
        first_name : $( '#first_name' ).val(),
        middle_name : $( '#middle_name' ).val(),
        last_name : $( '#last_name' ).val(),
        gender : $( '#gender' ).val(),
        email : $( '#email' ).val(),
        date_birth : $( '#date_birth' ).val(),
        marital_status : $( '#marital_status' ).val(),
        username : $( '#reusername' ).val(),
        password : $( '#repassword' ).val(),
        password_confirm : $( '#password_confirm' ).val(),
        user_type : $( '#user_type' ).val(),
        academic_year : $( '#academic_year' ).val(),
        registration_no : $( '#registration_no' ).val(),
        employee_no : $( '#employee_no' ).val()
      },
      success  : function( data, status ) {
        if(data["success"]){
          window.location.replace("/app");
        }else{
          var message = "";
          for(var i=0; i<data["message"].length; i++){
            message += data["message"][i]+"<br>";
          }
          $("#register-alert-error .message").html(message);
          $("#register-alert-error").show();
        }

//        $( '#login-box-msg' ).empty();
//        $.cookie( {
//            'session_key' : data[ "session_key" ],
//            'first_name'  : data[ "first_name" ],
//            'last_name'   : data[ "last_name" ],
//            'username'	  : data[ "username" ]
//          },
//          {
//            expires: 2555
//          }
//        );
//        unblockComponent('.login .dialog-content');
//        window.location = "main.html";

      },
      error    : function() {
        $("#login-alert-error .message").text("Please check your network connection.");
        $("#login-alert-error").show();
      }
    })
  };



  var loginFormValidate = $('#form-login').validate(
    {
      rules: {
        username: {
          required: true
        },
        password: {
          required: true
        }
      },
      highlight: function(element) {
        $(element).closest('.control-group').removeClass('success').addClass('error');
      },
      success: function(element) {
        element
          .text('OK!').addClass('valid')
          .closest('.control-group').removeClass('error').addClass('success');
      }
    });

  var registerFormValidate = $('#form-register').validate(
    {
      rules: {
        first_name: {
          required: true
        },
        middle_name: {
          required: true
        },
        last_name: {
          required: true
        },
        gender: {
          required: true
        },
        email: {
          required: true,
          email:true
        },
        date_birth: {
          required: true
        },
        marital_status: {
          required: true
        },
        reusername: {
          required: true,
          minlength: 3
        },
        repassword: {
          required: true,
          minlength: 5
        },
        password_confirm: {
          equalTo: "#repassword"
        },
        user_type: {
          required: true
        },
        academic_year: {
          required: true
        },
        registration_no: {
          required: true
        },
        employee_no:{}
      },
      highlight: function(element) {
        $(element).closest('.control-group').removeClass('success').addClass('error');
      },
      success: function(element) {
        element
          .text('OK!').addClass('valid')
          .closest('.control-group').removeClass('error').addClass('success');
      }
    });



  $('#form-login').submit(function (e) {
    e.preventDefault();
    if ($('#form-login').valid()) {
      loginUser();
    }
  });

  $('#form-register').submit(function (e) {
    e.preventDefault();
    if ($('#form-register').valid()) {
      registerUser();
    }
  });

  //enable date for birthday
  $('#date_birth_cont').datepicker({
    startDate: '-50y'
  });

  //When change the user type hide and show the content accordingly
  var settings = registerFormValidate.settings;
  $( "#user_type" ).change(function() {

    if($( "#user_type" ).val() == "Teacher"){
      console.log("teacher select");
      // Modify validation settings
      registerFormValidate.settings.rules.employee_no = {
        required: true
      }
      registerFormValidate.settings.rules.academic_year = {};
      registerFormValidate.settings.rules.registration_no ={};

      $("#teacher-info").show();
      $("#student-info").hide();
    }else{

      // Modify validation settings
      registerFormValidate.settings.rules.employee_no = {};
      registerFormValidate.settings.rules.academic_year = {
        required: true
      };
      registerFormValidate.settings.rules.registration_no ={
        required: true
      };
      $("#student-info").show();
      $("#teacher-info").hide();
    }



  });


}); // end document.ready