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

              <div  class="col-12"> <hr> </div>



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

              <div id="allAnswers" class="col-12"> </div>

              <div class="col-12" id="allQuestions">
                <hr>
                <h4>{{__('locale.Right Answer')}}</h4>
                <hr>

                <div class="col-12">
                  <div class="form-group row">
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

