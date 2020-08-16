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
						<a href="#">Search</a>
					</nav>
				</div>
			</div>
		</div>
	</section>

    <div class="container list-product-category">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12">
				<!-- Start Filter Bar -->
				    <div class="pagination">
                        <h3>results search for : " {{$keys}} " > <button class="btn btn-info"><span class="badge badge-light">{{$product->count()}}</span> Produts</button></h3>
                    </div>
                    <div>
                    {{ $product->links() }}
                    </div>
				<!-- Start Best Seller -->
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
						<!-- single product -->
                        @forelse($product as $p)
						<div class="col-lg-3 col-md-6">
							<div class="single-product">
                                <a href="{{url("detail-product/{$p->id}")}}">
                                <img class="img-fluid" src="{{asset($p->thumbnail)}}" alt="">
                                </a>
								<div class="product-details">
									<a href="{{url("detail-product/{$p->id}")}}"><h6>{{$p->productName}}</h6></a>
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
                        @empty
                        <div class="messager-search col-lg-12 col-md-12">
                            <h1><i class="fa fa-frown-o" aria-hidden="true"></i></h1>
                            <h3>No Data Search !!!</h3>
                        </div>
                        @endforelse
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