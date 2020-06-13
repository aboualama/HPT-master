@extends('layouts/contentLayoutMaster')

@section('title', 'Show Licensecode Page')

@section('page-style')
        {{-- Page Css files --}}
        <link rel="stylesheet" href="{{ asset(mix('css/pages/app-user.css')) }}">
@endsection

@section('content')
<!-- page users view start -->
<section class="page-users-view">
  <div class="row">
    <!-- account start -->
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="card-title">Account</div>
          <div class="row">
            <div class="col-2 users-view-image">
              <img src="{{ asset('images/portrait/small/avatar-s-12.jpg') }}" class="w-100 rounded mb-2"
                alt="avatar">
              <!-- height="150" width="150" -->
            </div>
            <div class="col-sm-4 col-12">
              <table>
                <tr>
                  <td class="font-weight-bold">Username</td>
                  <td>{{ $licensecode->name }}</td>
                </tr>
              </table>
            </div>
            <div class="col-12">
              <a href="app-licensecode-edit" class="btn btn-primary mr-1"><i class="feather icon-edit-1"></i> Edit</a>
              <button class="btn btn-outline-danger"><i class="feather icon-trash-2"></i> Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- account end -->
    <!-- information start -->
    <div class="col-md-6 col-12 ">
      <div class="card">
        <div class="card-body">
          <div class="card-title mb-2">Information</div>
        </div>
      </div>
    </div>
    <!-- information start -->
  </div>
</section>
<!-- page users view end -->
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/app-user.js')) }}"></script>
@endsection
