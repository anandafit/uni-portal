/*
 Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
 */
$(document).ready(function(){
  $("#close-exam-paper").click(function(){
    window.close();
  });

  $("#submit-exam-paper").click(function(){
    $("#online-exam-paper").submit();
  });

});