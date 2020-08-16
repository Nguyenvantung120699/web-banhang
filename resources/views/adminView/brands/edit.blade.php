@extends("adminView.layoutAdmin")

@section("main_content")
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Create brand</h4>
            <form class="forms-sample" action="{{url("admin/brand/update",['id'=>$brands->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                <label for="exampleInputUsername1">Brand Name</label>
                <input type="text" name="brandsName" class="form-control @if($errors->has("brandsName")) is-invalid @endif" value="{{$brands->brandsName}}" id="exampleInputUsername1">
                    @if($errors->has("brandsName"))
                    <p style="color:red">{{$errors->first("brandsName")}}</p>
                    @endif
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Logo</label>
                    <input type="file" name="logo" value="{{$brands->logo}}" class="form-control" id="exampleInputEmail1">
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">History</label>
                <input type="text" name="history" value="{{$brands->history}}" class="form-control @if($errors->has("history")) is-invalid @endif" id="exampleInputPassword1">
                    @if($errors->has("history"))
                    <p style="color:red">{{$errors->first("history")}}</p>
                    @endif
                </div>
                <div class="form-group row">
                    <label class="col-sm-6 col-form-label">Is Active</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="isActive" id="exampleFormControlSelect1">
                               @if($brands->isActive == 1)
                               <option selected value="1">Active true</option>
                                <option value="0">Active false</option>
                                @else
                                <option selected value="0">Active false</option>
                                <option value="1">Active true</option>
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