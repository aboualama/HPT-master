<div class="col-md-12 col-12">

  @include('partials._errors')
  <div class="card">
    <div class="card-header">
      <h4>{{__('locale.Question Type')}} - {{ $type }} </h4>
    </div>
    <div class="card-content">
      <div class="card-body">

        <form class="form form-horizontal" method="POST" id ="form" action="{{ url('en/rsmcquestion') }}"
              enctype="multipart/form-data">
          @csrf
          <div class="form-body">
            <div class="row">

              <input type="hidden" name="type" value="{{ $type }}">
              <input type="hidden" id="url" value="/en/rsmcquestion">

              @foreach ( config('translatable.locales') as $lang)
                <div class="col-12">
                  <div class="form-group row">
                    <div class="col-md-3">
                      <span>@lang('locale.' . $lang . '.question')</span>
                    </div>
                    <div class="col-md-9">
                      <input type="text" id="question" class="form-control" name="{{$lang}}[question]">
                      <small id="{{$lang.'_question_error'}}" class="form-text text-danger center small_error"> </small>
                    </div>
                  </div>
                </div>
              @endforeach

              <div  class="col-12"> <hr> </div>

              @foreach ( config('translatable.locales') as $lang)
              <div class="col-12">
                <div class="form-group row">
                  <div class="col-md-3">
                    <span>@lang('locale.' . $lang . '.title')</span>
                  </div>
                  <div class="col-md-9">
                  <input type="text" id="title" class="form-control" name="{{$lang}}[title]">
                  <small id="{{$lang.'_title_error'}}" class="form-text text-danger center small_error"> </small>
                  </div>
                </div>
              </div>
              @endforeach



              <div class="col-12"> <hr></div>

              <h4 class="alert alert-danger center " style="text-align: center; width: 100%">{{__('locale.' . 'wrong answer')}}</h4>


              <div id="allAnswers" class="col-12">
                <div class="form-group row" id="wrongindex_0">
                  <div class="col-11">
                    <div class="row" >
                      <div class="col-md-4">
                      </div>
                      <div class="col-md-4">
                        <label>en</label>
                        <input type="text" class="form-control en wrong_answers" name="en[wrong_answers][]" placeholder="en">
                        <small id="en_wrong_answers_0_error" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-4">
                        <label>it</label>
                        <input type="text"  class="form-control it wrong_answers" name="it[wrong_answers][]" placeholder="it">
                        <small id="it_wrong_answers_0_error" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-4">
                        <label>pt</label>
                        <input type="text"  class="form-control pt wrong_answers" name="pt[wrong_answers][]" placeholder="pt">
                        <small id="pt_wrong_answers_0_error" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-4">
                        <label>fr</label>
                        <input type="text"  class="form-control fr wrong_answers" name="fr[wrong_answers][]" placeholder="fr">
                        <small id="fr_wrong_answers_0_error" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-4">
                        <label>gr</label>
                        <input type="text"  class="form-control gr wrong_answers" name="gr[wrong_answers][]" placeholder="gr">
                        <small id="gr_wrong_answers_0_error" class="form-text text-danger center small_error"> </small>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-1" >
                    <span onclick="removewrong(0)" style="font-size: 25px"><i class="feather icon-trash-2" style="line-height: 3;"></i></span>
                  </div>
                </div>
              </div>

              <div class="col-12"> <hr></div>

              <h4 class="alert alert-danger center " style="text-align: center; width: 100%">{{__('locale.' . 'right answer')}}</h4>

              <div class="col-12" id="allQuestions">
                <div class="form-group row" id="rightindex_0">
                  <div class="col-11">
                    <div class="row" >
                      <div class="col-md-4" style="text-align: center;">
                        <img
                          id="preview_img"
                          onclick="document.getElementById('input_img').click()"
                          src="{{asset('uploads/image/default.jpg')}}"
                          style="height: 80px; width: 80px;" />
                        <input
                            id="input_img"
                            type="file"
                            onchange="document.getElementById('preview_img').src=window.URL.createObjectURL(this.files[0])"
                            name="img_answers[]"
                            style="display:none;">
                            <small id="img_answers_0_error" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-4">
                        <label>en</label>
                        <input type="text" class="form-control en wrong_answers" name="en[right_answers][]" placeholder="en" required>
                        <small id="en_right_answers_0_error" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-4">
                        <label>it</label>
                        <input type="text"  class="form-control it wrong_answers" name="it[right_answers][]" placeholder="it">
                        <small id="it_right_answers_0_error" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-4">
                        <label>pt</label>
                        <input type="text"  class="form-control pt wrong_answers" name="pt[right_answers][]" placeholder="pt">
                        <small id="pt_right_answers_0_error" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-4">
                        <label>fr</label>
                        <input type="text"  class="form-control fr wrong_answers" name="fr[right_answers][]" placeholder="fr">
                        <small id="fr_right_answers_0_error" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-4">
                        <label>gr</label>
                        <input type="text"  class="form-control gr wrong_answers" name="gr[right_answers][]" placeholder="gr">
                        <small id="gr_right_answers_0_error" class="form-text text-danger center small_error"> </small>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-1" >
                    <span onclick="removeright(0)" style="font-size: 25px"><i class="feather icon-trash-2" style="line-height: 3;"></i></span>
                  </div>
                </div>
              </div>


              <div class="col-12">
                <hr>
              </div>

              <div class="col-12">
                <button id="submit" type="submit" class="btn btn-primary mr-1 mb-1">{{__('locale.Submit')}}</button>
                {{-- <a href="#" onclick="sendDataSMC()" class="btn btn-primary mr-1 mb-1">Submit</a> --}}
                <a type="add" class="btn btn-outline-warning mr-1 mb-1" href="#" onclick="addWrongAnswerSMC()">{{__('locale.Add Wrong Answer')}}</a>
                <a type="add" class="btn btn-outline-warning mr-1 mb-1" href="#" onclick="addRightAnswerSMC()">{{__('locale.Add Right Answer')}}</a>
                <button type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('locale.Reset')}}</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>






<script>





function addWrongAnswerSMC() {
      let i = $('.Windex').length + 1
      let m =  `<div class="form-group row Windex" id="wrongindex_`+ i +`">
                  <div class="col-11">
                    <div class="row" >
                      <div class="col-md-4">
                      </div>
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
                  <div class="col-md-1" >
                    <span onclick="removewrong(`+ i +`)" style="font-size: 25px"><i class="feather icon-trash-2" style="line-height: 3;"></i></span>
                  </div>
                </div>`;
      $("#allAnswers").append(m);
    }


    function addRightAnswerSMC() {
      let iR = $('.indexR').length + 1
      let img = `<div class="form-group row indexR" id="rightindex_` + iR + `">
                  <div class="col-11">
                    <div class="row" >
                      <div class="col-md-4" style="text-align: center;">
                        <img
                          id="preview_img"
                          onclick="document.getElementById('input_img').click()"
                          src="{{asset('uploads/image/default.jpg')}}"
                          style="height: 80px; width: 80px;" />
                        <input
                            id="input_img"
                            type="file"
                            onchange="document.getElementById('preview_img').src=window.URL.createObjectURL(this.files[0])"
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
                  <div class="col-md-1" >
                    <span onclick="removeright(${iR})" style="font-size: 25px"><i class="feather icon-trash-2" style="line-height: 3;"></i></span>
                  </div>
                </div>`;

      $("#allQuestions").append(img);
      $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
      });
    }




    function removewrong(i) {
    $('#wrongindex_'+ i).remove();
    }

    function removeright(i) {
      $('#rightindex_'+ i).remove();
    }



    </script>
