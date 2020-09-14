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
                    <span class="action-mail" data-id="{{$record->id}}" ><i class="feather icon-mail"></i></span>
                    <span class="action" data-id="{{$record->id}}" onclick="downloadXML({{$record->id}})" ><i class="feather icon-file"></i></span>
                    {{-- <span class="edit" data-id="{{$record->id}}" onclick="edit({{$record->id}})" ><i class="feather icon-edit"></i></span> --}}
                    <span class="action-edit" data-id="{{$record->id}}"><i class="feather icon-edit"></i></span>
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


<iframe id="downloadXML" style="display:none;"></iframe>




{{-- Modal --}}
<div class="col-12">
  <div class="row">
    <div class="modal-size-lg mr-1 mb-1 d-inline-block">
      <div class="modal fade text-left" id="modal-block-edit" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel17" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <div id="result">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


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
  function downloadXML(id) {
    var ifrm = document.getElementById('ifrm_' + id);
    if (!ifrm) {
      ifrm = document.createElement('iframe');
      ifrm.setAttribute('id', 'ifrm_' + id);
      ifrm.style.display = "none";
      ifrm.style.height = "0px";
      ifrm.style.wid = "0px";
      el = document.getElementById('downloadXML');
      el.parentNode.insertBefore(ifrm, el)
    }

    ifrm.src = '/convert-xml/' + id;

  }





  $('.action-edit').on("click", function (e) {
      e.stopPropagation();
      var id = $(this).data("id");

      $.ajax({
        type: 'GET',
        url: '/result-edit/' + id,
        success: function (data) {
          $('#modal-block-edit').modal('toggle');
          $('#result').html(data);
        }
      });
    });


        $(document).on('click', '#edit', function (e) {
            e.preventDefault();
            var url = $("#url").val();
            var result_id = $("#result_id").val();
            console.log(result_id);

            $.ajax({
                url: url ,
                data: {
                  id : result_id
                },
                type: 'put',
                success: function (data) {
                        console.log(data);
                }, error: function (xhr) {
                        console.log(data);
                }
            });
        });


  </script>
  @endsection
