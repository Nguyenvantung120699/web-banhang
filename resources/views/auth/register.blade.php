@extends('auth.layoutAuth')

@section('main_content')
<div class="container">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="col-md-12 text-center"><h4 class="card-title">{{ __('Register') }}</h4></div>
            <form class="forms-sample" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                <label for="exampleInputUsername1">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="User Name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmation password">
                </div>
                <button type="submit" class="btn btn-gradient-primary mr-2"> {{ __('Register') }}</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
