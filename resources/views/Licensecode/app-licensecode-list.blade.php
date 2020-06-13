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
                    <label>Lincence Number</label>
                    <input type="number" id="lNumber" value="1" min="1">
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
        @foreach ($records['licenses'] as $user)
          <tr>
            <td></td>
            <td class="licenses-id" id="licenses-id_{{ $user->id }}">{{ $user->id }}</td>
            <td class="licenses-Code" id="licenses-Code_{{ $user["id"] }}">{{ $user->code }}</td>
            <td class="licenses-user_id" id="licenses-user_{{ $user["id"] }}">{{ $user->user->name }}</td>
            <td class="licenses-role" id="name-user_{{ $user["id"] }}">Admin</td>
            <td class="licenses-role" id="name-user_{{ $user["id"] }}">Active</td>
            <td class="user-action">
              <span class="action-edit" data-id="{{$user["id"]}}"><i class="feather icon-edit"></i></span>
              <span class="action-delete" data-id="{{$user["id"]}}"><i class="feather icon-trash"></i></span>
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

  </script>
@endsection
