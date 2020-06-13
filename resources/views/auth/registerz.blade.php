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
                      <p class="px-2">Fill the below form to create a new account.</p>
                      <div class="card-content">
                          <div class="card-body pt-0">
                            <form method="POST" action="{{ route('register') }}">
                              @csrf
                                  <div class="form-label-group">
                                      <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                      <label for="name">Name</label>
                                      @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                  </div>
                                  <div class="form-label-group">
                                      <!-- <input type="email" id="inputEmail" class="form-control" placeholder="Email" required> -->
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





                      <div class="card-content">
                        <div class="card-body">
                          <p>Compila i campi richiesti. <code>....</code> </p>

                          <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link" id="home-tab-fill" data-toggle="tab" href="#home-fill" role="tab" aria-controls="home-fill" aria-selected="false">Home</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="profile-tab-fill" data-toggle="tab" href="#profile-fill" role="tab" aria-controls="profile-fill" aria-selected="false">Profile</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link active" id="messages-tab-fill" data-toggle="tab" href="#messages-fill" role="tab" aria-controls="messages-fill" aria-selected="true">Messages</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="settings-tab-fill" data-toggle="tab" href="#settings-fill" role="tab" aria-controls="settings-fill" aria-selected="false">Settings</a>
                            </li>
                          </ul>


                          <div class="tab-content pt-1">
                            <div class="tab-pane" id="home-fill" role="tabpanel" aria-labelledby="home-tab-fill">
                              <p>
                                Biscuit powder jelly beans. Lollipop candy canes croissant icing chocolate cake. Cake fruitcake powder
                                pudding pastry.</p>
                              <p>
                                Tootsie roll oat cake I love bear claw I love caramels caramels halvah chocolate bar. Cotton candy
                                gummi
                                bears pudding pie apple pie cookie. Cheesecake jujubes lemon drops danish dessert I love caramels
                                powder.
                              </p>
                            </div>
                            <div class="tab-pane" id="profile-fill" role="tabpanel" aria-labelledby="profile-tab-fill">
                              <p>
                                Tootsie roll oat cake I love bear claw I love caramels caramels halvah chocolate bar. Cotton candy
                                gummi
                                bears pudding pie apple pie cookie. Cheesecake jujubes lemon drops danish dessert I love caramels
                                powder.
                              </p>
                            </div>
                            <div class="tab-pane active" id="messages-fill" role="tabpanel" aria-labelledby="messages-tab-fill">
                              <p>
                                Biscuit powder jelly beans. Lollipop candy canes croissant icing chocolate cake. Cake fruitcake powder
                                pudding pastry.
                              </p>
                            </div>
                            <div class="tab-pane" id="settings-fill" role="tabpanel" aria-labelledby="settings-tab-fill">
                              <p>
                                Tootsie roll oat cake I love bear claw I love caramels caramels halvah chocolate bar. Cotton candy
                                gummi
                                bears pudding pie apple pie cookie. Cheesecake jujubes lemon drops danish dessert I love caramels
                                powder.
                              </p>
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
