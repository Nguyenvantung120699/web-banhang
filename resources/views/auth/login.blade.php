@extends('auth.layoutAuth')

@section("main_content")

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <div class="col-md-12 text-center">
                    <h2 class="card-title">{{ __('Login') }}</h2>
                </div>
                <form class="forms-sample" method="POST" action="{{ route('login') }}">
                @csrf
                    <div class="form-group">
                    <label for="exampleInputUsername1">{{ __('E-Mail Address') }}</label>
                    <input type="text" id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="exampleInputUsername1" placeholder="Email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="exampleInputPassword1" placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-check form-check-flat form-check-primary">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>{{ __('Remember Me') }}<i class="input-helper"></i></label>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-gradient-primary mr-2">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
