@extends('layouts/contentLayoutMaster')

@section('title', 'Create New Question Type Page')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/plugins/forms/validation/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/pages/app-user.css')) }}">


  <link rel="stylesheet" href="{{ asset(mix('css/plugins/file-uploaders/dropzone.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/pages/data-list-view.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/plugins/extensions/toastr.css')) }}">
@endsection


@section('content')




  <!-- users edit start --><!-- Basic Horizontal form layout section start -->
<section id="basic-horizontal-layouts">
  <div class="row match-height">
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Question Type Form</h3>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form class="form form-horizontal" method="POST" action="{{ url('/en/questiontype') }}">
                @csrf
              <div class="form-body">
                <div class="row">

                  @foreach ( config('translatable.locales') as $lang)
                      <div class="col-12">
                        <div class="form-group row">
                          <div class="col-md-3">
                            <span>@lang('locale.' . $lang . '.title')</span>
                          </div>
                          <div class="col-md-9">
                          <input type="text" id="title" class="form-control" name="{{$lang}}[title]">
                          </div>
                        </div>
                      </div>
                  @endforeach

                  <div  class="col-12">
                  <hr>
                  </div>

                  @foreach ( config('translatable.locales') as $lang)
                      <div class="col-12">
                        <div class="form-group row">
                          <div class="col-md-3">
                            <span>@lang('locale.' . $lang . '.intro')</span>
                          </div>
                          <div class="col-md-9">
                            <textarea  id="intro" class="form-control" name="{{$lang}}[intro]">
                           </textarea>
                          </div>
                        </div>
                      </div>
                  @endforeach

                  <div  class="col-12">
                  <hr>
                  </div>

                  @foreach ( config('translatable.locales') as $lang)
                      <div class="col-12">
                        <div class="form-group row">
                          <div class="col-md-3">
                            <span>@lang('locale.' . $lang . '.description')</span>
                          </div>
                          <div class="col-md-9">
                          <input type="text" id="description" class="form-control" name="{{$lang}}[description]" >
                          </div>
                        </div>
                      </div>
                  @endforeach

                  <div class="col-md-9 offset-md-3">
                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                    <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


  </div>
</section>
<!-- // Basic Horizontal form layout section end -->

@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jqBootstrapValidation.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/app-user.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/navs/navs.js')) }}"></script>

  <script src="{{ asset(mix('js/scripts/extensions/toastr.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/extensions/sweet-alerts.js')) }}"></script>

  <script>
    // Update or Create User
    $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
  </script>
@endsection


