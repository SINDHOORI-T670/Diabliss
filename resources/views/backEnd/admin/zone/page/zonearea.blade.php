@extends('backEnd.master')
@section('content')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" /> --}}
<style>
    .multiselect-container > li > a > label.checkbox
    {
        width: auto !important;
       
    }
    .bootstrap-select.btn-group .dropdown-toggle .filter-option { white-space: normal; }
    .btn-group > .btn:first-child
    {
        width: 220px !important;
    }
    .invalid-feedback{
        display:block !important;
    }
    .count option[class='selected'] {
        color: green;
    }
</style>
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="lnr-map text-info"></i>
                </div>
                <div>Delivery Zone Area
                    {{-- <div class="page-title-subheading">Easily create beautiful form multi step wizards!</div> --}}
                </div>
            </div>
        </div>
    </div>        
    
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade active show" id="tab-content-2" role="tabpanel">
            <div class="main-card mb-3 card">
                <form method="post" action="{{ url('admin/save/zone/location') }}">
                    @csrf
                    <input type="hidden" value="{{$zid}}" name="zid">
                    <div class="card-body">
                        <div id="smartwizard3" class="forms-wizard-vertical sw-main sw-theme-default">
                            <ul class="forms-wizard nav nav-tabs step-anchor">
                                <li class="nav-item">
                                    <a href="#" class="nav-link btn-success text-white">
                                        <em>1</em><span>Zone Information</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link btn-success text-white">
                                        <em>2</em><span>Working Hours</span>
                                    </a>
                                </li>
                                <li class="nav-item active">
                                    <a href="{{url('add/zone-location')}}/{{$zid}}" class="nav-link">
                                        <em>3</em><span>Location</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="form-wizard-content sw-container tab-content" style="min-height: 0px;">
                                <div id="step-122" class="tab-pane step-content" style="display: block;">
                                    <div class="card-body">
                                        <select  name="country" id="country" class="count form-control  @if ($errors->has('country')) is-invalid @endif">
                                            <option value="0">Select Country</option>
                                            @foreach($countries as $country)
                                            <option value="{{$country->id}}" @if($country->id==$zone->country_id) selected class="success" @else disabled @endif>{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('country'))
                                            <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('country') }}</em>
                                        @endif <br>
                                        
                                        <div id="ListCity">
                                            {{-- @foreach($cities as $city)
                                               <hr>
                                                <h5 class="card-title">{{$city->name}}</h5>
                                                <div class="position-relative form-group">
                                                    <div>
                                                        @foreach($city->areas as $area)
                                                            @if($area->status==0)
                                                                <div class="custom-checkbox custom-control custom-control-inline">
                                                                    <input type="checkbox" id="area_{{$area->id}}" name="area[]" class="custom-control-input" value="{{$area->id}}">
                                                                    <label class="custom-control-label" for="area_{{$area->id}}">{{$area->name}}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach --}}
                                            @if ($errors->has('city'))
                                                <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('city') }}</em>
                                            @endif
                                        </div>
                                        <div id="ListArea">
                                            @if ($errors->has('area'))
                                                <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('area') }}</em>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="clearfix">
                            <button type="submit" id="next-btn22" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">Save Location</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
        var select = document.getElementById('area');
        if(select){
            select.size = select.length;
        }
        
        $('select[multiple]').multiselect({
            nonSelectedText: 'Select Area',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth:'400px'
        });
        $(document).on('change', '#country', function() {
            var country_id =  $('#country').val();     // get id the value from the select
            
            $.ajax({
                url:"{{route('getCity')}}",
                method:"get",
                async: false,
                data:{country_id:country_id},
                success:function(data)
                {
                    // console.log(data);
                    $('#ListCity').html(data);
                    // $('#city').html(data);
                    // $('#city').multiselect('rebuild');
                } 
            }) 
        });
        $(document).on('change', '#city', function() {
            var city_id =  $('#city').val();     // get id the value from the select
            $.ajax({
                url:"{{url('admin/get/area')}}",
                method:"get",
                data:{city_id:city_id},
                success:function(data)
                {
                  
                    $('#ListArea').html(data);
                    $('#area').multiselect('rebuild');
                } 
            }) 
        });
        
          
    });
</script>
@endsection