
@extends('layouts/contentLayoutMaster')

@section('title', 'Create Licensecode Page')

@section('page-style')
        <!-- Page css files -->
        <link rel="stylesheet" href="{{ asset(mix('css/plugins/forms/wizard.css')) }}">
@endsection


@section('content')
<!-- Form wizard with number tabs section start -->
<section >
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <p>Create neat and clean form wizard using <code>.wizard-circle</code> class.</p>

              {{-- <form novalidate id="form" action="{{ url('app-licensecode-UpdateOrCreate')  }}" method="POST" class="number-tab-steps wizard-circle" >
               @csrf
              <!-- Step 1 -->
              <h6>Step 1</h6>
              <fieldset>
                <div class="row">
                    Generate Licensecode
                </div>
              </fieldset>
            </form> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Form wizard with number tabs section end -->

@endsection

@section('vendor-script')
        <!-- vendor files -->
        <script src="{{ asset(mix('vendors/js/extensions/jquery.steps.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection

@section('page-script')
        <!-- Page js files -->
        <script src="{{ asset(mix('js/scripts/forms/wizard-steps.js')) }}"></script>
@endsection
