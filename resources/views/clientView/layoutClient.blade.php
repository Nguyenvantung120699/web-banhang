<!DOCTYPE html>
<html lang="zxx" class="no-js">

@include('clientView.htmlLayout.head')

<body>

    @include('clientView.htmlLayout.header')

    @yield('content')

    @includeFirst(['clientView.htmlLayout.footer','footer'])

    <script src="{{asset("client/js/vendor/jquery-2.2.4.min.js")}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="{{asset("client/js/vendor/bootstrap.min.js")}}"></script>
	<script src="{{asset("client/js/jquery.ajaxchimp.min.js")}}"></script>
	<script src="{{asset("client/js/jquery.nice-select.min.js")}}"></script>
	<script src="{{asset("client/js/jquery.sticky.js")}}"></script>
	<script src="{{asset("client/js/nouislider.min.js")}}"></script>
	<script src="{{asset("client/js/countdown.js")}}"></script>
	<script src="{{asset("client/js/jquery.magnific-popup.min.js")}}"></script>
	<script src="{{asset("client/js/owl.carousel.min.js")}}"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="{{asset("client/js/gmaps.min.js")}}"></script>
	<script src="{{asset("client/js/main.js")}}"></script>
</body>

</html>