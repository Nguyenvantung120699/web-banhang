@extends('clientView.layoutClient')

@section('content')

<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Login/Register</h1>
					<nav class="d-flex align-items-center">
						<a href="{{url("/")}}">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Login/Register</a>
					</nav>
				</div>
			</div>
		</div>
	</section>


  <section class="login_box_area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<img class="img-fluid" src="{{asset("client/img/login.jpg")}}" alt="">
						<div class="hover">
							<h4>New to our website?</h4>
							<p>You already have an account in our system</p>
							<a class="primary-btn" href="{{ route('login') }}">Sign In Account</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Register</h3>
						<form class="row login_form" action="{{ route('register') }}" method="post" id="contactForm">
            @csrf
              <div class="col-md-12 form-group">
								<input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name" name="name" placeholder="UserName" onfocus="this.placeholder = ''" onblur="this.placeholder = 'UserName'">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
							<div class="col-md-12 form-group">
								<input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="col-md-12 form-group">
                <input type="password" class="form-control" name="password_confirmation" required id="password-confirm" placeholder="{{ __('Confirm Password') }}">
              </div>
							<div class="col-md-12 form-group">
								<button type="submit" class="primary-btn">Create Account</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection
