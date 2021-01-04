      <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
              <h4 class="card-title">{{__('locale.Edit')}} {{ $record->type }} {{__('locale.question')}} </h4>
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

                              @foreach ( config('translatable.locales') as $lang)
                              <div class="col-12">
                                <div class="form-group row">
                                  <div class="col-md-3">
                                    <span>@lang('locale.' . $lang . '.title')</span>
                                  </div>
                                  <div class="col-md-9">
                                  <input type="text" id="title" class="form-control" name="{{$lang}}[title]" value="{{$record->translate($lang)->title  ?? ''}}">
                                  <small id="{{$lang.'_title_error'}}" class="form-text text-danger center small_error"> </small>
                                  </div>
                                </div>
                              </div>
                              @endforeach

                              <div class="col-12"> <hr></div>

                              <h4 class="alert alert-danger center " style="text-align: center; width: 100%">{{__('locale.' . 'wrong answer')}}</h4>

                              <div id="allWEindex" class="col-12">
                                @for ($i = 0 ; $i < sizeof(json_decode($record->wrong_answers)) ; $i++)
                                <div  class="row WEindex" id="wrongindex_{{$i}}">
                                  <div  class="col-11">
                                    <div class="row" >
                                      @foreach ( config('translatable.locales') as $lang)
                                          <div class="col-md-4">
                                            <label>{{$lang}}</label>
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
                                  </div>
                                  <div class="col-md-1" >
                                    <span onclick="removewrongrow({{$i}})" style="font-size: 25px"><i class="feather icon-trash-2" style="line-height: 3;"></i></span>
                                  </div>
                                </div>
                                @endfor
                              </div>

                              <div class="col-12"> <hr></div>

                              <h4 class="alert alert-danger center" style="text-align: center; width: 100%">{{__('locale.' . 'right answer')}}</h4>

                              <div class="col-12" id="allQuestions">
                                  <div id="rightindex_0" class="row">
                                    <div  class="col-11">
                                      <div class="row">
                                        <div class="col-md-4" style="text-align: center;">
                                          <img
                                              id="preview_0"
                                              onclick="document.getElementById('input_0').click()"
                                              src="{{asset('uploads/image/'. $record->image)}}"
                                              style="height: 80px; width: 80px;" />
                                          <input
                                                id="input_0"
                                                type="file"
                                                onchange="document.getElementById('preview_0').src=window.URL.createObjectURL(this.files[0])"
                                                name="img_answers[]"
                                                value='{{asset("upload/image/".$record->image)}}'
                                                style="display:none;">
                                                <small id="img_answers_0_error" class="form-text text-danger center small_error"> </small>
                                        </div>
                                        @foreach ( config('translatable.locales') as $lang)
                                            <div class="col-md-4" style="align-self: center;">
                                              <label>{{$lang}}</label>
                                              <input
                                                    type="text"
                                                    class="form-control"
                                                    name="{{$lang}}[right_answers][]"
                                                    value="{{ $record->translate($lang)->right_answers ??  '' }}"
                                                    required>
                                                    <small id="{{$lang}}_right_answers_0_error" class="form-text text-danger center small_error"> </small>
                                            </div>
                                        @endforeach
                                      </div>
                                      <hr>
                                    </div>
                                    <div class="col-1" >
                                    <span onclick="removerightrow(0)" style="font-size: 25px"><i class="feather icon-trash-2" style="line-height: 3;"></i></span>
                                    </div>
                                  </div>
                              </div>
                              <small id="img_answers_error" class="alert text-danger center small_error" style="text-align: center; width: 100%">  </small>

                              <hr>


                              <div class="col-12">
                                  <button id="edit" type="button" class="btn btn-primary mr-1 mb-1">{{__('locale.Submit')}}</button>
                                  {{-- <button type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('locale.Reset')}}</button> --}}
                                  <a type="add" class="btn btn-outline-warning mr-1 mb-1" href="#" onclick="addWrongAnswerSMCE()">{{__('locale.Add Wrong Answer')}}</a>
                                  <a type="add" class="btn btn-outline-warning mr-1 mb-1" href="#" onclick="addRightAnswerSMCE()">{{__('locale.Add Right Answer')}}</a>
                                  <button type="reset" class="btn btn-warning mr-1 mb-1" onclick="location.reload()">{{__('locale.Cancel')}}</button>
                              </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<input id ='WEindexVal' type="hidden" value="{{sizeof(json_decode($record->wrong_answers)) - 1}}">




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


function addWrongAnswerSMCE() {
      // let i = $('#WEindexVal').val();

      let i = $('.WEindex').length
      // let WEial = i++;
      // console.log(WEial);
      $('#WEindexVal').val(i);
      let m =  `<div class="form-group WEindex row" id="wrongindex_` + i + `">
                  <div class="col-11">
                    <div class="row">
                      <div class="col-md-4">
                        <label>en</label>
                        <input type="text" class="form-control en wrong_answers" name="en[wrong_answers][]" placeholder="en">
                        <small id="en_wrong_answers_`+ i +`_error" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-4">
                        <label>it</label>
                        <input type="text"  class="form-control it wrong_answers" name="it[wrong_answers][]" placeholder="it">
                        <small id="it_wrong_answers_`+ i +`_error" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-4">
                        <label>pt</label>
                        <input type="text"  class="form-control pt wrong_answers" name="pt[wrong_answers][]" placeholder="pt">
                        <small id="pt_wrong_answers_`+ i +`_error" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-4">
                        <label>fr</label>
                        <input type="text"  class="form-control fr wrong_answers" name="fr[wrong_answers][]" placeholder="fr">
                        <small id="fr_wrong_answers_`+ i +`_error" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-4">
                        <label>gr</label>
                        <input type="text"  class="form-control gr wrong_answers" name="gr[wrong_answers][]" placeholder="gr">
                        <small id="gr_wrong_answers_`+ i +`_error" class="form-text text-danger center small_error"> </small>
                      </div>
                    </div>
                  </div>
                  <div class="col-1" >
                    <span onclick="removewrongrow(`+ i +`)" style="font-size: 25px"><i class="feather icon-trash-2" style="line-height: 3;"></i></span>
                  </div>
                </div>`;

      $("#allWEindex").append(m);
    }


    function addRightAnswerSMCE() {
      let iR = $('.indexRE').length + 1
      let img = `<div class="indexRE row" id="rightindex_${iR}">
                  <div class="col-11">
                    <div class="form-group row">
                      <div class="col-md-4" style="text-align: center;">
                        <img
                          id="preview_${iR}"
                          onclick="document.getElementById('input_${iR}').click()"
                          src="{{asset('uploads/image/default.jpg')}}"
                          style="height: 80px; width: 80px;" />
                        <input
                            id="input_${iR}"
                            type="file"
                            onchange="document.getElementById('preview_${iR}').src=window.URL.createObjectURL(this.files[0])"
                            name="img_answers[]"
                            style="display:none;">
                      <small id="img_answers_${iR}_error" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-4">
                        <label>en</label>
                        <input type="text" class="form-control en wrong_answers" name="en[right_answers][]" placeholder="en" required>
                        <small id="en_right_answers_${iR}_error" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-4">
                        <label>it</label>
                        <input type="text"  class="form-control it wrong_answers" name="it[right_answers][]" placeholder="it">
                        <small id="it_right_answers_${iR}_error" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-4">
                        <label>pt</label>
                        <input type="text"  class="form-control pt wrong_answers" name="pt[right_answers][]" placeholder="pt">
                        <small id="pt_right_answers_${iR}_error" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-4">
                        <label>fr</label>
                        <input type="text"  class="form-control fr wrong_answers" name="fr[right_answers][]" placeholder="fr">
                        <small id="fr_right_answers_${iR}_error" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-4">
                        <label>gr</label>
                        <input type="text"  class="form-control gr wrong_answers" name="gr[right_answers][]" placeholder="gr">
                        <small id="gr_right_answers_${iR}_error" class="form-text text-danger center small_error"> </small>
                      </div>
                    </div>
                  </div>
                  <div class="col-1" >
                    <span onclick="removerightrow(${iR})" style="font-size: 25px"><i class="feather icon-trash-2" style="line-height: 3;"></i></span>
                  </div>
                </div>`;
      $("#allQuestions").append(img);
      console.log(iR);
      $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
      });
    }



  function removewrongrow(i) {

    $('#wrongindex_'+ i).remove();
    $row = $('#WEindexVal').val() -1;
      console.log($row);
    $('#WEindexVal').val($row);
  }

  function removerightrow(i) {
    $('#rightindex_'+ i).remove();
  }
  </script>
