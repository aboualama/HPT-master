@extends('layouts/contentLayoutMaster')

@section('title', __('locale.result'))


@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.css')) }}">
<style>
  .modal-body {
    max-height: calc(90vh);
    overflow-y: auto;
  }
</style>
@endsection
@section('page-style')
        {{-- Page css files --}}
        <link rel="stylesheet" href="{{ asset(mix('css/plugins/extensions/toastr.css')) }}">
@endsection


@section('content')


@include('partials._errors')


<div id="q-type"></div>




<!-- Table head options start -->
<div class="row" id="table-head">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">{{__('locale.result')}}</h4>

      </div>
      <div class="card-content">
        <div class="table-responsive">
          <table class="table mb-0">
            <thead class="thead-dark">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">{{__('locale.username')}}</th>
                <th scope="col">{{__('locale.email')}}</th>
                <th scope="col">{{__('locale.Licensecode')}}</th>
                <th scope="col">{{__('locale.point')}}</th>
                <th scope="col">{{__('locale.Date')}}</th>
                <th scope="col">{{__('locale.Action')}}</th>
              </tr>
            </thead>
            <tbody>

              @if(isset($records))
                @foreach ($records as $i => $record)
                <tr>
                  <th scope="row">{{$i +1}}</th>
                  <td id="result_{{$record->id}}" class="username">{{$record->user->name}}</td>
                  <td id="result_{{$record->id}}" class="email">{{$record->user->email}}</td>
                  <td id="result_{{$record->id}}" class="licensecode">{{$record->licensecode->code}}</td>
                  <td id="result_{{$record->id}}" class="point">{{$record->point}}</td>
                  <td id="result_{{$record->id}}" class="date">{{$record->created_at}}</td>
                  <td>
                    <span class="action-mail" data-id="{{$record->id}}"><i class="feather icon-mail"></i></span>
                    <span class="action-xml" data-id="{{$record->id}}"><i class="feather icon-file"></i></span>
                  </td>
                </tr>
                @endforeach
              @endif

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Table head options end -->







@endsection


@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')

<!-- Page js files -->


<script src="{{ asset(mix('js/scripts/forms/select/form-select2.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/extensions/toastr.js')) }}"></script>
<script src="{{ asset('js/scripts/ui/result.js') }}"></script>


<script>



  </script>
  @endsection
