@extends('clientView.layoutClient')

@section('content')
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>User Profile Page</h1>
                <nav class="d-flex align-items-center">
                    <a href="{{url("/")}}">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#">User Profile<span class="lnr lnr-arrow-right"></span></a>
                    <a href="single-product.html">Profile View</a>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="sample-text-area">
    <div class="container">
            <div class="section-top-border">
				<div class="row">
            @if($profile == null)
                No Profile
            @else
            @foreach($profile as $p)
                @if (session('alert'))
                    <div class="alert alert-success col-md-12">
                        {{ session('alert') }}
                    </div>
                @endif
            <form action="{{url("user-profile/update",['id'=>$p->id])}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="col-md-12 row">
					<div class="generic-blockquote col-lg-8 col-md-8">
                        <h3 class="mb-30">User Profile</h3>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="example-text-input" class="col-form-label">First Name :</label>
                                    <div class="col-12">
                                        <input class="form-control" type="text" value="{{$p->firstName}}" name="firstName" id="example-text-input">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="example-text-input" class="col-form-label">Last Name :</label>
                                    <div class="col-12">
                                        <input class="form-control" type="text" value="{{$p->lastName}}" name="lastName" id="example-text-input">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="example-email-input" class=" col-form-label">Email :</label>
                                    <div class="col-12">
                                        <label class=" col-form-label">{{$p->usern->email}}</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="example-tel-input" class="col-form-label">Telephone :</label>
                                    <div class="col-12">
                                        <input class="form-control" value="{{$p->telephone}}" type="text" name="telephone" id="example-tel-input">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="example-date-input" class=" col-form-label">Birthday :</label>
                                    <div class="col-12">
                                        <input class="form-control" value="{{$p->birthday}}" type="date" name="birthday" id="example-date-input">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="example-email-input" class=" col-form-label">Gender :</label>
                                    @if($p->gender==1)
                                    <div class="col-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="1" checked>
                                            <label class="form-check-label" for="inlineRadio1">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="2">
                                            <label class="form-check-label" for="inlineRadio2">Female</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="3">
                                            <label class="form-check-label" for="inlineRadio2">Other</label>
                                        </div>
                                    </div>
                                    @elseif($p->gender==2)
                                    <div class="col-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="1">
                                            <label class="form-check-label" for="inlineRadio1">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="2" checked>
                                            <label class="form-check-label" for="inlineRadio2">Female</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="3">
                                            <label class="form-check-label" for="inlineRadio2">Other</label>
                                        </div>
                                    </div>
                                    @elseif($p->gender==3)
                                    <div class="col-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="1">
                                            <label class="form-check-label" for="inlineRadio1">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="2">
                                            <label class="form-check-label" for="inlineRadio2">Female</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="3" checked>
                                            <label class="form-check-label" for="inlineRadio2">Other</label>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="example-url-input" class="col-form-label">Address :</label>
                                    <div class="col-12">
                                        <textarea class="form-control rounded-0" name="address" id="exampleFormControlTextarea2" rows="3">{{$p->address}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="generic-blockquote col-lg-4 col-md-4 mt-sm-30">
                            <div class="row justify-content-md-center">
                                @if($p->avatar !=null)
                                    <div class="avatar-profile col-md-auto">
                                        <img class="avatar-profile-image" src="{{asset($p->avatar)}}"/>
                                    </div>
                                @else
                                    <div class="avatar-profile col-md-auto">
                                        <img class="avatar-profile-image" src="https://ps.w.org/wp-user-avatar/assets/icon-256x256.png?rev=1755722"/>
                                    </div>
                                @endif
                                <div class="custom-file upload-avatar col-md-6">
                                    <input type="file" name="avatar" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Upload</label>
                                </div>
                            </div>
                        </div>
                        </div>
                            <div>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-auto">
                                        <button type="submit" class="genric-btn primary e-large">Save Profile</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
@endsection