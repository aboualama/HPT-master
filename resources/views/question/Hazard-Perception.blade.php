
<div class="col-md-12 col-12">

  @include('partials._errors')
  <div class="card">
      <div class="card-header">
          <h4 class="card-title">{{__('locale.Question Type')}} - {{ $type }} </h4>
      </div>
      <div class="card-content">
          <div class="card-body">

            <form id="form" class="form form-horizontal" method="POST" action="{{ url('en/hazardpquestion') }}" enctype="multipart/form-data">
                @csrf
                  <div class="form-body">
                      <div class="row">

                        <input type="hidden" name="type" value="{{ $type }}">
                        <input type="hidden" id="url" value="/en/hazardpquestion">


                        <div  class="col-12">
                          <hr>
                        </div>



                        <div class="col-12">
                          <div class="row">

                            <div class="col-md-12">
                              <h4 class="text-center">{{__('locale.select video')}}</h4>
                              <video id="player" playsinline controls data-poster="{{asset('uploads/img_answers/default.jpg')}}"
                                style="height: 350px; width: 620px; display: block; margin: 0 auto; margin-bottom: 25px;"
                                onclick="document.getElementById('input').click()">
                                <source src="{{asset('uploads/video/demo.mp4')}}" type="video/mp4" size="720" />
                              </video>

                              <input id="input" type="file"
                                onchange="document.getElementById('player').src=window.URL.createObjectURL(this.files[0])"
                                name="video" style="display:none;">
                                <small id="video_error" class="form-text text-danger center small_error"> </small>
                            </div>


                          </div>
                          <hr>
                        </div>



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


