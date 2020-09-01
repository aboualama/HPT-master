
<div class="col-md-12 col-12">

  @include('partials._errors')
  <div class="card">
      <div class="card-header">
          <h4 class="card-title">{{__('locale.Question Type')}} - {{ $type }} </h4>
      </div>
      <div class="card-content">
          <div class="card-body">

            <form id="form" class="form form-horizontal" method="POST" action="{{ url('en/question') }}" enctype="multipart/form-data">
                @csrf
                  <div class="form-body">
                      <div class="row">

                        <input type="hidden" name="type" value="{{ $type }}">
                        <input type="hidden" id="url" value="/en/question">

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

                        <div  class="col-12">
                          <hr>
                        </div>



                        <div class="col-12">
                          <div class="row">

                            {{--<div class="col-md-6">
                              <h4 class="text-center">{{__('locale.select video')}}</h4>
                              <video id="player" playsinline controls data-poster="{{asset('uploads/image/default.jpg')}}"
                                style="height: 350px; width: 620px; display: block; margin: 0 auto; margin-bottom: 25px;"
                                onclick="document.getElementById('input').click()">
                                <source src="{{asset('uploads/video/demo.mp4')}}" type="video/mp4" size="720" />
                              </video>

                              <input id="input" type="file"
                                onchange="document.getElementById('player').src=window.URL.createObjectURL(this.files[0])"
                                name="video" style="display:none;">
                                <small id="video_error" class="form-text text-danger center small_error"> </small>
                            </div>--}}

                            <div class="col-md-12">
                              <h4 class="text-center">{{__('locale.select img')}}</h4>
                              <img
                                id="preview_img"
                                onclick="document.getElementById('input_img').click()"
                                src="{{asset('uploads/image/default.jpg')}}"
                                style="max-width: 50%; max-height: 350px; display: block; margin: 0 auto;" />
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



                        @foreach ( config('translatable.locales') as $lang)
                          <div class="col-12">
                            <span>@lang('locale.' . $lang . '.choice')</span>
                            <div class="form-group row">
                              <div class="col-md-3">
                              <input type="text" id="choice1" class="form-control" name="{{$lang}}[right_answer]" placeholder="@lang('locale.right_answer')">
                              <small id="{{$lang.'_right_answer_error'}}" class="form-text text-danger center small_error"> </small>
                              </div>
                              <div class="col-md-3">
                              <input type="text" id="choice2" class="form-control" name="{{$lang}}[wrongans_1]" placeholder="@lang('locale.wrongans_1')">
                              <small id="{{$lang.'_wrongans_1_error'}}" class="form-text text-danger center small_error"> </small>
                              </div>
                              <div class="col-md-3">
                              <input type="text" id="choice3" class="form-control" name="{{$lang}}[wrongans_2]" placeholder="@lang('locale.wrongans_2')">
                              <small id="{{$lang.'_wrongans_2_error'}}" class="form-text text-danger center small_error"> </small>
                              </div>
                              <div class="col-md-3">
                              <input type="text" id="choice4" class="form-control" name="{{$lang}}[wrongans_3]" placeholder="@lang('locale.wrongans_3')">
                              <small id="{{$lang.'_wrongans_3_error'}}" class="form-text text-danger center small_error"> </small>
                              </div>
                            </div>
                          </div>
                        @endforeach

                        <div class="col-12">
                            <button id="submit" type="submit" class="btn btn-primary mr-1 mb-1">{{__('locale.Submit')}}</button>
                            <button type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('locale.Reset')}}</button>
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
