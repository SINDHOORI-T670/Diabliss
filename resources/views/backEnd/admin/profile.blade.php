@extends('backEnd.master')
@section('content')
<style>
    .no-arrow {
  -moz-appearance: textfield;
}
.no-arrow::-webkit-inner-spin-button {
  display: none;
}
.no-arrow::-webkit-outer-spin-button,
.no-arrow::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>
@include('backEnd.partials.alertMessage') 
<br>
<div class="tabs-animation">
    <div class="main-card mb-3 card">
        
        <div class="card-body">
            <h5 class="card-title">My Details</h5>
            <form method="post" action="{{ url('admin/update/profile') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="exampleEmail" class="col-sm-2 col-form-label required">Name</label>
                            <input name="name" id="exampleName" placeholder="Enter Name" type="text" class="form-control  @if ($errors->has('name')) is-invalid @endif" value="{{$data->name}}">
                            @if ($errors->has('name'))
                                <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('name') }}</em>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="exampleEmail" class="col-sm-2 col-form-label required">Email</label>
                            <input name="email" id="exampleEmail" placeholder="Enter Email" type="email" class="form-control @if ($errors->has('email')) is-invalid @endif" value="{{$data->email}}">
                            @if ($errors->has('email'))
                              <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('email') }}</em>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="position-relative form-group">
                            <label for="exampleEmail" class="col-sm-2 col-form-label">Language</label>
                            <select name="language" id="exampleSelect" class="form-control">
                                <option value="0" disabled>Select</option>
                                <option value="eng" @if(isset($data->profile) && $data->profile->lang == 'eng') selected @else @endif>English</option>
                                <option value="arab" @if(isset($data->profile) && $data->profile->lang == 'arab') selected @else @endif>Arabic</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="examplePhone" class="col-sm-2 col-form-label">Phone</label>
                            <input name="phone" id="examplePhone" placeholder="Enter Phone" type="number" class="form-control no-arrow @if ($errors->has('phone')) is-invalid @endif" value="@if(isset($data->profile)){{$data->profile->phone}}@else @endif">
                            @if ($errors->has('phone'))
                                <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('phone') }}</em>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="position-relative form-group">
                            <label for="examplePhone" class="col-sm-2 col-form-label">Image</label>
                            <input name="image" id="exampleFile" type="file" class="form-control-file"><br>
                            <img src="@if(isset($data->profile) && $data->profile->image!=""){{url($data->profile->image)}} @else {{asset('admin/assets/images/noimage.jpg')}}@endif"  id="profile" class="user-profile-image rounded" alt="user profile image" height="100" width="132">
                        </div>
                    </div>
                </div>
                <button class="mt-2 btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>

@endsection