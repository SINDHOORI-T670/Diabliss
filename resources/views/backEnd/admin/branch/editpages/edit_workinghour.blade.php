@extends('backEnd.master')
@section('content')
<link rel="stylesheet" href="{{ asset('admin/assets/clockpicker/dist/bootstrap-clockpicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/dropify/dist/css/dropify.min.css') }}">
<style>
    .everyday{
        display:table-cell;
    }
    .singleday{
        display:table;
        margin-left:auto;
        margin-right: :auto;
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
                <div>Update Branch - Working Hours
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
            <a role="tab" class="nav-link" id="tab-0"  href="{{route('Edit-Branch-Details',['id'=>$branch[0]->branch_id])}}">
                <span>Details</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-1"  href="{{route('Edit-Branch-Ordersettings',['id'=>$branch[0]->branch_id])}}">
                <span>Settings</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link active" id="tab-2"  href="{{route('Edit-Branch-Working-Hours',['id'=>$branch[0]->branch_id])}}">
                <span>Working Hours</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-3"  href="{{route('Edit-Branch-Location',['id'=>$branch[0]->branch_id])}}">
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
                        <form method="post" action="{{ url('admin/update/branch/workinghours') }}">
                            @csrf
                            <input type="hidden" name="bid" value="{{$branch[0]->branch_id}}">
                            <?php  
                                $array = $branch->toArray();
                            ?>
                            <div class="card-body">
                                <div class="position-relative form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" id="everyday" class="form-check-input" @if($branch[0]->day == 'ALL') checked  @endif  name="everyday" value="1"> Everyday
                                    </label>
                                </div>
                                    <div class="row">
                                        
                                        <div class="col-md-6">

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
                                                                @if($branch[$keys]->day != 'ALL')
                                                                    style="display:none";
                                                                @endif
                                                        @else 
                                                            class = "row singleday"  
                                                                @if($branch[$keys]->day == 'ALL')
                                                                    style="display:none";
                                                                @endif
                                                        @endif  
                                                    >
                                                        <div class="position-relative form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" @if(@$branch[$keys]->day == $dky) checked @endif  name="day[{{$dky}}]" value="{{$dky}}" > {{$day}}
                                                            </label>
                                                           
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="position-relative form-group">
                                                                    
                                                                    <label for="exampleCustomSelect">Working Hours Started At</label>
                                                                    <div class="input-group clockpicker">
                                                                        <input type="text" class="form-control timeText" name="hours_opening[{{$dky}}]" 
                                                                        @if(@$branch[$keys]->day==$dky)
                                                                        value="{{@$branch[$keys]->work_start_time}}" 
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
                                                                    <label for="exampleCustomMutlipleSelect">Working Hours Ended At</label>
                                                                    <div class="input-group clockpicker">
                                                                        <input type="text" class="form-control timeText" name="hours_closing[{{$dky}}]" 
                                                                        @if(@$branch[$keys]->day==$dky)
                                                                        value="{{@$branch[$keys]->work_end_time}}" 
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
                                                                        @if(@$branch[$keys]->day==$dky)
                                                                        value="{{@$branch[$keys]->break_start_time}}" 
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
                                                                        @if(@$branch[$keys]->day==$dky)
                                                                        value="{{@$branch[$keys]->break_end_time}}" 
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
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        
                                    </div>
                            </div>
                            <div class="d-block text-right card-footer">
                                <button type="submit" class="btn-wide btn btn-success">Update</button>
                                <a  href="{{route('Edit-Branch-Location',['id'=>$branch[0]->branch_id])}}" class="btn-wide btn btn-info text-white">Next</a>
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