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
                <div>Create Branch - Order Settings
                    {{-- <div class="page-title-subheading">Tabs are used to split content between multiple sections. Wide variety available.</div> --}}
                </div>
            </div>
        </div>
    </div>            
    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
        <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-0" data-toggle="tab" href="{{route('Edit-Branch-Details',['id'=>$branch->id])}}">
                <span>Details</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link  active" id="tab-1" data-toggle="tab" href="{{url('create/branch/order/settings')}}/{{$branch->id}}">
                <span>Settings</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-2">
                <span>Working Hours</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-3" data-toggle="tab" href="#tab-content-3">
                <span>Location</span>
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i> Please add branch order settings .
                            
                        </div>
                        <form method="post" action="{{ url('admin/save/branch_ordersettings') }}">
                            @csrf
                            <input type="hidden" name="bid" value="{{$branch->id}}">
                            <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-xl-4">
                                            <div class="position-relative form-group">
                                                <label for="exampleEmail" class="col-sm-8 col-form-label required">Busy Branch</label>
                                                <br><label class="switch">
                                                    <input type="checkbox" id="togBtn1" class="form-control" name="busy" value="0" checked>
                                                    <div class="slider round">
                                                        <!--ADDED HTML -->
                                                        <span class="on">ON</span>
                                                        <span class="off">OFF</span>
                                                        <!--END-->
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xl-4">
                                            <div class="position-relative form-group">
                                                <label for="exampleEmail" class="col-sm-8 col-form-label required">Enable Pickup Orders</label>
                                                <br><label class="switch">
                                                    <input type="checkbox" id="togBtn2" class="form-control" name="pickup" value="0" checked>
                                                    <div class="slider round">
                                                        <!--ADDED HTML -->
                                                        <span class="on">ON</span>
                                                        <span class="off">OFF</span>
                                                        <!--END-->
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xl-4">
                                            <div class="position-relative form-group">
                                                <label for="exampleEmail" class="col-sm-8 col-form-label required">Schedule Orders</label>
                                                <br><label class="switch">
                                                    <input type="checkbox" id="togBtn3" class="form-control" name="schedule" value="0" checked>
                                                    <div class="slider round">
                                                        <!--ADDED HTML -->
                                                        <span class="on">ON</span>
                                                        <span class="off">OFF</span>
                                                        <!--END-->
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xl-4">
                                            <div class="position-relative form-group">
                                                <label for="exampleEmail" class="col-sm-8 col-form-label required">Enable Order Delivery</label>
                                                <br><label class="switch">
                                                    <input type="checkbox" id="togBtn4" class="form-control" name="delivery" value="0" checked>
                                                    <div class="slider round">
                                                        <!--ADDED HTML -->
                                                        <span class="on">ON</span>
                                                        <span class="off">OFF</span>
                                                        <!--END-->
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="examplePhone" class="col-form-label required">Max Order Fulfillment Period</label>
                                                <div class="input-group">
                                                    <input  min="0" name="max_period" id="examplePhone"  type="number" class="form-control  @if ($errors->has('max_period')) is-invalid @endif" value="0">
                                                   &nbsp;&nbsp; <select name="type" id="exampleSelect" class="form-control @if ($errors->has('type')) is-invalid @endif"">
                                                        <option value="0">Select any</option>
                                                        <option value="Minutes">Minutes</option>
                                                        <option value="Hours">Hours</option>
                                                        <option value="Days">Days</option>
                                                    </select>
                                                    <p class="text-info">When an order checkout requires preparation plus delivery time that exceeds this period, ASAP delivery will be disabled. Customer can schedule the order (if it's enabled)</p>
                                                </div>
                                                @if ($errors->has('max_period'))
                                                    <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('max_period') }}</em>
                                                @endif
                                                @if ($errors->has('type'))
                                                    <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('type') }}</em>
                                                @endif
                                            </div>
                                        </div>
                                        
                                    </div>
                            </div>
                            <div class="d-block text-right card-footer">
                                {{-- <a class="btn-wide btn btn-info text-white">Previous</a> --}}
                                <button type="submit" class="btn-wide btn btn-success">Save & Next</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection