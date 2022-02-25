@extends('backEnd.master')
@section('content')
<link rel="stylesheet" href="{{ asset('admin/assets/clockpicker/dist/bootstrap-clockpicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/dropify/dist/css/dropify.min.css') }}">
<style>
    .everyday{
        display:table-cell;
    }
   .popover{
       opacity:unset;
   }
</style>
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="lnr-map text-info"></i>
                </div>
                <div>Delivery Zone - Working Hours
                    {{-- <div class="page-title-subheading">Easily create beautiful form multi step wizards!</div> --}}
                </div>
            </div>
        </div>
    </div>        
    
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade active show" id="tab-content-2" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div id="smartwizard3" class="forms-wizard-vertical sw-main sw-theme-default">
                        <ul class="forms-wizard nav nav-tabs step-anchor">
                            <li class="nav-item">
                                <a href="#" class="nav-link btn-success text-white">
                                    <em>1</em><span>Zone Information</span>
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a href="{{url('admin/create/zone/working-hours')}}/{{$zone}}" class="nav-link">
                                    <em>2</em><span>Working Hours</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <em>3</em><span>Location</span>
                                </a>
                            </li>
                        </ul>
                        <form method="post" action="{{ url('admin/save/zone/workinghours') }}">
                            @csrf
                            <input type="hidden" name="zid" value="{{$zone}}">
                                <div class="form-wizard-content sw-container tab-content" style="min-height: 0px;">
                                    <div id="step-122" class="tab-pane step-content" style="display: block;">
                                        <div class="card-body">
                                            <div class="position-relative form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" id="everyday" class="form-check-input" checked name="everyday" value="1"> Everyday
                                                </label>
                                            </div>
                                                <div class="row">
                                                    
                                                    <div class="col-md-10">
            
                                                        <div class="position-relative form-group">
                                                            <label for="examplePhone" class="col-form-label required"><strong>Days</strong></label><br>
                                                            @foreach($Days as $dky=>$day)
                                                                <div  class="row  @if($dky=='ALL') everyday   @else  singleday " style="display:none !important;" @endif " >
                                                                    <div class="position-relative form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="checkbox" id="everyday" class="form-check-input {{ $errors->has('hours_opening') ? 'is-invalid' : '' }}" @if($dky=='ALL') checked @endif  name="day[{{$dky}}]" value="{{$dky}}" > {{$day}}
                                                                        </label>
                                                                    
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="position-relative form-group">
                                                                                
                                                                                <label for="exampleCustomSelect">Working Hours Started At</label>
                                                                                <div class="input-group clockpicker">
                                                                                    <input type="text" class="form-control timeText" name="hours_opening[{{$dky}}]" value="00:00" required>
                                                                                    <div class="input-group-append">
                                                                                        <span class="input-group-addon input-group-text"><i class="pe-7s-clock"> </i></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="position-relative form-group">
                                                                                <label for="exampleCustomMutlipleSelect ">Working Hours Ended At</label>
                                                                                <div class="input-group clockpicker">
                                                                                    <input type="text" class="form-control timeText" name="hours_closing[{{$dky}}]" value="00:00" required>
                                                                                    <div class="input-group-append">
                                                                                        <span class="input-group-text input-group-addon"><i class="pe-7s-clock"> </i></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="position-relative form-group">
                                                                                <label for="exampleCustomSelect">Break Time Started At</label>
                                                                                <div class="input-group clockpicker">
                                                                                    <input type="text" class="form-control" name="break_opening[{{$dky}}]" value="00:00" required>
                                                                                    <div class="input-group-append">
                                                                                        <span class="input-group-text input-group-addon"><i class="pe-7s-clock"> </i></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="position-relative form-group">
                                                                                <label for="exampleCustomMutlipleSelect">Break Time Ended At</label>
                                                                                <div class="input-group clockpicker">
                                                                                    <input type="text" class="form-control" name="break_closing[{{$dky}}]" value="00:00" required>
                                                                                    <div class="input-group-append">
                                                                                        <span class="input-group-text input-group-addon"><i class="pe-7s-clock"> </i></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <div class="divider"></div>
                    <div class="clearfix">
                        <button type="submit" id="next-btn22" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">Save & Next</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="{{ asset('admin/assets/clockpicker/dist/bootstrap-clockpicker.min.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.js"></script> --}}
<script type="text/javascript" src="{{ asset('admin/assets/dropify/dist/js/dropify.min.js') }}"></script>

<script type="text/javascript">
    
$(document).ready(function() {
    $('.clockpicker').clockpicker({
        donetext: 'Done',
        twelvehour: true,
    });
    $('#everyday').change(function() {
        if($(this).is(":checked")) {
            
            $('.everyday').show();
            $('.singleday').hide();
            $('.singleday .chk').prop('checked',false);
            $('.everyday .chk').prop('checked',true);
            $('.everyday').css('display','table');
            $('.everyday').css('margin-right','auto');
            $('.everyday').css('margin-left','auto');
        }else{
            $('.everyday').hide();
            $('.singleday').show();
            $('.everyday .chk').prop('checked',false);
            $('.singleday .chk').prop('checked',true);
            $('.singleday').css('display','table');
            $('.singleday').css('margin-right','auto');
            $('.singleday').css('margin-left','auto');
        }
    });
});
</script>
@endsection