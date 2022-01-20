@extends('backEnd.master')
@section('content')
@include('backEnd.partials.alertMessage') 
<br>
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-usb icon-gradient bg-happy-itmeo"></i>
                </div>
                <div>Create Branch - Location
                    {{-- <div class="page-title-subheading">Tabs are used to split content between multiple sections. Wide variety available.</div> --}}
                </div>
            </div>
        </div>
    </div>            
    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
        <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-0" data-toggle="tab" href="#tab-content-0">
                <span>Details</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                <span>Settings</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-2">
                <span>Working Hours</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link  active" id="tab-3" data-toggle="tab" href="#tab-content-3">
                <span>Location</span>
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i> Please add branch location .
                            
                        </div>
                        <form method="post" action="{{ url('admin/save/branch_location') }}">
                            @csrf
                            <input type="hidden" name="bid" value="{{$branch->id}}">
                            <div class="card-body">
                                    <div class="form-row">
                                      
                                        <div class="col-md-12">
                                            <div class="position-relative form-group">
                                                <label for="exampleEmail" class="col-sm-2 col-form-label required">Latitude</label>
                                                <input name="latitude" id="latitude" placeholder="Enter Latitude" type="text" class="form-control  @if ($errors->has('latitude')) is-invalid @endif" >
                                                @if ($errors->has('latitude'))
                                                    <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('latitude') }}</em>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="position-relative form-group">
                                                <label for="exampleEmail" class="col-sm-2 col-form-label required">Longitude</label>
                                                <input name="longitude" id="longitude" placeholder="Enter Longitude" type="text" class="form-control  @if ($errors->has('longitude')) is-invalid @endif" >
                                                @if ($errors->has('longitude'))
                                                    <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('longitude') }}</em>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="d-block text-right card-footer">
                                {{-- <a class="btn-wide btn btn-info text-white">Previous</a> --}}
                                <button type="submit" class="btn-wide btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection