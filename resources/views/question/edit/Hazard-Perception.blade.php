<div class="col-md-12 col-12">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">{{__('locale.Edit')}} {{ $record->type }} {{__('locale.question')}} </h4>
    </div>
    <div class="card-content">
      <div class="card-body">

        <form id="formedit" class="form form-horizontal"
          enctype="multipart/form-data">
          @csrf
          {{ method_field('put') }}
          <div class="form-body">
            <div class="row">

              <input type="hidden" name="type" value="{{$type}}">
              <input type="hidden" id="url" value="{{ url('en/edit-question-4/' . $record->id) }}">
              <input type="hidden" id="question_id" value="{{ $record->id }}">

              <div class="col-12">
                <hr>
              </div>


              <div class="col-12">
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="text-center">{{__('locale.select video')}}</h4>
                    <video id="player" playsinline controls data-poster="{{asset('uploads/image/default.jpg')}}"
                      style="max-height: 350px; max-width: 100%; display: block; margin: 0 auto;"
                      onclick="document.getElementById('input').click()">
                      <source src="{{$record->video_path}}" type="video/mp4" size="720" />
                    </video>

                    <input id="input" type="file"
                      onchange="document.getElementById('player').src=window.URL.createObjectURL(this.files[0])"
                      name="video" style="display:none;">
                      <small id="video_error" class="form-text text-danger text-center small_error"> </small>
                  </div>
                </div>
                <hr>
              </div>


              <div class="col-12">
                <button id="edit" type="button" class="btn btn-primary mr-1 mb-1">{{__('locale.Submit')}}</button>
                <button type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('locale.Reset')}}</button>
                <button type="reset" class="btn btn-warning mr-1 mb-1" onclick="location.reload()">{{__('locale.Cancel')}}</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>