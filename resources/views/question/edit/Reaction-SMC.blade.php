      <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit {{$type}} Question </h4>
            </div>
            <div class="card-content">
                <div class="card-body">


                  <form id="formedit" class="form form-horizontal" method="POST" action="{{ url('en/edit-question-2/' . $record->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    {{ method_field('put') }}
                        <div class="form-body">
                            <div class="row">

                              <input type="hidden" name="type" value="{{$type}}">
                              <input type="hidden" id="url" value="{{ url('en/edit-question-2/' . $record->id) }}">
                              <input type="hidden" id="question_id" value="{{ $record->id }}">

                              @foreach ( config('translatable.locales') as $lang)
                              <div class="col-12">
                                <div class="form-group row">
                                  <div class="col-md-3">
                                    <span>@lang('locale.' . $lang . '.question')</span>
                                  </div>
                                  <div class="col-md-9">
                                  <input type="text" id="question" class="form-control" name="{{$lang}}[question]" value="{{$record->translate($lang)->question}}">
                                  <small id="{{$lang.'_question_error'}}" class="form-text text-danger center small_error"> </small>
                                  </div>
                                </div>
                              </div>
                              @endforeach

                              <div class="col-12"> <hr></div>

                              <div class="col-12">
                                <h4>Wrong Answers</h4>
                              </div>
                              @for ($i = 0 ; $i < sizeof(json_decode($record->wrong_answers)) ; $i++)
                                <div  class="col-12">
                                  <div class="row" >
                                    @foreach ( config('translatable.locales') as $lang)
                                        <div class="col-md-4">
                                        <input
                                              type="text"
                                              class="form-control"
                                              name="{{$lang}}[wrong_answers][]"
                                              value="{{json_decode($record->translate($lang)->wrong_answers)[$i]}}"
                                              required>
                                              <small id="{{$lang}}_wrong_answers_{{$i}}_error" class="form-text text-danger center small_error"> </small>
                                        </div>
                                    @endforeach
                                  </div>
                                  <hr>
                                </div>
                              @endfor

                              <div  class="col-12">
                                <h4>Right Answers</h4>
                              </div>
                              @php
                                $right_answers = json_decode($record->right_answers, true);
                              @endphp
                              @for ($i = 0 ; $i < sizeof($right_answers) ; $i++)
                              <div  class="col-12">
                                <div class="row">
                                  <div class="col-md-3" style="text-align: center;">
                                    <img
                                        id="preview_{{$i}}"
                                        onclick="document.getElementById('input_{{$i}}').click()"
                                        src="{{asset('uploads/img_answers/'.json_decode($record->image)[$i])}}"
                                        style="height: 80px; width: 80px;" />
                                    <input
                                          id="input_{{$i}}"
                                          type="file"
                                          onchange="document.getElementById('preview_{{$i}}').src=window.URL.createObjectURL(this.files[0])"
                                          name="img_answers[]"
                                          style="display:none;">
                                          <small id="img_answers_{{$i}}_error" class="form-text text-danger center small_error"> </small>
                                  </div>
                                  @foreach ( config('translatable.locales') as $lang)
                                      <div class="col-md-3" style="align-self: center;">
                                        <input
                                              type="text"
                                              class="form-control"
                                              name="{{$lang}}[right_answers][]"
                                              value="{{json_decode($record->translate($lang)->right_answers)[$i]}}"
                                              required>
                                              <small id="{{$lang}}_right_answers_{{$i}}_error" class="form-text text-danger center small_error"> </small>
                                      </div>
                                  @endforeach
                                </div>
                                <hr>
                              </div>
                              @endfor




                              <div class="col-12">
                                  <button id="edit" type="button" class="btn btn-primary mr-1 mb-1">Submit</button>
                                  <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                              </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>






  @section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  @endsection
  @section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/select/form-select2.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/extensions/toastr.js')) }}"></script>
  @endsection


  <script>

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


  function addRightAnswer() {
    let img = `<div class="col-12">
          <div class="form-group row">
            <div class="col-md-3">
              <h4>Right Answers</h4>
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
          <div class="form-group row">
            <div class="col-md-12">
              <input type="file" class="form-control" name="img_answers[]" placeholder="">
            </div>
          </div>
      </div>
      <td style="20%">  <a href="#" onclick="deleteProduct(' + priceListId + ')">
         <button type="button" class="btn btn-sm btn-danger js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="delete"><i class="fa fa-trash"></i></button>
        </a></td>
      <hr>`;
    $("#allQuestions").append(img);
  }

  </script>
