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
                <div>Edit Delivery Zone - Working Hours
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
                                <a href="{{url('admin/edit/zone/details')}}/{{$zone}}" id="tab1" class="nav-link btn-success text-white">
                                    <em>1</em><span>Edit Zone Information</span>
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a href="{{url('admin/edit/zone/working/hours')}}/{{$zone}}" id="tab2" class="nav-link">
                                    <em>2</em><span>Working Hours</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('admin/edit/zone/location')}}/{{$zone}}" id="tab3" class="nav-link">
                                    <em>3</em><span>Location</span>
                                </a>
                            </li>
                        </ul>
                        <form method="post" action="{{ url('admin/update/zone/workinghours') }}">
                            @csrf
                            <input type="hidden" name="zid" value="{{$zone}}">
                            <?php  
                                $array = $workhours->toArray();
                            ?>
                                <div class="form-wizard-content sw-container tab-content" style="min-height: 0px;">
                                    <div id="step-122" class="tab-pane step-content" style="display: block;">
                                        <div class="card-body">
                                            <div class="position-relative form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" id="everyday" class="form-check-input" @if($workhours[0]->day == 'ALL') checked  @endif name="everyday" value="1"> Everyday
                                                </label>
                                            </div>
                                                <div class="row">
                                                    
                                                    <div class="col-md-10">
            
                                                        <div class="position-relative form-group">
                                                            <label for="examplePhone" class="col-form-label required"><strong>Days</strong></label><br>
                                                            @foreach($Days as $dky=>$day)
                                                            <?php  
                                                                
                                                                $key='';
                                                                $keys = array_search($dky,array_column($array, 'day')); 
                                                            ?>
                                                                <div  
                                                                @if($dky == 'ALL') 
                                                                    class = "row everyday" 
                                                                        @if($workhours[$keys]->day != 'ALL')
                                                                            style="display:none";
                                                                        @endif
                                                                    @else 
                                                                        class = "row singleday"  
                                                                            @if($workhours[$keys]->day == 'ALL')
                                                                                style="display:none";
                                                                            @endif
                                                                    @endif  
                                                                >

                                                                    <div class="position-relative form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="checkbox" id="everyday" class="form-check-input {{ $errors->has('hours_opening') ? 'is-invalid' : '' }}"  @if(@$workhours[$keys]->day == $dky) checked @endif  name="day[{{$dky}}]" value="{{$dky}}" > {{$day}}
                                                                        </label>
                                                                    
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="position-relative form-group">
                                                                                
                                                                                <label for="exampleCustomSelect">Working Hours Started At</label>
                                                                                <div class="input-group clockpicker">
                                                                                    <input type="text" class="form-control timeText" name="hours_opening[{{$dky}}]" 
                                                                                    @if(@$workhours[$keys]->day==$dky)
                                                                                    value="{{@$workhours[$keys]->work_start_time}}" 
                                                                                    @else 
                                                                                    value="00:00" 
                                                                                    @endif
                                                                                    required>
                                                                                    <div class="input-group-append">
                                                                                        <span class="input-group-addon input-group-text"><i class="pe-7s-clock"> </i></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="position-relative form-group">
                                                                                <label for="exampleCustomMutlipleSelect ">Working Hours Ended At</label>
                                                                                <div class="input-group clockpicker">
                                                                                    <input type="text" class="form-control timeText" name="hours_closing[{{$dky}}]" 
                                                                                    
                                                                                    @if(@$workhours[$keys]->day==$dky)
                                                                                    value="{{@$workhours[$keys]->work_end_time}}" 
                                                                                    @else 
                                                                                    value="00:00" 
                                                                                    @endif
                                                                                    required>
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
                                                                                    <input type="text" class="form-control" name="break_opening[{{$dky}}]" 
                                                                                    @if(@$workhours[$keys]->day==$dky)
                                                                                    value="{{@$workhours[$keys]->break_start_time}}" 
                                                                                    @else 
                                                                                    value="00:00" 
                                                                                    @endif
                                                                                    required>
                                                                                    <div class="input-group-append">
                                                                                        <span class="input-group-text input-group-addon"><i class="pe-7s-clock"> </i></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="position-relative form-group">
                                                                                <label for="exampleCustomMutlipleSelect">Break Time Ended At</label>
                                                                                <div class="input-group clockpicker">
                                                                                    <input type="text" class="form-control" name="break_closing[{{$dky}}]" 
                                                                                    @if(@$workhours[$keys]->day==$dky)
                                                                                    value="{{@$workhours[$keys]->break_end_time}}" 
                                                                                    @else 
                                                                                    value="00:00" 
                                                                                    @endif required>
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
                        <div class="pull-left">
                            <a href="{{url('admin/edit/zone/details')}}/{{$zone}}" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-info">Back</a>
                        </div>
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