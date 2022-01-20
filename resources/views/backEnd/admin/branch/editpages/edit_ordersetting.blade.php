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
                <div>Update Branch - Order Settings
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
            <a role="tab" class="nav-link" id="tab-0"  href="{{route('Edit-Branch-Details',['id'=>isset($branch)?$branch->branch_id:$bid])}}">
                <span>Details</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link active" id="tab-1"  href="{{route('Edit-Branch-Ordersettings',['id'=>isset($branch)?$branch->branch_id:$bid])}}">
                <span>Settings</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-2"  href="{{route('Edit-Branch-Working-Hours',['id'=>isset($branch)?$branch->branch_id:$bid])}}">
                <span>Working Hours</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-3"  href="{{route('Edit-Branch-Location',['id'=>isset($branch)?$branch->branch_id:$bid])}}">
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
                        <form method="post" action="{{ url('admin/update/branch/ordersettings') }}">
                            @csrf
                            <input type="hidden" name="bid" value="{{isset($branch)?$branch->branch_id:$bid}}">
                            <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-xl-4">
                                            <div class="position-relative form-group">
                                                <label for="exampleEmail" class="col-sm-8 col-form-label required">Busy Branch</label>
                                                <br><label class="switch">
                                                    <input type="checkbox" id="togBtn1" class="form-control" name="busy" @if(isset($branch) && $branch->busy=="0") value="0" checked @else value="1" @endif>
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
                                                    <input type="checkbox" id="togBtn2" class="form-control" name="pickup" @if(isset($branch) && $branch->pickup=="0") value="0" checked @else value="1" @endif>
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
                                                    <input type="checkbox" id="togBtn3" class="form-control" name="schedule" @if(isset($branch) && $branch->schedule=="0") value="0" checked @else value="1" @endif>
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
                                                    <input type="checkbox" id="togBtn4" class="form-control" name="delivery" @if(isset($branch) && $branch->delivery=="0") value="0" checked @else value="1" @endif>
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
                                                    <input  min="0" name="max_period" id="examplePhone"  type="number" class="form-control  @if ($errors->has('max_period')) is-invalid @endif" value="{{isset($branch)?$branch->max_order_period:0}}">
                                                    @if ($errors->has('max_period'))
                                                        <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('max_period') }}</em>
                                                    @endif
                                                    &nbsp;&nbsp; <select name="type" id="exampleSelect" class="form-control @if ($errors->has('type')) is-invalid @endif"">
                                                        <option value="0">Select any</option>
                                                        <option value="Minutes" @if(isset($branch) && $branch->max_type=="Minutes") selected @else @endif>Minutes</option>
                                                        <option value="Hours"  @if(isset($branch) && $branch->max_type=="Hours") selected @else @endif>Hours</option>
                                                        <option value="Days"  @if(isset($branch) && $branch->max_type=="Days") selected @else @endif>Days</option>
                                                    </select>
                                                    
                                                    @if ($errors->has('type'))
                                                        <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('type') }}</em>
                                                    @endif
                                                    <p class="text-info">When an order checkout requires preparation plus delivery time that exceeds this period, ASAP delivery will be disabled. Customer can schedule the order (if it's enabled)</p>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                            </div>
                            <div class="d-block text-right card-footer">
                                <button type="submit" class="btn-wide btn btn-success">Update</button>
                                <a  href="{{route('Edit-Branch-Working-Hours',['id'=>$branch->branch_id])}}" class="btn-wide btn btn-info text-white">Next</a>
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
$(document).ready(function() {
    $("#togBtn1").on('change', function() {
        if ($(this).is(':checked')) {
            $(this).attr('value', '0');
            // alert($(this).val());
        }
        else {
           $(this).attr('value', '1');
        //    alert($(this).val());
        }
    });
    $("#togBtn2").on('change', function() {
        if ($(this).is(':checked')) {
            $(this).attr('value', '0');
            // alert($(this).val());
        }
        else {
           $(this).attr('value', '1');
        //    alert($(this).val());
        }
    });
    $("#togBtn3").on('change', function() {
        if ($(this).is(':checked')) {
            $(this).attr('value', '0');
            // alert($(this).val());
        }
        else {
           $(this).attr('value', '1');
        //    alert($(this).val());
        }
    });
    $("#togBtn4").on('change', function() {
        if ($(this).is(':checked')) {
            $(this).attr('value', '0');
            // alert($(this).val());
        }
        else {
           $(this).attr('value', '1');
        //    alert($(this).val());
        }
    });
});
</script> 
@endsection