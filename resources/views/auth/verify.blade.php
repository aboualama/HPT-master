@extends('layouts/fullLayoutMaster')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    {{-- <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>. --}}


                    <form  method="POST" action="{{ route('verification.resend') }}">
                      @csrf
                        <div class="col-12">
                            <button  type="submit" class="btn btn-info btn-sm" style="float: right">{{ __('click here to request another') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
