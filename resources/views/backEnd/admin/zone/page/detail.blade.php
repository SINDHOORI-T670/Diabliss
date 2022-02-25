@extends('backEnd.master')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="lnr-map text-info"></i>
                </div>
                <div>Delivery Zone
                    {{-- <div class="page-title-subheading">Easily create beautiful form multi step wizards!</div> --}}
                </div>
            </div>
        </div>
    </div>        
    
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade active show" id="tab-content-2" role="tabpanel">
            <div class="main-card mb-3 card">
                <form method="post" action="{{ url('admin/save/delivery-zone') }}">
                    @csrf
                    <div class="card-body">
                        <div id="smartwizard3" class="forms-wizard-vertical sw-main sw-theme-default">
                            <ul class="forms-wizard nav nav-tabs step-anchor">
                                <li class="nav-item active">
                                    <a href="{{url('admin/create/delivery/zone')}}" class="nav-link">
                                        <em>1</em><span>Zone Information</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <em>2</em><span>Working Hours</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <em>3</em><span>Location</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="form-wizard-content sw-container tab-content" style="min-height: 0px;">
                                <div id="step-122" class="tab-pane step-content" style="display: block;">
                                    <div class="card-body">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail5">Status</label><br>
                                            <label class="switch">
                                                <input type="checkbox" id="togBtn" class="form-control" name="status" value="0" checked>
                                                <div class="slider round">
                                                    <!--ADDED HTML -->
                                                    <span class="on">ON</span>
                                                    <span class="off">OFF</span>
                                                    <!--END-->
                                                </div>
                                            </label>
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail5" class="required">Label</label>
                                            <input type="text" class="form-control  @if ($errors->has('label')) is-invalid @endif" name="label">
                                            @if ($errors->has('label'))
                                                <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('label') }}</em>
                                            @endif
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail6"class="required">Branch</label>
                                            <select multiple="" name="branches[]" class="multiselect-dropdown form-control @if ($errors->has('branches')) is-invalid @endif">
                                                @foreach($branches as $branch)
                                                <option value="{{$branch->id}}">{{$branch->title}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('branches'))
                                                <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('branches') }}</em>
                                            @endif
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail6"class="required">Country</label>
                                            <select name="country" class="form-control @if ($errors->has('country')) is-invalid @endif">
                                                @foreach($country as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('country'))
                                                <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('country') }}</em>
                                            @endif
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="examplePhone" class="col-form-label required">Minimum Order</label>
                                            <input name="minorder" id="examplePhone" placeholder="Minimum Order" type="number" class="form-control @if ($errors->has('minorder')) is-invalid @endif">
                                            <label class="text-info">(KWD)</label>
                                            @if ($errors->has('minorder'))
                                                <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('minorder') }}</em>
                                            @endif
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="examplePhone" class="col-form-label required">Delivery Time</label>
                                            
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input  min="0" name="max_period" id="examplePhone"  type="number" class="form-control  @if ($errors->has('max_period')) is-invalid @endif" placeholder="Delivery Time" value="0">
                                                    &nbsp;&nbsp; <select name="type" id="exampleSelect" class="form-control @if ($errors->has('type')) is-invalid @endif">
                                                        <option value="0">Select any</option>
                                                        <option value="Minutes">Minutes</option>
                                                        <option value="Hours">Hours</option>
                                                        <option value="Days">Days</option>
                                                    </select>
                                                    <br>
                                                    @if ($errors->has('max_period'))
                                                        <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('max_period') }}</em>
                                                    @endif
                                                    @if ($errors->has('type'))
                                                        <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('type') }}</em>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail">Delivery Fee</label>
                                            <input type="number" name="fee" class="form-control @if ($errors->has('fee')) is-invalid @endif" placeholder="Delivery Fee">
                                            @if ($errors->has('fee'))
                                                <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('fee') }}</em>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="clearfix">
                            <button type="submit" id="next-btn22" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">Save & Next</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript">
    $("#togBtn").on('change', function() {
        if ($(this).is(':checked')) {
            $(this).attr('value', '0');
            $(this).attr("checked",true);
            // alert($(this).val());
        }
        else {
           $(this).attr('value', '1');
           $(this).removeAttr('checked');
        //    alert($(this).val());
        }
    });
</script> 
@endsection