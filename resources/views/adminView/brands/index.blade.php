@extends("adminView.layoutAdmin")

@section("main_content")
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Basic Table</h4>
                <a href="{{url("admin/brand/create")}}"><button class="btn btn-success"> Create Brand </button></a>
                </p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Brand Name</th>
                            <th>Logo</th>
                            <th>History</th>
                            <th>Is Active</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($brands as $b)
                        <tr>
                            <td>{{$b->id}}</td>
                            <td>{{$b->brandsName}}</td>
                            <td>
                                <img src="{{asset($b->logo)}}" style="width:100px;">
                            </td>
                            <td>{{$b->history}}</td>
                            @if($b->isActive == 1)
                                <td><label class="badge badge-success">Active true</label></td>
                            @else
                                <td><label class="badge badge-danger">Active false</label></td>
                            @endif
                            <td>
                                <a href="{{url("admin/brand/edit",['id'=>$b->id])}}"><label class="badge badge-info">Edit</label></a>
                                <a href="{{url("admin/brand/delete",['id'=>$b->id])}}"><label class="badge badge-warning">Delete</label></a>
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