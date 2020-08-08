@extends('layouts/contentLayoutMaster')

@section('title', 'Licensecode List Page')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/ag-grid/ag-grid.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/ag-grid/ag-theme-material.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/pages/app-user.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/pages/aggrid.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/pages/data-list-view.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/plugins/extensions/toastr.css')) }}">
@endsection

@section('content')
  <!-- users list start -->
  <section class="users-list-wrapper">
    <!-- users filter start -->
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Generate Licensecode</h4>
        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
          <ul class="list-inline mb-0">
            <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="card-content collapse show">
        <div class="card-body">
          <div class="users-list-filter">
            <form action="#">
              @csrf
              <div class="row">
                <div class="col-3">
                  <div class="form-group">
                    <input class="form-control" type="number" id="number" min="1" placeholder="Lincence Number">
                  </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                  <fieldset class="form-group">
                    <select class="form-control" id="user-id">
                      <option value="">All Users</option>
                      @foreach ($records['users'] as $record)
                        <option value="{{$record->id}}">{{$record->name}}</option>
                      @endforeach
                    </select>
                  </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                  <input type="submit" id="generate" class="btn btn-primary" value="Generate">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


    <div class="table-responsive">
      <table class="table data-list-view" id="user-list-table">
        <thead>
        <tr>
          <th></th>
          <th>id</th>
          <th>license</th>
          <th>USER</th>
          <th>Role</th>
          <th>Status</th>
          <th>ACTION</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($records['licenses'] as $i => $record)
          <tr>
            <td></td>
            <td class="licenses-id">{{ $i +1 }}</td>
            <td class="licenses-Code">{{ $record->code }}</td>
            <td class="licenses-user_id">{{ $record->user->name }}</td>
            <td class="licenses-role">Admin</td>
            <td class="licenses-role">Active</td>
            <td class="user-action">
              <span class="action-delete" data-id="{{ $record->id }}"><i class="feather icon-trash"></i></span>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <!-- Ag Grid users list section end -->
  </section>
  <!-- users list ends -->
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/tables/ag-grid/ag-grid-community.min.noStyle.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/app-user.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/extensions/toastr.js')) }}"></script>


  <script>

    // Generate Licensecode
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    $('#generate').on("click", function (event) {
      event.preventDefault();
      $.ajax({
        type: "POST",
        url: "app-licensecode-UpdateOrCreate",
        data: {
          'user_id': $('#user-id').val(),
          'number': $('#number').val(),
        },
        success: function (data) {
          toastr.success('Licensecode Generated Successfully.', 'Generated!', {"timeOut": 5000});
          location.reload();
        },
        error: function (data) {
          console.log('Error:', data);
        }
      });
    });


  // On Delete
  $('.action-delete').on("click", function(e){
    e.stopPropagation();
    var id = $(this).data("id");
    var td = $(this).closest('td').parent('tr');
    $.ajax({
        url: "/app-licensecode-delete" + '/' + id,
        method: "DELETE",
        success: function (data) {
          toastr.success('Deleted Successfully',"licensecode!",);
          td.fadeOut();
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
  });

  </script>
@endsection
