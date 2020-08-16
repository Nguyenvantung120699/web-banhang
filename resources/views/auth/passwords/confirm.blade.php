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
                <h4>{{ __('Confirm Password') }}</h4>
                {{ __('Please confirm your password before continuing.') }}
                <form class="pt-3"method="POST" action="{{ route('password.confirm') }}">
                @csrf
                  <div class="form-group">
                    <input type="password" name="password"  class="form-control form-control-lg @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="{{ __('Password') }}">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" >{{ __('Confirm Password') }}</button>
                  </div>
                  @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
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
