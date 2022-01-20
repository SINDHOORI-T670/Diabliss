@extends('backEnd.master')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-usb icon-gradient bg-tempting-azure"></i>
                </div>
                <div>Branches
                    {{-- <div class="page-title-subheading">Choose between regular React Bootstrap tables or advanced dynamic ones.</div> --}}
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow  btn btn-info" onclick="location.href='{{ url('admin/create/branch/details')}}'">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        Branch
                    </button>
                </div>
            </div>    </div>
    </div>           
     <div class="main-card mb-3 card">
        <div class="card-body">
            <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                <thead>
                <tr>
                    <th>Name [English]</th>
                    <th>Name [Arabic]</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Busy</th>
                    <th>Delivery</th>
                    <th>Pickup</th>
                    <th>Schedule</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td>{{$item->title}}</td>
                            <td>{{$item->title_ar}}</td>
                            <td>{{$item->phone}}</td>
                            <td>
                                @if($item->status=="on")
                                    <button class="mb-2 mr-2 btn btn-success">Enabled</button>
                                @else 
                                    <button class="mb-2 mr-2 btn btn-danger">disabled</button>
                                @endif
                            
                            </td>
                            <td>
                                @if(isset($item->settings) && $item->settings->busy == 0)
                                    <button class="mb-2 mr-2 btn btn-success">Enabled</button>
                                @else 
                                    <button class="mb-2 mr-2 btn btn-danger">disabled</button>
                                @endif
                            </td>
                            <td>
                                @if(isset($item->settings) && $item->settings->delivery == 0)
                                    <button class="mb-2 mr-2 btn btn-success">Enabled</button>
                                @else 
                                    <button class="mb-2 mr-2 btn btn-danger">disabled</button>
                                @endif
                            </td>
                            <td>
                                @if(isset($item->settings) && $item->settings->pickup == 0)
                                    <button class="mb-2 mr-2 btn btn-success">Enabled</button>
                                @else 
                                    <button class="mb-2 mr-2 btn btn-danger">disabled</button>
                                @endif
                            </td>
                            <td>
                                @if(isset($item->settings) && $item->settings->schedule == 0)
                                    <button class="mb-2 mr-2 btn btn-success">Enabled</button>
                                @else 
                                    <button class="mb-2 mr-2 btn btn-danger">disabled</button>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('Edit-Branch-Details',['id'=>$item->id])}}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection