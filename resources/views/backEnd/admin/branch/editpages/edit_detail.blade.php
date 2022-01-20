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
                <div>Edit Branch - Details
                    {{-- <div class="page-title-subheading">Tabs are used to split content between multiple sections. Wide variety available.</div> --}}
                </div>
            </div>
            <div class="page-title-actions">
                <button type="button" data-toggle="tooltip" onclick="location.href='{{ route('Branches')}}'" title="" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark" data-original-title="Branch List">
                    <i class="pe-7s-angle-left-circle"></i>
                </button>
            </div>
        </div>
    </div>            
    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
        <li class="nav-item">
            <a role="tab" class="nav-link active" id="tab-0"  href="{{route('Edit-Branch-Details',['id'=>$branch->id])}}">
                <span>Details</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-1"  href="{{route('Edit-Branch-Ordersettings',['id'=>$branch->id])}}">
                <span>Settings</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-2"  href="{{route('Edit-Branch-Working-Hours',['id'=>$branch->id])}}">
                <span>Working Hours</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-3"  href="{{route('Edit-Branch-Location',['id'=>$branch->id])}}">
                <span>Location</span>
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i> Please add branch details .
                            
                        </div>
                        <form method="post" action="{{ url('admin/update/branch/details') }}">
                            @csrf
                            <input type="hidden" name="bid" value="{{$branch->id}}">
                            <div class="card-body">
                                    {{-- <div class="form-row"> --}}
                                        <div class="col-md-12">
                                            <div class="position-relative form-group">
                                                {{-- <label for="exampleEmail" class="col-sm-2 col-form-label required">Status</label> --}}
                                                <label class="switch">
                                                    <input type="checkbox" id="togBtn" class="form-control" name="status"  @if($branch->status=="on") value="on" checked @else value="off" @endif>
                                                    <div class="slider round">
                                                        <!--ADDED HTML -->
                                                        <span class="on">ON</span>
                                                        <span class="off">OFF</span>
                                                        <!--END-->
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="position-relative form-group">
                                                <label for="exampleEmail" class="col-sm-2 col-form-label required">Title [English]</label>
                                                <input name="title" id="title" placeholder="Enter Title" type="text" class="form-control  @if ($errors->has('title')) is-invalid @endif" value="{{$branch->title}}">
                                                @if ($errors->has('title'))
                                                    <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('title') }}</em>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="position-relative form-group">
                                                <label for="exampleEmail" class="col-sm-2 col-form-label required">Title [Arabic]</label>
                                                <input name="titlear" id="titlear" placeholder="Enter Title (Arabic)" type="text" class="form-control  @if ($errors->has('titlear')) is-invalid @endif" value="{{$branch->title_ar}}">
                                                @if ($errors->has('titlear'))
                                                    <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('titlear') }}</em>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="position-relative form-group">
                                                <label for="exampleText" class="col-form-label required">Address</label>
                                                <textarea name="address" id="address" class="form-control @if ($errors->has('address')) is-invalid @endif" >{{$branch->address}}</textarea>
                                                @if ($errors->has('address'))
                                                    <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('address') }}</em>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="position-relative form-group">
                                                <label for="exampleText" class="col-form-label required">Address [Arabic]</label>
                                                <textarea name="addressar" id="addressar" class="form-control @if ($errors->has('addressar')) is-invalid @endif" >{{$branch->address_ar}}</textarea>
                                                @if ($errors->has('addressar'))
                                                    <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('addressar') }}</em>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label for="examplePhone" class="col-form-label">Customer Service Phone</label>
                                                    <input name="phone" id="examplePhone" placeholder="Enter Phone" type="number" class="form-control no-arrow @if ($errors->has('phone')) is-invalid @endif" value="{{$branch->phone}}">
                                                    @if ($errors->has('phone'))
                                                        <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('phone') }}</em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label for="exampleEmail" class="col-sm-2 col-form-label required">Email</label>
                                                    <input name="email" id="exampleEmail" placeholder="Enter Email" type="email" class="form-control @if ($errors->has('email')) is-invalid @endif" value="{{$branch->email}}">
                                                    @if ($errors->has('email'))
                                                    <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('email') }}</em>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                            </div>
                            <div class="d-block text-right card-footer">
                                <button type="submit" class="btn-wide btn btn-success">Update</button>
                                <a  href="{{route('Edit-Branch-Ordersettings',['id'=>$branch->id])}}" class="btn-wide btn btn-info text-white">Next</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript">
    $("#togBtn").on('change', function() {
        if ($(this).is(':checked')) {
            $(this).attr('value', 'on');
            // alert($(this).val());
        }
        else {
           $(this).attr('value', 'off');
        //    alert($(this).val());
        }
    });
</script> 
@endsection