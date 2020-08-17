@extends('clientView.layoutClient')

@section('content')
<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Product Details Page</h1>
					<nav class="d-flex align-items-center">
						<a href="{{url("/")}}">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
						<a href="single-product.html">Product Details</a>
					</nav>
				</div>
			</div>
		</div>
    </section>
    
    <div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
                        <img src="{{asset($product->thumbnail)}}" style="width: 100%;" alt=""/>
					<!-- <div class="s_Product_carousel owl-carousel owl-theme owl-loaded">	
                            @php
                                $gallery = $product->gallery;
                                $gallery = explode(",",$gallery);// string -> array
                            @endphp
					    <div class="owl-stage-outer">
                            <div class="owl-stage" style="transform: translate3d(-1080px, 0px, 0px); transition: all 0s ease 0s; width: 3780px;">
                            @foreach($gallery as $g)    
                                <div class="owl-item cloned" style="width: 540px; margin-right: 0px;">
                                    <div class="single-prd-item">
                                        <img class="img-fluid" src="{{asset($g)}}" alt="">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="owl-controls">
                            <div class="owl-nav">
                                <div class="owl-prev" style="display: none;">prev</div>
                                <div class="owl-next" style="display: none;">next</div>
                            </div>
                            <div class="owl-dots" style="">
                                <div class="owl-dot active"><span></span></div>
                                <div class="owl-dot"><span></span></div>
                                <div class="owl-dot"><span></span></div>
                            </div>
                        </div>
                    </div> -->
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3>{{$product->productName}}</h3>
                        <h2>{{$product->getPrice()}} VND</h2>
						<ul class="list">
							<li><a href="#"><span>Category</span> : {{$product->category->categoriesName}}</a></li>
                            <li><a href="#"><span>Brand</span> : {{$product->brand->brandsName}}</a></li>
                            <li><a href="#"><span>Qty</span> : {{$product->quantity}}</a></li>
						</ul>
                        <p>{{$product->productsDescription}}</p>
                    <form action="{{url("shopping/{$product->id}")}}" method="post">
                        @csrf
						<div class="product_count">
                            <label for="qty">Quantity:</label>
                            
							<input type="number" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
							<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
							<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 1 ) result.value--;return false;" class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
						</div>
						<div class="card_area d-flex align-items-center">
							@if(!Auth::check())
								<a href="#" class="nav-link login btn btn-default" data-toggle="modal" data-target="#myModal">
									<button type="submit" class="primary-btn">Add to Cart</button>
								</a>
							@else
								<button type="submit" class="primary-btn">Add to Cart</button>
							@endif
							<a class="icon_btn" href="#"><i class="lnr lnr lnr-diamond"></i></a>
							<a class="icon_btn" href="#"><i class="lnr lnr lnr-heart"></i></a>
                        </div>
                    </form>
					</div>
				</div>
			</div>
		</div>
    </div>
    
    <section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Products Description</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Client Reviews Products</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
					<p>{{$product->productsDescription}}</p>
				</div>
				<div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
					<div class="row">
						<div class="col-lg-12">
							<div class="row total_rate">
								<div class="col-6">
									<div class="box_total">
										<h5>Overall</h5>
										<h4>{{number_format($rate->avg('point'),2)}}</h4>
										@if(!count($rate)==0)
										<h6>({{count($rate)}}  Reviews)</h6>
										@else
                                            <h6>(0 Reviews)</h6>
                                        @endif
									</div>
								</div>
								<div class="col-6">
									<div class="rating_list">
										<h3>Based on {{count($rate)}} Reviews</h3>
										<ul class="list">
											<li><a href="#">5 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>  - {{count($rate->where("rate",5))}}</a></li>
											<li><a href="#">4 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>  - {{count($rate->where("rate",5))}}</a></li>
											<li><a href="#">3 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>  - {{count($rate->where("rate",5))}}</a></li>
											<li><a href="#">2 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>  - {{count($rate->where("rate",5))}}</a></li>
											<li><a href="#">1 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>  - {{count($rate->where("rate",5))}}</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="review_list">
							@forelse ($ratenew as $r)
								<div class="review_item">
									<div class="media">
										<!-- <div class="d-flex">
											<img src="img/product/review-1.png" alt="">
										</div> -->
										<div class="media-body">
											<h4>{{$r->name}}</h4>
											@if($r->point==5)
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
											@elseif($r->point==4)
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
											@elseif($r->point==3)
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
											@elseif($r->point==2)
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												@else
												<i class="fa fa-star"></i>
											@endif
										</div>
									</div>
									<div class="d-flex">
										<img style="width:100px;" src="{{$r->image}}" alt="">
									</div>
									<p>{{$r->feel}}</p>
								</div>
								@empty
								<p>No Review</p>
								@endforelse

								<div class="product_pagination">
									{!! $ratenew->links() !!}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection