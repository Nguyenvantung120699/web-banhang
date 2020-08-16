@extends("adminView.layoutAdmin")

@section("main_content")
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Create brand</h4>
            <form class="forms-sample" action="{{url("admin/category/update",['id'=>$categories->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                <label for="exampleInputUsername1">Categories Name</label>
                <input type="text" name="categoriesName" class="form-control" value="{{$categories->categoriesName}}" id="exampleInputUsername1">
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Logo</label>
                    <input type="file" name="logo" class="form-control" value="{{$categories->logo}}" id="exampleInputEmail1">
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">History</label>
                <input type="text" name="description" value="{{$categories->description}}" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="form-group row">
                    <label class="col-sm-6 col-form-label">Is Active</label>
                    <div class="col-sm-12">
                        <select class="form-control" name="isActive" id="exampleFormControlSelect1">
                               @if($categories->isActive == 1)
                               <option selected value="1">Active true</option>
                                <option value="0">Active false</option>
                                @else
                                <option selected value="0">Active false</option>
                                <option value="1">Active false</option>
                                @endif
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection