<div class="col-md-12 col-12">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">{{__('locale.Edit')}}  {{__('locale.qtype')}} </h4>
    </div>
    <div class="card-content">
      <div class="card-body">
        <div class="col-12">
          <form id="form" class="form form-horizontal" enctype="multipart/form-data">

            @csrf
            <div class="form-body">
              <div class="row">

                <input type="hidden" id="url" value="{{ url('en/qtype/') }}">

                <div class="form-group row">
                  <div class="col-sm-12 col-12" id="add-new-select">
                    <p>{{__('locale.please select Question Type')}}</p>
                    <div class="form-group">
                      <select class="select2 form-control" id="qtype" name="type">
                        <option value="" selected>{{__('locale.Question Type')}}</option>
                        @foreach ( $types as $type)
                          <option value="{{$type}}">{{$type}}</option>
                        @endforeach
                      </select>
                      <small id="{{'type_error'}}" class="form-text text-danger center small_error"> </small>
                    </div>
                  </div>
                </div>


                <div>
                  <h3>Test Title</h3>
                  <div class="form-group row">
                    @foreach ( config('translatable.locales') as $lang)

                      <div class="{{ $loop->last ? 'col-md-12' : 'col-md-6'}}">
                        <label>{{$lang}}</label>
                        <input type="text" class="form-control" name="{{$lang}}[title]" value="" required>
                        <small id="{{$lang.'_title_error'}}" class="form-text text-danger center small_error"> </small>
                      </div>

                    @endforeach
                  </div>

                  <hr>

                  <h3>Intro</h3>
                  <div class="form-group row">
                    @foreach ( config('translatable.locales') as $lang)
                      <div class="{{ $loop->last ? 'col-md-12' : 'col-md-6'}}">
                        <label>{{$lang}}</label>
                        <input type="text" class="form-control" name="{{$lang}}[entro]" value="" required>
                        <small id="{{$lang.'_entro_error'}}" class="form-text text-danger center small_error"> </small>
                      </div>
                    @endforeach
                  </div>

                  <hr>
                  <div id="sec" class="secrow" style="display: none">
                    <h3>Perception</h3>
                    <div class="form-group row">
                      <div class="col-md-12">
                        <label>Sec: </label>
                        <input type="text" class="form-control" name="sec[]" value="" >
                        <small id="{{'sec_0_error'}}" class="form-text text-danger center small_error"> </small>
                      </div>
                      @foreach ( config('translatable.locales') as $lang)
                      <div class="{{ $loop->last ? 'col-md-12' : 'col-md-6'}}">
                          <label>{{$lang}}</label>
                          <input type="text" class="form-control" name="{{$lang}}[msg][]" value="" >
                          <small id="{{$lang.'_msg_0_error'}}" class="form-text text-danger center small_error"> </small>
                        </div>
                      @endforeach
                    </div>
                  </div>



                  <div id="rowindex">  </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="col-12">
  <button id="submit" type="button" class="btn btn-primary mr-1 mb-1">{{__('locale.Submit')}}</button>
  <button type="reset" class="btn btn-outline-warning mr-1 mb-1" id="secbtn" onclick="addmsg()" style="display: none">{{__('locale.Add')}}</button>
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

$('#qtype').on('change', function (e) {
  var type = $(this).val();
  if(type == 'Hazard-Perception'){
    $(".secrow").fadeIn();
    $("#secbtn").fadeIn();
  }else{
    $(".secrow").fadeOut();
    $("#secbtn").fadeOut();
  }
});





function addmsg() {
      let i = $('.rowindex').length
      let m =  `<div class="rowindex secrow" id="rowindex_`+ i +`">
                    <div class="form-group row">
                      <div class="col-md-12">
                        <label>Sec: </label>
                        <input type="text" class="form-control" name="sec[]" >
                        <small id="{{'sec_${i+1}_error'}}" class="form-text text-danger center small_error"> </small>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-6">
                        <label>en</label>
                        <input type="text" class="form-control" name="en[msg][]" required>
                        <small id="{{'en_msg_${i+1}_error'}}" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-6">
                        <label>it</label>
                        <input type="text" class="form-control" name="it[msg][]" required>
                        <small id="{{'it_msg_${i+1}_error'}}" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-6">
                        <label>pt</label>
                        <input type="text" class="form-control" name="pt[msg][]" required>
                        <small id="{{'pt_msg_${i+1}_error'}}" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-6">
                        <label>fr</label>
                        <input type="text" class="form-control" name="fr[msg][]" required>
                        <small id="{{'fr_msg_${i+1}_error'}}" class="form-text text-danger center small_error"> </small>
                      </div>
                      <div class="col-md-12">
                        <label>gr</label>
                        <input type="text" class="form-control" name="gr[msg][]" required>
                        <small id="{{'gr_msg_${i+1}_error'}}" class="form-text text-danger center small_error"> </small>
                      </div>
                    </div>
                </div>`;

      $("#rowindex").append(m);
    }



</script>

