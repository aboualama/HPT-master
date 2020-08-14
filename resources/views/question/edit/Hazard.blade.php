<div class="col-md-12 col-12">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Edit {{$type}} Question </h4>
    </div>
    <div class="card-content">
      <div class="card-body">



        <form id="formedit" class="form form-horizontal" method="POST" action="{{ url('en/edit-question-3/' . $record->id) }}"
          enctype="multipart/form-data">
          @csrf
          {{ method_field('put') }}
          <div class="form-body">
            <div class="row">

              <input type="hidden" id="type" name="type" value="{{$type}}">
              <input type="hidden" id="url" value="{{ url('en/edit-question-3/' . $record->id) }}">
              <input type="hidden" id="question_id" value="{{ $record->id }}">

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



              {{-- <div class="col-12">
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
              </div> --}}





              <div class="col-12">
                <div class="row">

                  <div class="col-md-6">
                    <h4 class="text-center">{{__('locale.select video')}}</h4>
                    <video id="player" playsinline controls data-poster="{{asset('uploads/image/default.jpg')}}"
                      style="max-height: 350px; max-width: 100%; display: block; margin: 0 auto; margin-bottom: 25px;"
                      onclick="document.getElementById('input').click()">
                      <source src="{{$record->video_path}}" type="video/mp4" size="720" />
                    </video>

                    <input id="input" type="file"
                      onchange="document.getElementById('player').src=window.URL.createObjectURL(this.files[0])"
                      name="video" style="display:none;">
                      <small id="video_error" class="form-text text-danger center small_error"> </small>
                  </div>

                  <div class="col-md-6">
                    <h4 class="text-center">{{__('locale.select img')}}</h4>
                    <img
                      id="preview_img"
                      onclick="document.getElementById('input_img').click()"
                      src="{{$record->image_path}}"
                      style="max-width: 80%; max-height: 350px; display: block; margin: 0 auto;" />
                    <input
                        id="input_img"
                        type="file"
                        onchange="document.getElementById('preview_img').src=window.URL.createObjectURL(this.files[0])"
                        name="image"
                        style="display:none;">
                        <small id="image_error" class="form-text text-danger text-center small_error"> </small>
                  </div>

                </div>
                <hr>
              </div>









              <div class="col-12">
                <hr>
              </div>

              <div class="col-12">
                <h4>Answers</h4>
              </div>
              @foreach ( $answers as $i => $answer)

              <div class="col-12">
                <div class="form-group row">
                  @foreach ( config('translatable.locales') as $lang)
                  <div class="col-md-4">
                    <label>{{$lang}}</label>
                    <input type="text" class="form-control" name="{{$lang}}[answer][]"
                      value="{{$answer->translate($lang)->answer}}" required>
                      <small id="{{$lang.'_answer_'.$i.'_error'}}" class="form-text text-danger center small_error"> </small>
                  </div>
                  @endforeach
                </div>

                <div class="form-group row">
                  <div class="col-md-2">
                    <span>@lang('locale.values')</span>
                  </div>
                  <div class="col-md-2">
                    <input type="number" id="text" class="form-control" name="ansvalue[value_1][]" value="{{$answer->value_1}}">
                      <small id="ansvalue_value_1_{{$i}}_error" class="form-text text-danger small_error"> </small>
                  </div>
                  <div class="col-md-2">
                    <input type="number" id="text" class="form-control" name="ansvalue[value_2][]"
                      value="{{$answer->value_2}}">
                      <small id="ansvalue_value_2_{{$i}}_error" class="form-text text-danger small_error"> </small>
                  </div>
                  <div class="col-md-2">
                    <input type="number" id="text" class="form-control" name="ansvalue[value_3][]"
                      value="{{$answer->value_3}}">
                      <small id="ansvalue_value_3_{{$i}}_error" class="form-text text-danger small_error"> </small>
                  </div>
                  <div class="col-md-2">
                    <input type="number" id="text" class="form-control" name="ansvalue[value_4][]"
                      value="{{$answer->value_4}}">
                      <small id="ansvalue_value_4_{{$i}}_error" class="form-text text-danger small_error"> </small>
                  </div>
                  <div class="col-md-2">
                    <input type="number" id="text" class="form-control" name="ansvalue[value_5][]"
                      value="{{$answer->value_5}}">
                      <small id="ansvalue_value_5_{{$i}}_error" class="form-text text-danger small_error"> </small>
                  </div>
                </div>
                <hr>
              </div>
              @endforeach



              <div class="col-12">
                <button id="edit" type="button" class="btn btn-primary mr-1 mb-1">Submit</button>
                <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                <button type="reset" class="btn btn-warning mr-1 mb-1" onclick="location.reload()">Cancel</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>




