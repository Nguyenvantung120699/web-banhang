@extends('auth.layoutAuth')

@section("main_content")
<div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="{{asset("admin/assets/images/logo.svg")}}">
                </div>
                <h4>{{ __('Reset Password') }}</h4>
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <form class="pt-3" method="POST" action="{{ route('password.email') }}">
                    @csrf
                  <div class="form-group">
                    <input type="email" name="email"  class="form-control form-control-lg  @error('email') is-invalid @enderror" value="{{ old('email') }}" id="exampleInputEmail1" placeholder="{{ __('E-Mail Address') }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" > {{ __('Send Password Reset Link') }}</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
@endsection
