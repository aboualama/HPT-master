<div class="col-md-12 col-12">
  <h4>Question Type - {{ $type }} </h4>

  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Vertical Form with Icons</h4>
    </div>
    <div class="card-content">
      <div class="card-body">



        <form id="form" class="form form-horizontal" method="POST" action="{{ url('/en/hazardquestion') }}"
          enctype="multipart/form-data">
          @csrf
          <div class="form-body">
            <div class="row">

              <input type="hidden" name="type" value="{{ $type }}">
              <input type="hidden" id="url" value="/en/hazardquestion">

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
              </div>

            </div>

            <div class="col-12">
              <div class="row">

                <video id="player" playsinline controls data-poster="/path/to/poster.jpg"
                  style="height: 350px; width: 620px; margin: 0 auto"
                  onclick="document.getElementById('input').click()">
                  <source src="" type="video/mp4" size="720" />
                </video>

                <input id="input" type="file"
                  onchange="document.getElementById('player').src=window.URL.createObjectURL(this.files[0])"
                  name="video" style="display:none;">
              </div>
              <small id="video_error" class="form-text text-danger center small_error"> </small>
              <hr>
            </div>


            <div class="col-12">
              <hr>
              <h4>Answers</h4>
              <hr>
            </div>

            <div class="col-12">
              <div class="form-group row">
                @foreach ( config('translatable.locales') as $lang)
                <div class="col-md-4">
                  <input type="text" id="choice1" class="form-control" name="{{$lang}}[answer][]"
                    placeholder="@lang('locale.' . $lang . '.answer')">
                  <small id="{{$lang.'_answer_0_error'}}" class="form-text text-danger center small_error"> </small>
                </div>
                @endforeach
              </div>
            </div>

            <div class="col-12">
              <div class="form-group row">
                <div class="col-md-2">
                  <span>@lang('locale.values')</span>
                </div>
                <div class="col-md-2">
                  <input type="number" id="value_1" class="form-control" name="ansvalue[value_1][]"
                    placeholder="@lang('locale.value') 1">
                  <small id="ansvalue_value_1_0_error" class="form-text text-danger small_error"> </small>
                </div>
                <div class="col-md-2">
                  <input type="number" id="value_2" class="form-control" name="ansvalue[value_2][]"
                    placeholder="@lang('locale.value') 2">
                  <small id="ansvalue_value_2_0_error" class="form-text text-danger small_error"> </small>
                </div>
                <div class="col-md-2">
                  <input type="number" id="value_3" class="form-control" name="ansvalue[value_3][]"
                    placeholder="@lang('locale.value') 3">
                  <small id="ansvalue_value_3_0_error" class="form-text text-danger small_error"> </small>
                </div>
                <div class="col-md-2">
                  <input type="number" id="value_4" class="form-control" name="ansvalue[value_4][]"
                    placeholder="@lang('locale.value') 4">
                  <small id="ansvalue_value_4_0_error" class="form-text text-danger small_error"> </small>
                </div>
                <div class="col-md-2">
                  <input type="number" id="value_5" class="form-control" name="ansvalue[value_5][]"
                    placeholder="@lang('locale.value') 5">
                  <small id="ansvalue_value_5_0_error" class="form-text text-danger small_error"> </small>
                </div>
              </div>
            </div>

            <div class="col-12">
              <hr>
            </div>

            <div id="Answers">
            </div>

            <div class="col-12">
              <hr>
            </div>

            <div class="col-12">
              <button id="submit" type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
              <a type="add" class="btn btn-outline-warning mr-1 mb-1" href="#" onclick="addAnswer()">Add Answer</a>
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

{{-- Page js files --}}
<script src='plyr.min.js'></script>
<link href="plyr.css" rel="stylesheet">
<script>
  var player = new Plyr('#player');
</script>
@endsection
