@extends('backEnd.master')
@section('content')

@include('backEnd.partials.alertMessage') 
<br>
<div class="tabs-animation">
    <div class="main-card mb-3 card">
        
        <div class="card-body">
            <h5 class="card-title">Change Password</h5>
            <form method="post" action="{{ url('admin/update/password') }}">
                @csrf
                {{-- <div class="form-row"> --}}
                    <div class="col-md-12">
                        <div class="position-relative form-group">
                            <label for="exampleEmail" class="col-sm-2 col-form-label required">New Password</label>
                            <input name="password" id="exampleName" placeholder="Enter Password" type="password" class="form-control  @if ($errors->has('password')) is-invalid @endif" >
                            @if ($errors->has('password'))
                                <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('password') }}</em>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="position-relative form-group">
                            <label for="exampleEmail" class="col-sm-2 col-form-label required">Confirm Password</label>
                            <input name="confpassword" id="exampleconfpassword" placeholder="Enter Confirm Password" type="password" class="form-control  @if ($errors->has('confpassword')) is-invalid @endif" >
                            @if ($errors->has('confpassword'))
                                <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('confpassword') }}</em>
                            @endif
                        </div>
                    </div>
                    
                {{-- </div> --}}
                <button class="mt-2 btn btn-primary pull-right">Save</button>
            </form>
        </div>
    </div>
</div>

@endsection