

$(document).ready(function() {
  "use strict"
  // init list view datatable

  // Update or Create User
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});


    $('#addnew').on('click', function (e) {
      $('#data-list-view').fadeOut();
      $('#add-new-select').fadeIn();
    });


    $('#select-type').change(function (e) {
      event.preventDefault()
      var type = $('#select-type').val();
      if (type === "0") {
        $('#q-type').html("");
        $('#data-list-view').fadeIn();
      } else {
        $.ajax({
          method: "get",
          url: "/getquestion",
          data: {
            'type': type
          },
          success: function (data) {
            $('#q-type').html(data);
            $('#data-list-view').fadeOut();
            console.log(type);
          }
        });
      }
    });


    $('.action-edit').on("click", function (e) {
      e.stopPropagation();
      var id = $(this).data("id");

      $.ajax({
        type: 'GET',
        url: '/question-edit/' + id,
        success: function (data) {
          $('#modal-block-edit').modal('toggle');
          $('#question').html(data);
        }
      });
    });


    // On Delete
    $('.action-delete').on("click", function (e) {
      e.stopPropagation();
      var td = $(this).closest('td').parent('tr');
      var id = $(this).data("id");
      $.ajax({
        url: "/question/" + id,
        method: "DELETE",
        success: function (data) {
          toastr.success('Deleted Successfully',"Question!",);
          td.fadeOut();
        },
        error: function (data) {
          console.log('Error:');
        }
      });
    });




    // On clone
    $('.action-clone').on("click", function (e) {
      e.stopPropagation();
      var td = $(this).closest('td').parent('tr');
      var id = $(this).data("id");
      $.ajax({
        url: "/clone-question/" + id,
        success: function (data) {
          toastr.success('Clone Successfully',"Question!",);
          window.location.href = "/en/question";
        },
        error: function (data) {
          console.log('Error:');
        }
      });
    });


    function getAnswers() {
      $('#allAnswers').find('input.en').map(function (elem, value) {
        return value.value;
      });
    }

    function sendDataSMC(){
      let it  = $('#allAnswers').find('input.it').map(function (elem, value) {
        return value.value;
      });
      let en  = $('#allAnswers').find('input.en').map(function (elem, value) {
        return value.value;
      });
      let pt  = $('#allAnswers').find('input.pt').map(function (elem, value) {
        return value.value;
      });
      var formData = new FormData('#formSMC');
      console.log(formData);
    }

    function seletedChange() {
      if ($('#mySelect2').find("option[value='" + data.id + "']").length) {
        $('#mySelect2').val(data.id).trigger('change');
      } else {
        // Create a DOM Option and pre-select by default
        var newOption = new Option(data.text, data.id, true, true);
        // Append it to the select
        $('#mySelect2').append(newOption).trigger('change');
      }
    }



})
