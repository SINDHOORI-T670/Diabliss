@extends('backEnd.master')
@section('content')
@include('backEnd.partials.alertMessage') 
<br>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-usb icon-gradient bg-tempting-azure"></i>
                </div>
                <div>Products
                    {{-- <div class="page-title-subheading">Choose between regular React Bootstrap tables or advanced dynamic ones.</div> --}}
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow  btn btn-info" onclick="location.href='{{ url('admin/create/product/details')}}'">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        Product
                    </button>
                </div>
            </div>    </div>
    </div>           
     <div class="main-card mb-3 card">
        <div class="card-body">
            <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title [English]</th>
                    <th>Title [Arabic]</th>
                    <th>Category</th>
                    <th>Current Quantity</th>
                    <th>Sort Order</th>
                    <th>publish</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($list as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->title_ar}}</td>
                        <td>
                            {{$item->category->name}}
                        </td>
                        <td>98</td>
                        <td>{{$item->order}}</td>
                        <td>@if($item->status==0) <p class="text-success">Active</p> @else <p class="text-danger">Inactive</p>@endif</td>
                        <td>
                            <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#editArea{{$item->id}}">
                               Edit
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection