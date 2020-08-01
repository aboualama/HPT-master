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


              <div class="col-12">
                <hr>
                <h4> {{__('locale.Answers')}}</h4>
                <hr>
              </div>


              <div class="col-12">
                <hr>
                <h4>{{__('locale.Wrong Answer')}}</h4>
                <hr>
                <div class="form-group row">
                  <div class="col-md-3">
                  </div>
                  <div class="col-md-3">
                    <label>en</label>
                    <input type="text" class="form-control en wrong_answers" name="en[wrong_answers][]" placeholder="en">
                    <small id="en_wrong_answers_0_error" class="form-text text-danger center small_error"> </small>
                  </div>
                  <div class="col-md-3">
                    <label>it</label>
                    <input type="text"  class="form-control it wrong_answers" name="it[wrong_answers][]" placeholder="it">
                    <small id="it_wrong_answers_0_error" class="form-text text-danger center small_error"> </small>
                  </div>
                  <div class="col-md-3">
                    <label>pt</label>
                    <input type="text"  class="form-control pt wrong_answers" name="pt[wrong_answers][]" placeholder="pt">
                    <small id="pt_wrong_answers_0_error" class="form-text text-danger center small_error"> </small>
                  </div>
                </div>
              </div>

              <div id="allAnswers" class="col-12">

              </div>

              <div class="col-12" id="allQuestions">
                <hr>
                <h4>{{__('locale.Right Answer')}}</h4>
                <hr>

                <div class="col-12">
                  <div class="form-group row">
                    <div class="col-md-3" style="text-align: center;">
                      <img
                        id="preview_img"
                        onclick="document.getElementById('input_img').click()"
                        src="{{asset('uploads/img_answers/default.jpg')}}"
                        style="height: 80px; width: 80px;" />
                      <input
                          id="input_img"
                          type="file"
                          onchange="document.getElementById('preview_img').src=window.URL.createObjectURL(this.files[0])"
                          name="img_answers[]"
                          style="display:none;">
                          <small id="img_answers_0_error" class="form-text text-danger center small_error"> </small>
                    </div>
                    <div class="col-md-3">
                      <label>en</label>
                      <input type="text" class="form-control en wrong_answers" name="en[right_answers][]" placeholder="en" required>
                      <small id="en_right_answers_0_error" class="form-text text-danger center small_error"> </small>
                    </div>
                    <div class="col-md-3">
                      <label>it</label>
                      <input type="text"  class="form-control it wrong_answers" name="it[right_answers][]" placeholder="it">
                      <small id="it_right_answers_0_error" class="form-text text-danger center small_error"> </small>
                    </div>
                    <div class="col-md-3">
                      <label>pt</label>
                      <input type="text"  class="form-control pt wrong_answers" name="pt[right_answers][]" placeholder="pt">
                      <small id="pt_right_answers_0_error" class="form-text text-danger center small_error"> </small>
                    </div>
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


<div class="col-12">
  <div class="form-group row">
    <div class="col-md-6">
      <input type="file" class="form-control" name="video" placeholder="">
    </div>
    <div class="col-md-6">
      <input type="text" class="form-control" name="video">
    </div>
    <div>
      <select class="select2 form-control" multiple>
        <option value="square">Square</option>
        <option value="rectangle">Rectangle</option>
        <option value="rombo">Rombo</option>
        <option value="romboid">Romboid</option>
        <option value="trapeze">Trapeze</option>
        <option value="traible">Triangle</option>
        <option value="polygon">Polygon</option>
      </select>
    </div>
  </div>
</div>

