@extends('layouts/fullLayoutMaster')

@section('title', 'Register Page')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/pages/authentication.css')) }}">
@endsection
@section('content')
<section class="row flexbox-container">
  <div class="col-xl-8 col-10 d-flex justify-content-center">
      <div class="card bg-authentication rounded-0 mb-0">
          <div class="row m-0">
              <div class="col-lg-6 d-lg-block d-none text-center align-self-center pl-0 pr-3 py-0">
                  <img src="{{ asset('images/pages/register.jpg') }}" alt="branding logo">
              </div>
              <div class="col-lg-6 col-12 p-0">
                  <div class="card rounded-0 mb-0 p-2">
                      <div class="card-header pt-50 pb-1">
                          <div class="card-title">
                              <h4 class="mb-0">Create Account</h4>
                          </div>
                      </div>
                      <p class="px-2">Compila i campi richiesti.</p>
                      {{-- <div class="card-content">
                          <div class="card-body pt-0">

                          </div>
                      </div> --}}





                      <div class="card-content">
                        <div class="card-body">
                          <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist" style="width: 50%;">
                            <li class="nav-item">
                              <a class="nav-link active" id="azienda-tab-fill" data-toggle="tab" href="#azienda-fill" role="tab" aria-controls="azienda-fill" aria-selected="false">Azienda</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="user-tab-fill" data-toggle="tab" href="#user-fill" role="tab" aria-controls="user-fill" aria-selected="false">User</a>
                            </li>
                          </ul>

                          <div class="tab-content pt-1">
                            <div class="tab-pane active" id="azienda-fill" role="tabpanel" aria-labelledby="azienda-tab-fill">
                              <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <input type="hidden" name="role" value="azienda">
                                    <div class="form-label-group">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        <label for="name">Name</label>
                                        @error('name')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>
                                    <div class="form-label-group">
                                      <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" placeholder=" Last name " value="{{ old('lastName') }}" required autocomplete="lastName">
                                      <label for="lastName">Last Name</label>
                                      @error('lastName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                  </div>
                                  <div class="form-label-group">
                                      <input id="cell" type="text" class="form-control @error('cell') is-invalid @enderror" name="cell" placeholder=" Cellulare " value="{{ old('cell') }}" required autocomplete="cell">
                                      <label for="cell">Cellulare</label>
                                      @error('cell')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                  </div>
                                  <div class="form-label-group">
                                      <input id="company" type="text" class="form-control @error('company') is-invalid @enderror" name="company" placeholder="Company" value="{{ old('company') }}" required autocomplete="company">
                                      <label for="company">Company</label>
                                      @error('company')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                  </div>
                                  <div class="form-label-group">
                                      <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Indirizzo" value="{{ old('address') }}" required autocomplete="address">
                                      <label for="address">Indirizzo</label>
                                      @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                  </div>
                                  <div class="form-label-group">
                                      <input id="cf" type="text" class="form-control @error('cf') is-invalid @enderror" name="cf" placeholder="CF/P.iva" value="{{ old('cf') }}" required autocomplete="CF/P.iva">
                                      <label for="cf">CF/P.iva</label>
                                      @error('cf')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                  </div>
                                  <div class="form-label-group">
                                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                                      <label for="email">Email</label>
                                      @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                  </div>
                                  <div class="form-label-group">
                                      <!-- <input type="password" id="inputPassword" class="form-control" placeholder="Password" required> -->
                                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                                      <label for="password">Password</label>
                                      @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                  </div>
                                  <div class="form-label-group">
                                      <!-- <input type="password" id="inputConfPassword" class="form-control" placeholder="Confirm Password" required> -->
                                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                      <label for="password-confirm">Confirm Password</label>
                                  </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <fieldset class="checkbox">
                                              <div class="vs-checkbox-con vs-checkbox-primary">
                                                <input type="checkbox" checked>
                                                <span class="vs-checkbox">
                                                  <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                  </span>
                                                </span>
                                                <span class=""> I accept the terms & conditions.</span>
                                              </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <a href="login" class="btn btn-outline-primary float-left btn-inline mb-50">Login</a>
                                    <button type="submit" class="btn btn-primary float-right btn-inline mb-50">Register</a>
                                </form>
                            </div>
                            <div class="tab-pane" id="user-fill" role="tabpanel" aria-labelledby="user-tab-fill">
                              <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <input type="hidden" name="role" value="user">
                                    <div class="form-label-group">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        <label for="name">Name</label>
                                        @error('name')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>
                                    <div class="form-label-group">
                                      <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" placeholder=" Last name " value="{{ old('lastName') }}" required autocomplete="lastName">
                                      <label for="lastName">Last Name</label>
                                      @error('lastName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                  </div>
                                  <div class="form-label-group">
                                      <input id="cell" type="text" class="form-control @error('cell') is-invalid @enderror" name="cell" placeholder=" Cellulare " value="{{ old('cell') }}" required autocomplete="cell">
                                      <label for="cell">Cellulare</label>
                                      @error('cell')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                  </div>
                                  <div class="form-label-group">
                                      <input id="company" type="text" class="form-control @error('company') is-invalid @enderror" name="company" placeholder="Company" value="{{ old('company') }}" required autocomplete="company">
                                      <label for="company">Company</label>
                                      @error('company')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                  </div>
                                  <div class="form-label-group">
                                      <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Indirizzo" value="{{ old('address') }}" required autocomplete="address">
                                      <label for="address">Indirizzo</label>
                                      @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                  </div>
                                  <div class="form-label-group">
                                      <input id="cf" type="text" class="form-control @error('cf') is-invalid @enderror" name="cf" placeholder="CF/P.iva" value="{{ old('cf') }}" required autocomplete="CF/P.iva">
                                      <label for="cf">CF/P.iva</label>
                                      @error('cf')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                  </div>
                                  <div class="form-label-group">
                                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                                      <label for="email">Email</label>
                                      @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                  </div>
                                  <div class="form-label-group">
                                      <!-- <input type="password" id="inputPassword" class="form-control" placeholder="Password" required> -->
                                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                                      <label for="password">Password</label>
                                      @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                  </div>
                                  <div class="form-label-group">
                                      <!-- <input type="password" id="inputConfPassword" class="form-control" placeholder="Confirm Password" required> -->
                                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                      <label for="password-confirm">Confirm Password</label>
                                  </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <fieldset class="checkbox">
                                              <div class="vs-checkbox-con vs-checkbox-primary">
                                                <input type="checkbox" checked>
                                                <span class="vs-checkbox">
                                                  <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                  </span>
                                                </span>
                                                <span class=""> I accept the terms & conditions.</span>
                                              </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <a href="login" class="btn btn-outline-primary float-left btn-inline mb-50">Login</a>
                                    <button type="submit" class="btn btn-primary float-right btn-inline mb-50">Register</a>
                                </form>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection
