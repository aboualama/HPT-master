

$(document).ready(function() {
  "use strict"


    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});




    // send mail
    $('.action-mail').on("click", function (e) {
      e.stopPropagation();
      var td = $(this).closest('td').parent('tr');
      var id = $(this).data("id");
      $.ajax({
        url: "/send-mail/" + id,
        success: function (data) {
          toastr.success('Send Successfully',"Mail!",);
          // window.location.href = "/en/result";
        },
        error: function (data) {
          console.log('Error:');
        }
      });
    });



})
