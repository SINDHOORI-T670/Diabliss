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
@include('backEnd.partials.alertMessage') 
<br>
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-usb icon-gradient bg-happy-itmeo"></i>
                </div>
                <div>Create Branch - Working Hours
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
            <a role="tab" class="nav-link " id="tab-1" data-toggle="tab" href="#tab-content-1">
                <span>Settings</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link  active" id="tab-2" data-toggle="tab" href="#tab-content-2">
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
                        <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i> Please add branch working hours .
                            
                        </div>
                        <form method="post" action="{{ url('admin/save/branch/workinghours') }}">
                            @csrf
                            <input type="hidden" name="bid" value="{{$branch->id}}">
                            <div class="card-body">
                                <div class="position-relative form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" id="everyday" class="form-check-input" checked name="everyday" value="1"> Everyday
                                    </label>
                                </div>
                                    <div class="row">
                                        
                                        <div class="col-md-6">

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