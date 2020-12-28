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


              <div class="col-12">
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="text-center">{{__('locale.select video')}}</h4>
                    <video id="player" playsinline controls data-poster="{{asset('uploads/image/default.jpg')}}"
                           style="max-height: 350px; max-width: 100%; display: block; margin: 0 auto;"
                           onclick="document.getElementById('input').click()">
                      <source src="{{$record->video_path}}" type="video/mp4" size="720"/>
                    </video>

                    <input id="input" type="file"
                           onchange="document.getElementById('player').src=window.URL.createObjectURL(this.files[0])"
                           name="video" style="display:none;">
                    <small id="video_error" class="form-text text-danger text-center small_error"> </small>
                  </div>
                </div>
                <hr>
              </div>
              {{-- @php($rightanswers = json_decode($record->right_answers,true)?json_decode($record->right_answers,true):[]) --}}

              {{-- @php($wronganswers = json_decode($record->wrong_answers,true)?json_decode($record->wrong_answers,true) : []) --}}

              @if(is_object(json_decode($record->wrong_answers)[0]))

              @foreach( json_decode($record->wrong_answers , true) as $ans)

                <div class="col-12">
                  <div class="row rowindex" id="rowindex_{{$loop->index}}">
                    <div class="col-md-7 offset-md-1">
                      <label> ... </label>
                      <input type="text" value="{{$ans['answer']}}" class="form-control " name="answer[]"
                             placeholder="Pericolo">
                      <small id="answer_0_error" class="form-text text-danger center small_error"> </small>
                    </div>
                    <div class="col-md-2">
                      <label>...</label>
                      <input type="number" step="0.01" min=0 class="form-control " value="{{$ans['val']}}" name="val[]"
                             placeholder="Secondi">
                      <small id="val_0_error" class="form-text text-danger center small_error"> </small>
                    </div>
                    <div class="col-md-2">
                      <div class="col-md-2" style="display: inline;">
                        <span onclick="addrow()" style="font-size: 25px; line-height: 3;"><i class="feather icon-plus-square"></i></span>
                        {{--  <span class="close-div" style="font-size: 25px"><i class="feather icon-trash-2"></i></span>--}}
                        <span onclick="removerow({{$loop->index}})" style="font-size: 25px"><i class="feather icon-trash-2"></i></span>
                      </div>
                    </div>
                  </div>
                  <hr>
                </div>
              @endforeach

              @else

              <div class="col-12">
                <div class="row rowindex" id="rowindex_0">
                  <div class="col-md-7 offset-md-1">
                    <input type="text" class="form-control " name="answer[]" placeholder="Pericolo">
                    <small id="answer_0_error" class="form-text text-danger center small_error"> </small>
                  </div>
                  <div class="col-md-2">
                    <input type="number" step="0.01" min=0 class="form-control " name="val[]" placeholder="Secondi">
                    <small id="val_0_error" class="form-text text-danger center small_error"> </small>
                  </div>
                  <div class="col-md-2">
                    <div class="col-md-2" style="display: inline;">
                      <span onclick="addrow()" style="font-size: 25px"><i class="feather icon-plus-square"></i></span>
                      {{--  <span class="close-div" style="font-size: 25px"><i class="feather icon-trash-2"></i></span>--}}
                     <span onclick="removerow(0)" style="font-size: 25px"><i class="feather icon-trash-2"></i></span>
                    </div>
                  </div>
                </div>
                <hr>
              </div>


              @endif

              <div id="rowindex" class="col-12">
              </div>

              {{-- @if(json_decode($record->wrong_answers,true) == [])
                <div class="col-12" id="rowindex">
                  <div class="row rowindex" id="rowindex_0">
                    <div class="col-md-7 offset-md-1">
                      <label> ... </label>
                      <input type="text" class="form-control " name="answer[]" placeholder="Pericolo">
                      <small id="answer_0_error" class="form-text text-danger center small_error"> </small>
                    </div>
                    <div class="col-md-2">
                      <label>...</label>
                      <input type="number" step="0.01" min=0 class="form-control " name="val[]" placeholder="Secondi">
                      <small id="val_0_error" class="form-text text-danger center small_error"> </small>
                    </div>
                    <div class="col-md-2">
                      <div class="col-md-2" style="display: inline;">

                        <span onclick="addrow()" style="font-size: 25px; line-height: 3;"><i class="feather icon-plus-square"></i></span> --}}

                        {{--  <span class="close-div" style="font-size: 25px"><i class="feather icon-trash-2"></i></span>--}}
                        {{-- <span onclick="removerow(0)" style="font-size: 25px"><i class="feather icon-trash-2"></i></span>
                      </div>
                    </div>
                  </div>
                  <hr>
                </div>
              @endif --}}



              <div class="col-12">
                <button id="edit" type="button" class="btn btn-primary mr-1 mb-1">{{__('locale.Submit')}}</button>
                <button type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('locale.Reset')}}</button>
                <button type="reset" class="btn btn-warning mr-1 mb-1"
                        onclick="location.reload()">{{__('locale.Cancel')}}</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>

  $(document).ready(function () {

    function addrow() {
      let i = $('.rowindex').length
      let m = `<div class="row rowindex" id="rowindex_` + i + `">
                    <div class="col-md-7 offset-md-1">
                      <label> ... </label>
                      <input type="text" class="form-control " name="answer[]" placeholder="Key">
                      <small id="answer_` + i + `_error" class="form-text text-danger center small_error"> </small>
                    </div>
                    <div class="col-md-2">
                      <label>...</label>
                      <input type="number" step="0.01" min=0 class="form-control " name="val[]" placeholder="Value">
                      <small id="val_` + i + `_error" class="form-text text-danger center small_error"> </small>
                    </div>
                    <div class="col-md-2">
                      <div class="col-md-2" style="display: inline;">
                        <span class="action-add" data-id="" onclick="addrow()" style="font-size: 25px;"><i class="feather icon-plus-square"></i></span>
                        <span onclick="removerow(` + i + `)" style="font-size: 25px"><i class="feather icon-trash-2"></i></span>
                      </div>
                    </div>
                  </div> `;

      $("#rowindex").append(m);
    }


    function removerow(i) {
      $('#rowindex_' + i).fadeOut();
    }
  });

</script>
