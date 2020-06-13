

$(document).ready(function() {
  "use strict"
  // init list view datatable

  // Update or Create User
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});


    $('#addnew').on('click', function (e) {
      $('#table-head').fadeOut();
      $('#add-new-select').fadeIn();
    });


    $('#select-type').change(function (e) {
      event.preventDefault()
      var type = $('#select-type').val();
      if (type === "0") {
        $('#q-type').html("");
      } else {
        $.ajax({
          method: "get",
          url: "/getquestion",
          data: {
            'type': type
          },
          success: function (data) {
            $('#q-type').html(data);
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
          toastr.success('XXXXXXXXXXXXXXXXXXX', "Question!",);
          td.fadeOut();
        },
        error: function (data) {
          console.log('Error:');
        }
      });
    });

    function addWrongAnswer() {
      let m =  `<div class="form-group row">
                <div class="col-md-3">
                  <h4> Answers</h4>
                </div>
                <div class="col-md-3">
                  <label>en</label>
                  <input type="text" class="form-control en wrong_answers" name="en[wrong_answers][]" placeholder="en">
                </div>
                <div class="col-md-3">
                  <label>it</label>
                  <input type="text"  class="form-control it wrong_answers" name="it[wrong_answers][]" placeholder="it">
                </div>
                <div class="col-md-3">
                  <label>pt</label>
                  <input type="text"  class="form-control pt wrong_answers" name="pt[wrong_answers][]" placeholder="pt">
                </div>
              </div>`;

      $("#allAnswers").append(m);
    }


    function addQuestionSMC() {
      let i = $('.index').length
      let img = ` <div class="col-12" index>
                  <div class="form-group row">
                    <div class="col-md-3" style="text-align: center;">
                      <img
                        id="preview_`+ i +`"
                        onclick="document.getElementById('input_`+ i +`').click()"
                        src="{{asset('uploads/img_answers/default.jpg')}}"
                        style="height: 80px; width: 80px;" />
                      <input
                          id="input_`+ i +`"
                          type="file"
                          onchange="document.getElementById('preview_`+ i +`').src=window.URL.createObjectURL(this.files[0])"
                          name="img_answers[]"
                          style="display:none;">
                    </div>
                    <div class="col-md-3">
                      <label>en</label>
                      <input type="text" class="form-control en wrong_answers" name="en[right_answers][]" placeholder="en" required>
                    </div>
                    <div class="col-md-3">
                      <label>it</label>
                      <input type="text"  class="form-control it wrong_answers" name="it[right_answers][]" placeholder="it">
                    </div>
                    <div class="col-md-3">
                      <label>pt</label>
                      <input type="text"  class="form-control pt wrong_answers" name="pt[right_answers][]" placeholder="pt">
                    </div>
                  </div>
        </div><hr>`;
      $("#allQuestions").append(img);
      $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
      });
    }

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


    function addAnswer() {
      let i = $('.index').length + 1
      let m =  ` <div class="col-12" index>
                  <div class="form-group row">
                    <div class="col-md-4">
                      <input type="text" id="choice1" class="form-control" name="en[answer][]" placeholder="en answer">
                      <small id="en_answer_`+ i +`_error" class="form-text text-danger center small_error"> </small>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="choice1" class="form-control" name="it[answer][]" placeholder="en answer">
                      <small id="it_answer_`+ i +`_error" class="form-text text-danger center small_error"> </small>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="choice1" class="form-control" name="pt[answer][]" placeholder="en answer">
                      <small id="pt_answer_`+ i +`_error" class="form-text text-danger center small_error"> </small>
                    </div>
                  </div>
                </div>

                <div class="col-12" c>
                  <div class="form-group row">
                    <div class="col-md-2">
                      <span>@lang('locale.values')</span>
                    </div>
                    <div class="col-md-2">
                    <input type="number" id="text" class="form-control" name="ansvalue[value_1][]" placeholder="value 1">
                    <small id="ansvalue_value_1_`+ i +`_error" class="form-text text-danger small_error"> </small>
                    </div>
                    <div class="col-md-2">
                    <input type="number" id="text" class="form-control" name="ansvalue[value_2][]" placeholder="value 2">
                    <small id="ansvalue_value_2_`+ i +`_error" class="form-text text-danger small_error"> </small>
                    </div>
                    <div class="col-md-2">
                    <input type="number" id="text" class="form-control" name="ansvalue[value_3][]" placeholder="value 3">
                    <small id="ansvalue_value_3_`+ i +`_error" class="form-text text-danger small_error"> </small>
                    </div>
                    <div class="col-md-2">
                    <input type="number" id="text" class="form-control" name="ansvalue[value_4][]" placeholder="value 4">
                    <small id="ansvalue_value_4_`+ i +`_error" class="form-text text-danger small_error"> </small>
                    </div>
                    <div class="col-md-2">
                    <input type="number" id="text" class="form-control" name="ansvalue[value_5][]" placeholder="value 5">
                    <small id="ansvalue_value_5_`+ i +`_error" class="form-text text-danger small_error"> </small>
                    </div>
                  </div>
                </div>`;

      $("#Answers").append(m);
    }







    $(document).on('click', '#submit', function (e) {
            e.preventDefault();
            $(".small_error").text('');
            var url = $("#url").val();
            var formData = new FormData($('#form')[0]);

            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {

                    if (data.status == 442){
                      $.each(data.errors, function (key, val) {
                        var newchar = '_'
                        var str = key.split('.').join(newchar);
                        // str = key.replace(/./g , "_")
                        $("#" + str + "_error").text(val[0]);
                        console.log(str);
                      });
                    }else{
                        window.location.href = "/en/question";
                        toastr.success('Created Successfully', "Question!",);
                    }
                }, error: function (xhr) {

                }
            });
        });




        $(document).on('click', '#edit', function (e) {
            e.preventDefault();
            var url = $("#url").val();
            $(".small_error").text('');

            console.log(url);
            var formData = new FormData($('#formedit')[0]);

            $.ajax({
                enctype: 'multipart/form-data',
                url: url ,
                data: formData,
                type: 'POST',
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                        console.log(data);

                        if (data.status == 442){
                          $.each(data.errors, function (key, val) {
                            var newchar = '_'
                            var str = key.split('.').join(newchar);
                            // str = key.replace(/./g , "_")
                            $("#" + str + "_error").text(val[0]);
                            console.log(str);
                          });
                        }else{
                            $("#modal-block-edit").modal('toggle');
                            toastr.success('Updated Successfully', "Question!",);
                        }
                }, error: function (xhr) {

                }
            });
        });



})
