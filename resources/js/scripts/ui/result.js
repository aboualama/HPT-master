

$(document).ready(function() {
  "use strict"


    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});




    // send mail
    $('.action-mail').on("click", function (e) {
      e.stopPropagation();
      var td = $(this).closest('td').parent('tr');
      var id = $(this).data("id");
      var username = $(this).closest('tr').find('td.username').text();
      var email = $(this).closest('tr').find('td.email').text();
      var licensecode = $(this).closest('tr').find('td.licensecode').text();
      var point = $(this).closest('tr').find('td.point').text();
      var date = $(this).closest('tr').find('td.date').text();

      $.ajax({
        url: "/send-mail/" + id,
        data: {
          'id': id,
          'username': username,
          'email': email,
          'licensecode': licensecode,
          'point': point,
          'date': date
        },
        success: function (data) {
          toastr.success('Send Successfully',"Mail!",);
          // window.location.href = "/en/result";
        },
        error: function (data) {
          console.log('Error:');
        }
      });
    });




    // send mail
    $('.action-xml').on("click", function (e) {
      e.stopPropagation();
      var td = $(this).closest('td').parent('tr');
      var id = $(this).data("id");
      var date = $(this).closest('tr').find('td.date').text();

      $.ajax({
        url: "/convert-xml/" + id,
        data: {
          'id': id,
          'date': date
        },
        success: function (data) {
          toastr.success('Convert Successfully',"Data!",);
        },
        error: function (data) {
          console.log('Error:');
        }
      });
    });



})
