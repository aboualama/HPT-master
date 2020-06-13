<div class="col-md-12 col-12">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Edit Recognation Question </h4>
    </div>
    <div class="card-content">
      <div class="card-body">

        <form id="formedit" class="form form-horizontal"
          enctype="multipart/form-data">
          @csrf
          {{ method_field('put') }}
          <div class="form-body">
            <div class="row">

              <input type="hidden" name="type" value=" Recognation">
              <input type="hidden" id="url" value="{{ url('en/edit-question-1/' . $record->id) }}">

              @foreach ( config('translatable.locales') as $lang)
              <div class="col-12">
                <div class="form-group row">
                  <div class="col-md-3">
                    <span>@lang('locale.' . $lang . '.question')</span>
                  </div>
                  <div class="col-md-9">
                    <input type="text" id="question" class="form-control" name="{{$lang}}[question]"
                      value="{{$record->translate($lang)->question}}">
                    <small id="{{$lang.'_question_error'}}" class="form-text text-danger center small_error"> </small>
                  </div>
                </div>
              </div>
              @endforeach

              <div class="col-12">
                <hr>
              </div>


              <div class="col-12">
                <div class="row">
                  <video id="player" playsinline controls data-poster="/path/to/poster.jpg"
                    style="height: 350px; width: 620px; margin: 0 auto"
                    onclick="document.getElementById('input').click()">
                    <source src="{{asset('uploads/video/'.$record->video)}}" type="video/mp4" size="720" />
                  </video>
                  <input id="input" type="file"
                    onchange="document.getElementById('player').src=window.URL.createObjectURL(this.files[0])"
                    name="video" style="display:none;">
                </div>
                <small id="video_error" class="form-text text-danger center small_error"> </small>
                <hr>
              </div>


              @foreach ( config('translatable.locales') as $i => $lang)
              <div class="col-12">
                <span>@lang('locale.' . $lang . '.choice')</span>
                <div class="form-group row">
                  <div class="col-md-3">
                    <input type="text" id="choice1" class="form-control" name="{{$lang}}[right_answer]"
                      placeholder="@lang('locale.right_answer')" value="{{$record->translate($lang)->right_answer}}">
                      <small id="{{$lang.'_right_answer_error'}}" class="form-text text-danger center small_error"> </small>
                  </div>
                  <div class="col-md-3">
                    <input type="text" id="choice2" class="form-control" name="{{$lang}}[wrongans_1]"
                      placeholder="@lang('locale.wrongans_1')" value="{{$record->translate($lang)->wrongans_1}}">
                      <small id="{{$lang.'_wrongans_1_error'}}" class="form-text text-danger center small_error"> </small>
                  </div>
                  <div class="col-md-3">
                    <input type="text" id="choice3" class="form-control" name="{{$lang}}[wrongans_2]"
                      placeholder="@lang('locale.wrongans_2')" value="{{$record->translate($lang)->wrongans_2}}">
                      <small id="{{$lang.'_wrongans_2_error'}}" class="form-text text-danger center small_error"> </small>
                  </div>
                  <div class="col-md-3">
                    <input type="text" id="choice4" class="form-control" name="{{$lang}}[wrongans_3]"
                      placeholder="@lang('locale.wrongans_3')" value="{{$record->translate($lang)->wrongans_3}}">
                      <small id="{{$lang.'_wrongans_3_error'}}" class="form-text text-danger center small_error"> </small>
                  </div>
                </div>
              </div>
              @endforeach

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
