@extends('layouts/contentLayoutMaster')

@section('title', __('locale.questions'))


@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.css')) }}">
  <style>
    .modal-body {
      max-height: calc(90vh);
      overflow-y: auto;
    }
  </style>
@endsection
@section('page-style')
  {{-- Page css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/plugins/extensions/toastr.css')) }}">
@endsection


@section('content')

  <button class="btn btn-success mr-1 mb-1" id="addnew">{{__('locale.Add New Question')}}</button>

  <div class="col-sm-12 col-12" id="add-new-select" style="display: none">
    <p>{{__('locale.please select Question Type')}}</p>
    <div class="form-group">
      <select class="select2 form-control" id="select-type">
        <option value="0" selected>{{__('locale.Question Type')}}</option>
        <option value="Recognation"> Recognation</option>
        <option value="Risk-Responsibilty"> Risk-Responsibilty</option>
        <option value="reaction-SMC"> Reaction-SMC</option>
        <option value="Hazard"> Hazard</option>
        <option value="Hazard-Perception"> Hazard-Perception</option>
      </select>
    </div>
  </div>

  @include('partials._errors')


  <div id="q-type"></div>




  <!-- Table head options start -->
  <div class="row" id="table-head">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">{{__('locale.Question List')}}</h4>

        </div>
        <div class="card-content">
          <div class="table-responsive">
            <table class="table mb-0">
              <thead class="thead-dark">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">{{__('locale.type')}}</th>
                <th scope="col">{{__('locale.question')}}</th>
                <th scope="col">{{__('locale.Action')}}</th>
              </tr>
              </thead>
              <tbody>

              @foreach ($records as $i => $record)
                <tr>
                  <th scope="row">{{$i +1}}</th>
                  <td>{{$record->type}}</td>
                  <td id="question_{{$record->id}}">{{$record->question}}</td>
                  <td>
                    <span class="action-clone" data-id="{{$record->id}}"><i class="fa fa-clone"></i></span>
                    <span class="action-edit" data-id="{{$record->id}}"><i class="feather icon-edit"></i></span>
                    <span class="action-delete" data-id="{{$record->id}}"><i class="feather icon-trash"></i></span>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Table head options end -->





  {{-- Modal --}}
  <div class="col-12">
    <div class="row">
      <div class="modal-size-lg mr-1 mb-1 d-inline-block">
        <div class="modal fade text-left" id="modal-block-edit" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel17" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div id="question"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection


@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')

  <!-- Page js files -->


  <script src="{{ asset(mix('js/scripts/forms/select/form-select2.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/extensions/toastr.js')) }}"></script>
  <script src="{{ asset('js/scripts/ui/question.js') }}"></script>


  <script>


    function addWrongAnswerSMC() {
      let i = $('.index').length + 1
      let m = `<div class="form-group row index" >
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                  <label>en</label>
                  <input type="text" class="form-control en wrong_answers" name="en[wrong_answers][]" placeholder="en">
                  <small id="en_wrong_answers_` + i + `_error" class="form-text text-danger center small_error"> </small>
                </div>
                <div class="col-md-4">
                  <label>it</label>
                  <input type="text"  class="form-control it wrong_answers" name="it[wrong_answers][]" placeholder="it">
                  <small id="it_wrong_answers_` + i + `_error" class="form-text text-danger center small_error"> </small>
                </div>
                <div class="col-md-4">
                  <label>pt</label>
                  <input type="text"  class="form-control pt wrong_answers" name="pt[wrong_answers][]" placeholder="pt">
                  <small id="pt_wrong_answers_` + i + `_error" class="form-text text-danger center small_error"> </small>
                </div>
                <div class="col-md-4">
                  <label>fr</label>
                  <input type="text"  class="form-control fr wrong_answers" name="fr[wrong_answers][]" placeholder="fr">
                  <small id="fr_wrong_answers_` + i + `_error" class="form-text text-danger center small_error"> </small>
                </div>
                <div class="col-md-4">
                  <label>gr</label>
                  <input type="text"  class="form-control gr wrong_answers" name="gr[wrong_answers][]" placeholder="gr">
                  <small id="gr_wrong_answers_` + i + `_error" class="form-text text-danger center small_error"> </small>
                </div>
              </div>`;

      $("#allAnswers").append(m);
    }


    function addRightAnswerSMC() {
      let i = $('.indexR').length + 1 // hena mynf3shy yeb2a index 3shan $('.index') bygeblk kol el element elly fel saf7a elly el class bta3ha index
      let img = ` <div class="col-12 indexR" >
                  <div class="form-group row">
                    <div class="col-md-4" style="text-align: center;">
                      <img
                        id="preview_${i}"
                        onclick="document.getElementById('input_${i}').click()"
                        src="{{asset('uploads/image/default.jpg')}}"
                        style="height: 80px; width: 80px;" />
                      <input
                          id="input_${i}"
                          type="file"
                          onchange="document.getElementById('preview_${i}').src=window.URL.createObjectURL(this.files[0])"
                          name="img_answers[]"
                          style="display:none;">
                    <small id="img_answers_${i}_error" class="form-text text-danger center small_error"> </small>
                    </div>
                    <div class="col-md-4">
                      <label>en</label>
                      <input type="text" class="form-control en wrong_answers" name="en[right_answers][]" placeholder="en" required>
                      <small id="en_right_answers_${i}_error" class="form-text text-danger center small_error"> </small>
                    </div>
                    <div class="col-md-4">
                      <label>it</label>
                      <input type="text"  class="form-control it wrong_answers" name="it[right_answers][]" placeholder="it">
                      <small id="it_right_answers_${i}_error" class="form-text text-danger center small_error"> </small>
                    </div>
                    <div class="col-md-4">
                      <label>pt</label>
                      <input type="text"  class="form-control pt wrong_answers" name="pt[right_answers][]" placeholder="pt">
                      <small id="pt_right_answers_${i}_error" class="form-text text-danger center small_error"> </small>
                    </div>
                    <div class="col-md-4">
                      <label>fr</label>
                      <input type="text"  class="form-control fr wrong_answers" name="fr[right_answers][]" placeholder="fr">
                      <small id="fr_right_answers_${i}_error" class="form-text text-danger center small_error"> </small>
                    </div>
                    <div class="col-md-4">
                      <label>gr</label>
                      <input type="text"  class="form-control gr wrong_answers" name="gr[right_answers][]" placeholder="gr">
                      <small id="gr_right_answers_${i}_error" class="form-text text-danger center small_error"> </small>
                    </div>
                  </div>
        </div><hr>`;
      $("#allQuestions").append(img);
      $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
      });
    }


    function addAnswer() {
      let i = $('.index').length + 1
      let m = ` <div class="col-12" index>
                <div class="form-group row">
                  <div class="col-md-4">
                    <label>en</label>
                    <input type="text" id="choice1" class="form-control" name="en[answer][]" placeholder="en answer">
                    <small id="en_answer_` + i + `_error" class="form-text text-danger center small_error"> </small>
                  </div>
                  <div class="col-md-4">
                    <label>it</label>
                    <input type="text" id="choice1" class="form-control" name="it[answer][]" placeholder="en answer">
                    <small id="it_answer_` + i + `_error" class="form-text text-danger center small_error"> </small>
                  </div>
                  <div class="col-md-4">
                    <label>pt</label>
                    <input type="text" id="choice1" class="form-control" name="pt[answer][]" placeholder="en answer">
                    <small id="pt_answer_` + i + `_error" class="form-text text-danger center small_error"> </small>
                  </div>
                  <div class="col-md-4">
                    <label>fr</label>
                    <input type="text" id="choice1" class="form-control" name="fr[answer][]" placeholder="en answer">
                    <small id="fr_answer_` + i + `_error" class="form-text text-danger center small_error"> </small>
                  </div>
                  <div class="col-md-4">
                    <label>gr</label>
                    <input type="text" id="choice1" class="form-control" name="gr[answer][]" placeholder="en answer">
                    <small id="gr_answer_` + i + `_error" class="form-text text-danger center small_error"> </small>
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
                  <small id="ansvalue_value_1_` + i + `_error" class="form-text text-danger small_error"> </small>
                  </div>
                  <div class="col-md-2">
                  <input type="number" id="text" class="form-control" name="ansvalue[value_2][]" placeholder="value 2">
                  <small id="ansvalue_value_2_` + i + `_error" class="form-text text-danger small_error"> </small>
                  </div>
                  <div class="col-md-2">
                  <input type="number" id="text" class="form-control" name="ansvalue[value_3][]" placeholder="value 3">
                  <small id="ansvalue_value_3_` + i + `_error" class="form-text text-danger small_error"> </small>
                  </div>
                  <div class="col-md-2">
                  <input type="number" id="text" class="form-control" name="ansvalue[value_4][]" placeholder="value 4">
                  <small id="ansvalue_value_4_` + i + `_error" class="form-text text-danger small_error"> </small>
                  </div>
                  <div class="col-md-2">
                  <input type="number" id="text" class="form-control" name="ansvalue[value_5][]" placeholder="value 5">
                  <small id="ansvalue_value_5_` + i + `_error" class="form-text text-danger small_error"> </small>
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

          if (data.status == 442) {
            $.each(data.errors, function (key, val) {
              var newchar = '_'
              var str = key.split('.').join(newchar);
              // str = key.replace(/./g , "_")
              $("#" + str + "_error").text(val[0]);
              console.log(str);
            });
          } else {
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
      var question_id = $("#question_id").val();
      $(".small_error").text('');

      console.log(question_id);
      var formData = new FormData($('#formedit')[0]);

      $.ajax({
        enctype: 'multipart/form-data',
        url: url,
        data: formData,
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
          console.log(data);

          if (data.status == 442) {
            $.each(data.errors, function (key, val) {
              var newchar = '_'
              var str = key.split('.').join(newchar);
              // str = key.replace(/./g , "_")
              $("#" + str + "_error").text(val[0]);
              console.log(str);
            });
          } else {
            $("#modal-block-edit").modal('toggle');
            $('#question_' + question_id).text(data.question);
            console.log('question_' + question_id);
            toastr.success('Updated Successfully', "Question!",);
          }
        }, error: function (xhr) {

        }
      });
    });


  </script>
@endsection
