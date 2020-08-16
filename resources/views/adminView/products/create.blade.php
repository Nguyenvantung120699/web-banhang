@extends("adminView.layoutAdmin")

@section("main_content")
<div class="col-12">
    <div class="card">
        <div class="card-body">
        <h4 class="card-title">Create Product</h4>
        <form class="form-sample" action="{{url("admin/product/store")}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Product Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="productName" value="{{old("productName")}}" class="form-control @if($errors->has("productName")) is-invalid @endif" id="exampleInputUsername1" placeholder="Product Name">
                            @if($errors->has("productName"))
                                <p style="color:red">{{$errors->first("productName")}}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                        <input type="text" name="productsDescription" value="{{old("productsDescription")}}" class="form-control @if($errors->has("productName")) is-invalid @endif" id="exampleInputUsername1" placeholder="Product Description">
                            @if($errors->has("productsDescription"))
                                <p style="color:red">{{$errors->first("productsDescription")}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Thumbnail</label>
                        <div class="col-sm-5">
                            <input type="file" id="uploadImage" name="thumbnail" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div id="result" class="uploadPreview col-sm-4">

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Gallery</label>
                        <div class="col-sm-5">
                            <input type="file" id="uploadImage2" name="gallery" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div id="result2" class="uploadPreview col-sm-4">

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Brands</label>
                        <div class="col-sm-9">
                            <select class="form-control @if($errors->has("brandsName")) is-invalid @endif" value="{{old("brandsName")}}" name="brandsId" id="exampleFormControlSelect1">
                                @php
                                    $brands = \App\Brand::all();
                                @endphp
                                    <option selected value=""></option>
                                @foreach($brands as $c)
                                    <option value="{{$c->id}}">{{$c->brandsName}}</option>
                                @endforeach
                            </select>
                            @if($errors->has("brandsName"))
                                <p style="color:red">{{$errors->first("brandsName")}}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Categories</label>
                        <div class="col-sm-9">
                            <select class="form-control @if($errors->has("categoriesName")) is-invalid @endif" value="{{old("categoriesName")}}" name="categoriesId" id="exampleFormControlSelect1">
                                @php
                                    $categories = \App\Category::all();
                                @endphp
                                    <option selected value=""></option>
                                @foreach($categories as $c)
                                    <option value="{{$c->id}}">{{$c->categoriesName}}</option>
                                @endforeach
                            </select>
                            @if($errors->has("categoriesName"))
                                <p style="color:red">{{$errors->first("categoriesName")}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Price</label>
                        <div class="col-sm-9">
                            <input type="number" name="price" value="{{old("price")}}" class="form-control @if($errors->has("price")) is-invalid @endif" id="exampleInputPassword1" placeholder="Price">
                            @if($errors->has("price"))
                                <p style="color:red">{{$errors->first("price")}}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Quantity</label>
                        <div class="col-sm-9">
                            <input type="number" name="quantity" value="{{old("quantity")}}" class="form-control @if($errors->has("quantity")) is-invalid @endif" id="exampleInputPassword1" placeholder="Quantity">
                            @if($errors->has("quantity"))
                                <p style="color:red">{{$errors->first("quantity")}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Is Active</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="isActive" id="exampleFormControlSelect1">
                                <option selected value="1">Active true</option>
                                    <option value="0">Active false</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-gradient-primary mr-2" value="Upload">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection