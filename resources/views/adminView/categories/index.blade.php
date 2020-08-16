@extends("adminView.layoutAdmin")

@section("main_content")
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Categories Table</h4>
                <a href="{{url("admin/category/create")}}"><button class="btn btn-success"> Create Categories</button></a>
                </p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Categories Name</th>
                            <th>Logo</th>
                            <th>Description</th>
                            <th>Is Active</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $c)
                        <tr>
                            <td>{{$c->id}}</td>
                            <td>{{$c->categoriesName}}</td>
                            <td>
                                <img src="{{asset($c->logo)}}" style="width:100px;"/>
                            </td>
                            <td>{{$c->description}}</td>
                            @if($c->isActive == 1)
                                <td><label class="badge badge-success">Active true</label></td>
                            @else
                                <td><label class="badge badge-danger">Active false</label></td>
                            @endif
                            <td>
                                <a href="{{url("admin/category/edit",['id'=>$c->id])}}"><label class="badge badge-info">Edit</label></a>
                                <a href="{{url("admin/category/delete",['id'=>$c->id])}}"><label class="badge badge-warning">Delete</label></a>
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