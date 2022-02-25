@extends('backEnd.master')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-usb icon-gradient bg-tempting-azure"></i>
                </div>
                <div>Delivery Zones
                    {{-- <div class="page-title-subheading">Choose between regular React Bootstrap tables or advanced dynamic ones.</div> --}}
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow  btn btn-info" onclick="location.href='{{ url('admin/create/delivery/zone')}}'">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        Delivery Zones
                    </button>
                </div>
            </div>    </div>
    </div>           
     <div class="main-card mb-3 card">
        <div class="card-body">
            <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Label</th>
                        <th>Branch</th>
                        <th>Country</th>
                        <th colspan="3"><center>Delivery</center></th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Time</th>
                        <th>Type</th>
                        <th>Fees</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($list as $item)
                        <tr>
                            <td>{{$item->label}}</td>
                            <td>
                                <?php $class_array = array("badge-primary","badge-danger","badge-success","badge-warning","badge-secondary","badge-info"); ?>
                                @foreach(explode(',',$item->branch_id) as $branch)
                                @foreach($br as $b)
                                    @if($b->id==$branch)
                                    <div class="ml-auto badge badge-pill {{$class_array[array_rand($class_array)]}}">{{$b->title}}</div>
                                    @endif
                                @endforeach
                                @endforeach
                            <td>
                                @if(isset($item->country))
                                    {{-- @foreach($item->dzareas->groupBy('country_id') as $country) --}}
                                        {{$item->country->name}}
                                    {{-- @endforeach --}}
                                @else 
                                 --
                                @endif
                            </td>
                            <td>{{$item->delivery_time}}</td>
                            <td>{{$item->delivery_type}}</td>
                            <td>{{$item->delivery_fee}}</td>
                            <td>
                                <a href="{{route('Edit-Zone-Details',['id'=>$item->id])}}">Edit</a>
                                {{-- <button type="button" class="btn mr-2 mb-2 btn-danger" onclick="location.href='{{ url('admin/delete/zone')}}/{{$item->id}}'">
                                    Delete
                                </button> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection