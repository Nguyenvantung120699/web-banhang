@extends('clientView.layoutClient')

@section('content')
<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Shop Category page</h1>
					<nav class="d-flex align-items-center">
						<a href="{{url("/")}}">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">{{$category->categoriesName}}</a>
					</nav>
				</div>
			</div>
		</div>
	</section>

    <div class="container list-product-category">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
					<div class="head">Browse Categories</div>
					<ul class="main-categories">
                        @foreach($categories as $c)
							@if($c->isActive==1)
							<li class="main-nav-list">
								<a href="{{url("danh-muc/{$c->id}")}}">
									<span class="lnr lnr-arrow-right"></span>{{$c->categoriesName}}
								</a>
							</li>
							@endif
                        @endforeach
					</ul>
				</div>
				<div class="sidebar-filter mt-50">
                    <div class="sidebar-categories">
                        <div class="head">Product Brand</div>
                            <ul class="main-categories">
                                @foreach($brands as $c)
									@if($c->isActive==1)
									<li class="main-nav-list">
										<a href="{{url("danh-muc/{$c->id}")}}">
											<span class="lnr lnr-arrow-right"></span>{{$c->brandsName}}
										</a>
									</li>
									@endif
                                @endforeach
                            </ul>
                        </div>
					<div class="common-filter">
						<div class="head">Price</div>
						<div class="price-range-area">
							<div id="price-range" class="noUi-target noUi-ltr noUi-horizontal"><div class="noUi-base"><div class="noUi-origin" style="left: 10%;"><div class="noUi-handle noUi-handle-lower" data-handle="0" tabindex="0" role="slider" aria-orientation="horizontal" aria-valuemin="0.0" aria-valuemax="50.0" aria-valuenow="10.0" aria-valuetext="500.00" style="z-index: 5;"></div></div><div class="noUi-connect" style="left: 10%; right: 50%;"></div><div class="noUi-origin" style="left: 50%;"><div class="noUi-handle noUi-handle-upper" data-handle="1" tabindex="0" role="slider" aria-orientation="horizontal" aria-valuemin="10.0" aria-valuemax="100.0" aria-valuenow="50.0" aria-valuetext="4000.00" style="z-index: 6;"></div></div></div></div>
							<div class="value-wrapper d-flex">
								<div class="price">Price:</div>
								<span>$</span>
								<div id="lower-value">500.00</div>
								<div class="to">to</div>
								<span>$</span>
								<div id="upper-value">4000.00</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting">
						<select style="display: none;">
							<option value="1">Default sorting</option>
							<option value="1">Default sorting</option>
							<option value="1">Default sorting</option>
						</select><div class="nice-select" tabindex="0"><span class="current">Default sorting</span><ul class="list"><li data-value="1" class="option selected">Default sorting</li><li data-value="1" class="option">Default sorting</li><li data-value="1" class="option">Default sorting</li></ul></div>
					</div>
					<div class="sorting mr-auto">
						<select style="display: none;">
							<option value="1">Show 12</option>
							<option value="1">Show 12</option>
							<option value="1">Show 12</option>
						</select><div class="nice-select" tabindex="0"><span class="current">Show 12</span><ul class="list"><li data-value="1" class="option selected">Show 12</li><li data-value="1" class="option">Show 12</li><li data-value="1" class="option">Show 12</li></ul></div>
					</div>
					<div class="pagination">
                         {{ $product->links() }}
					</div>
				</div>
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
						<!-- single product -->
						@foreach($product as $p)
							@if($p->brand->isActive==1)
								@if($p->isActive==1)
								<a href="{{url("detail-product/{$p->id}")}}">
								<div class="col-lg-4 col-md-6">
									<div class="single-product">
										<img class="img-fluid" src="{{asset($p->thumbnail)}}" alt="">
										<div class="product-details">
											<h6>{{$p->productName}}</h6>
											<div class="price">
												<h6>{{$p->getPrice()}}</h6>
												<h6 class="l-through">$210.00</h6>
											</div>
											<div class="prd-bottom">
												<a class="primary-btn" href="{{url("detail-product/{$p->id}")}}">view products</a>
											</div>
										</div>
									</div>
								</div>
								</a>
								@endif
							@endif
						@endforeach
					</div>
				</section>
				<!-- End Best Seller -->
				<!-- Start Filter Bar -->
				<div class="pagination">
					{{ $product->links() }}
				</div>
				<!-- End Filter Bar -->
			</div>
		</div>
	</div>
@endsection