@if($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li> {{ $error }} </li>
        @endforeach
    </div>
@endif


{{-- @if (session()->has('success'))
 <div class="alert alert-success">
   <h3 class="text-center">{{ session('success') }}</h3>
 </div>
@endif --}}

@if (session()->has('error'))
    <div class="alert alert-danger">
            <li> {{ session('error') }} </li>
    </div>
@endif


@if (session()->has('message'))
    <div class="alert alert-info">
            <li> {{ session('message') }} </li>
    </div>
@endif


@if (session('success'))
    <script>
      toastr.success("{{ session('success') }}", 'Generated!' , { "timeOut": 5000 });
    </script>
@endif
