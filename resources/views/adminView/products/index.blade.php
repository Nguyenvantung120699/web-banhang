@extends("adminView.layoutAdmin")

@section("main_content")
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Products Table</h4>
                <a href="{{url("admin/product/create")}}"><button class="btn btn-success"> Create Product </button></a>
                </p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Products Name</th>
                            <th>Products Description</th>
                            <th>Thumbnail</th>
                            <th>Brands</th>
                            <th>Categories</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Is Active</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $c)
                        <tr>
                            <td>{{$c->id}}</td>
                            <td>{{$c->productName}}</td>
                            <td>{{$c->productsDescription}}</td>
                            <td>
                                <img src="{{asset($c->thumbnail)}}" style="width:100px;"/>
                            </td>
                            <td>{{$c->brand->brandsName}}</td>
                            <td>{{$c->category->categoriesName}}</td>
                            <td>{{$c->price}}</td>
                            <td>{{$c->quantity}}</td>
                            @if($c->isActive == 1)
                                <td><label class="badge badge-success">Active true</label></td>
                            @else
                                <td><label class="badge badge-danger">Active false</label></td>
                            @endif
                            <td>
                                <a href="{{url("admin/product/edit",['id'=>$c->id])}}"><label class="badge badge-info">Edit</label></a>
                                <a href="{{url("admin/product/delete",['id'=>$c->id])}}"><label class="badge badge-warning">Delete</label></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection