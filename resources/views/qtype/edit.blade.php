<div class="col-md-12 col-12">
  <div class="card">
      <div class="card-header">
        <h4 class="card-title">{{__('locale.Edit')}} {{ $record->type }} {{__('locale.qtype')}} </h4>
      </div>
      <div class="card-content">
        <div class="card-body">

          <form id="formedit" class="form form-horizontal" enctype="multipart/form-data">

            @csrf
            {{ method_field('put') }}
            <div class="form-body">
              <div class="row">

                <input type="hidden" id="url" value="{{ url('en/qtype-edit/' . $record->id) }}">
                <input type="hidden" id="qtype_id" value="{{ $record->id }}">
                <input type="hidden" id="qtype_type" value="{{ $record->type }}" name="type" >

                <div class="form-group row">
                  <div class="col-sm-12 col-12" id="add-new-select">
                    <p>{{__('locale.please select Question Type')}}</p>
                    <div class="form-group">
                      <select class="select2 form-control" id="qtype" disabled>
                        @foreach ( $types as $type)
                          <option value="{{$type}}" {{ $type == $record->type ? 'selected' : ''}} >{{$type}}</option>
                        @endforeach
                      </select>
                      <small id="{{'type_error'}}" class="form-text text-danger center small_error"> </small>
                    </div>
                  </div>
                </div>


                <div>
                <h3>Title</h3>
                <div class="form-group row">
                  @foreach ( config('translatable.locales') as $lang)

                        <div class="{{ $loop->last ? 'col-md-12' : 'col-md-6'}}">
                        <label>{{$lang}}</label>
                        <input type="text" class="form-control" name="{{$lang}}[title]" value="{{$record->translate($lang)->title}}" required>
                          <small id="{{$lang.'_title_error'}}" class="form-text text-danger center small_error"> </small>
                        </div>

                  @endforeach
                </div>

                <hr>

                <h3>Entro</h3>
                <div class="form-group row">
                  @foreach ( config('translatable.locales') as $lang)
                    <div class="{{ $loop->last ? 'col-md-12' : 'col-md-6'}}">
                      <label>{{$lang}}</label>
                      <input type="text" class="form-control" name="{{$lang}}[entro]" value="{{$record->translate($lang)->entro}}" required>
                        <small id="{{$lang.'_entro_error'}}" class="form-text text-danger center small_error"> </small>
                    </div>
                  @endforeach
                </div>

                <div id="sec" class="secrow" >

                  <h3>Perception</h3>
                  @for ($i = 0 ; $i < sizeof(json_decode($record->msg)) ; $i++)
                    <hr>
                    <div class="form-group row">
                      <div class="col-md-12">
                        <label>Sec: </label>
                        <input type="text" class="form-control" name="sec[]" value="{{ json_decode($record->msg , true)[$i]['sec'] }}" required>
                        <small id="sec_{{$i}}_error" class="form-text text-danger center small_error"> </small>
                      </div>

                      @foreach ( config('translatable.locales') as $lang)
                        <div class="{{ $loop->last ? 'col-md-12' : 'col-md-6'}}">
                          <label>{{$lang}}</label>
                          <input type="text" class="form-control" name="{{$lang}}[msg][]" value="{{json_decode($record->translate($lang)->msg , true)[$i]['msg']}}" required>
                          <small id="{{$lang}}_msg_{{$i}}_error" class="form-text text-danger center small_error"> </small>
                        </div>
                      @endforeach
                    </div>
                  @endfor
                </div>


                </div>
              </div>

            </div>
          </div>
          </form>
        </div>
      </div>
  </div>
</div>




<div class="col-12">
  <button id="edit" type="button" class="btn btn-primary mr-1 mb-1">{{__('locale.Submit')}}</button>
  <button type="reset" class="btn btn-warning mr-1 mb-1" onclick="location.reload()">{{__('locale.Cancel')}}</button>
</div>






@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/select/form-select2.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/extensions/toastr.js')) }}"></script>
@endsection


<script>



$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

// $('#qtype').on('change', function () {
//   var type = $(this).val();
//   if(type == 'Hazard-Perception'){
//     $(".secrow").css("display", "");
//   }else{
//     $(".secrow").css("display", "none");
//   }
// });


</script>
