@extends('backEnd.master')
@section('content')

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" /> --}}
<style>
   #scrollMe {
        height:150px;
        /* background-color:yellow; */
        overflow-y: auto;
        overflow-x:hidden;
        padding:20px;
    }
    .multiselect-container > li > a > label.checkbox
    {
        width: auto !important;
       /* height:200px !important; */
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
                <form method="post" action="{{ url('admin/update/zone/location') }}">
                    @csrf
                    <input type="hidden" value="{{$zid}}" name="zid">
                    <div class="card-body">
                        <div id="smartwizard3" class="forms-wizard-vertical sw-main sw-theme-default">
                            <ul class="forms-wizard nav nav-tabs step-anchor">
                                <li class="nav-item">
                                    <a href="{{url('admin/edit/zone/details')}}/{{$zone->id}}" id="tab1" class="nav-link btn-success text-white">
                                        <em>1</em><span>Edit Zone Information</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/edit/zone/working/hours')}}/{{$zone->id}}" id="tab2" class="nav-link btn-success text-white">
                                        <em>2</em><span>Edit Working Hours</span>
                                    </a>
                                </li>
                                <li class="nav-item active">
                                    <a href="{{url('admin/edit/zone/location')}}/{{$zone->id}}" class="nav-link">
                                        <em>3</em><span>Edit Location</span>
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
                                            {{-- <br> --}}
                                            <label>City</label>
                                            <select  name="city" id="city" class="count form-control  @if ($errors->has('country')) is-invalid @endif">
                                                <option value="0">Select City</option>
                                                @foreach($cities as $city)
                                                <option value="{{$city->id}}" @foreach($areas as $area) @if($area->city_id==$city->id) selected  @else @endif @endforeach>{{$city->name}}</option>
                                                @endforeach
                                            </select><br>
                                            @if ($errors->has('city'))
                                                <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('city') }}</em>
                                            @endif
                                        </div>
                                        <div id="ListArea">
                                            
                                            <label>Area</label>
                                            <br>
                                            
                                            {{-- @foreach($cities as $city) --}}
                                                <div class="position-relative form-group">
                                                    <div>
                                                        
                                                        @foreach($areas as $area)
                                                        {{-- @foreach($item->area as $area) --}}
                                                            {{-- @if($area->city_id==$item->city_id && $area->status==0) --}}
                                                                <div class="custom-checkbox custom-control custom-control-inline">
                                                                    <input type="checkbox" id="area_{{$area->id}}" name="area[]" class="custom-control-input" value="{{$area->id}}" checked >
                                                                    <label class="custom-control-label" for="area_{{$area->id}}">{{$area->area->name}}</label>
                                                                </div>
                                                            {{-- @endif --}}
                                                        {{-- @endforeach --}}
                                                        @endforeach
                                                    </div>
                                                </div>
                                            {{-- @endforeach --}}
                                            {{-- <input name="area" id="tags" placeholder="Enter Area Name" type="text"  data-role="tagsinput"  class="form-control  @if ($errors->has('area')) is-invalid @endif" value="@foreach($areas as $area)
                                            @foreach($area->area as $item) @if($item->id==$area->area_id) {{$item->name}} @endif @endforeach @endforeach"> --}}
                                            
                                            {{-- <select name="area[]" id="area" class="form-control" multiple style="overflow:hidden">
                                                @foreach($areas as $area)
                                                    @foreach($area->area as $item)
                                                    <option value="{{$item->id}}" @if($item->id==$area->area_id) selected @else @endif >{{$item->name}}</option>
                                                    @endforeach
                                                @endforeach
                                            </select> --}}
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
                            <button type="submit" id="next-btn22" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">Update</button>
                            <div class="pull-left">
                                <a href="{{url('admin/edit/zone/working/hours')}}/{{$zone->id}}" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-info">Back</a>
                            </div>
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
        
        
        
        $('select[multiple]').multiselect({
            nonSelectedText: 'Select Area',
            // enableFiltering: true,
            // enableCaseInsensitiveFiltering: true,
            // buttonWidth:'400px'
        });

        // $(document).on('change', '.country', function() {
        //     // console.log(this.id);
        //     var id = this.id;
        //     $.ajax({
        //         url:"{{route('getCity')}}",
        //         method:"get",
        //         // async: false,
        //         data:{country_id:id},
        //         success:function(data)
        //         {
        //             console.log(data);
        //             $('#ListMe').html(data);
        //             // $('#city_'+id).multiselect('rebuild');
        //         } 
        //     }) 
        // });
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
            var zid = '{{$zone->id}}';
            $.ajax({
                url:"{{route('getAreaedit')}}",
                method:"get",
                data:{city_id:city_id,zid:zid},
                success:function(data)
                {
                  
                    $('#ListArea').html(data);
                    $('#area').multiselect('rebuild');
                    // const l = document.getElementById("area")
                    // l.setAttribute("size", l.childElementCount + l.length)
                } 
            }) 
        });
        var i=1; 
        var c = {!! json_encode($countries) !!};
        // console.log(c);
        $('#add').click(function(){  
            i++;  
            $('#city_'+i).multiselect('rebuild');
            // $('#area_'+i).multiselect({
            //     includeSelectAllOption: true
            // });
            
            var html = '';
            html += '<tr id="row'+i+'" class="dynamic-added"><td colspan="8"><select name="country[]" id="'+i+'" class="country form-control"><option value="0">Select Country</option>';
                $.each(c, function( index, value ) {
                    html +='<option value="'+value.id+'">'+value.name+'</option>';

                })
            html += '</select></td><td colspan="15"><select  name="city[]" id="city_'+i+'" multiple class="form-control city @if ($errors->has("city")) is-invalid @endif"><option value="0">Select City</option></select></td><td colspan="4"><center><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></center></td></tr>';
                // <select name="area" id="area_'+i+'" multiple class="multiselect-dropdown form-control area"><option value="0">Select Area</option></select></td><td colspan="4"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>'
            $('#dynamic_field').append(html); 
            $('#city_'+i).multiselect('rebuild');
            // $('#area_'+i).multiselect({
 
            //     columns: 4,
                
            //     placeholder: 'Select options'

            // });
        });  
        $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");   
            $('#row'+button_id+'').remove();  
        });
        
          
    });
</script>
@endsection