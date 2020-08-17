<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="index.html"><img src="{{asset("client/img/logo.png")}}" alt=""></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">
							<li class="nav-item active"><a class="nav-link" href="{{url("/")}}">Home</a></li>
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Categories</a>
								<ul class="dropdown-menu">
								@foreach(\App\Category::all() as $c)
									@if($c->isActive==1)
									<li class="nav-item"><a class="nav-link" href="{{url("/danh-muc/{$c->id}")}}">{{$c->categoriesName}}</a></li>
									@endif
								@endforeach
								</ul>
							</li>
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Pages</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
									<li class="nav-item"><a class="nav-link" href="tracking.html">Tracking</a></li>
									<li class="nav-item"><a class="nav-link" href="elements.html">Elements</a></li>
								</ul>
							</li>
							<li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                            @if(!Auth::check())
                            <li class="nav-item active">
								<a href="#" class="nav-link login btn btn-default" data-toggle="modal" data-target="#myModal">
									Login
								</a>
                                /<a class="nav-link" href="{{url("/register")}}">Register</a>
                            </li>
                            @else
                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                    aria-expanded="false">Hello! {{Auth::user()->name}}</a>
                                    <ul class="dropdown-menu">
										@if(Auth::user()->roles==1)
										<li class="nav-item"><a class="nav-link" href="{{url("/admin/index")}}">Admin Manager</a></li>
										<li class="nav-item"><a class="nav-link" href="{{url("/user-profile",['id'=>Auth::user()->id])}}">User Profile</a></li>
										@else
										<li class="nav-item"><a class="nav-link" href="{{url("/user-profile",['id'=>Auth::user()->id])}}">User Profile</a></li>
										@endif
                                        <li class="nav-item"><a class="nav-link" href="{{url("/logout")}}">Logout</a></li>
                                    </ul>
                                </li>
                            @endif
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="nav-item"><a href="" class="cart"><span class="ti-bag"></span></a></li>
							<li class="nav-item">
								<button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<div class="search_input" id="search_input_box">
			<div class="container">
				<form class="d-flex justify-content-between" method="get" action="{{asset('search')}}">
					<input type="text" name="key" class="form-control" id="search_input" placeholder="Search Here">
					<button type="submit" class="btn"></button>
					<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
				</form>
			</div>
		</div>
	</header>