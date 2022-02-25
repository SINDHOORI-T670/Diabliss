@extends('backEnd.master')
@section('content')
<link rel="stylesheet" href="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
<style>
    .bootstrap-tagsinput .tag {
        background: #b0da3b;
        border: 1px solid #b0da3b;
        padding: 0 6px;
        margin-right: 2px;
        color: white;
        border-radius: 4px;
    }
    .bootstrap-tagsinput {
        width: 100% !important;
        height: calc(2.75rem + 2px) !important;
    }
</style>
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-usb icon-gradient bg-tempting-azure"></i>
                </div>
                <div>Areas from {{$city->name}}
                    {{-- <div class="page-title-subheading">Choose between regular React Bootstrap tables or advanced dynamic ones.</div> --}}
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <button type="button" data-toggle="tooltip" onclick="location.href='{{ url('admin/list/city')}}/{{$city->country_id}}'" title="" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark" data-original-title="Back to area List">
                        <i class="pe-7s-angle-left-circle"></i>
                    </button>
                    <button type="button" class="btn-shadow  btn btn-info" data-toggle="modal" data-target="#createarea">
                        <span class="btn-icon-wrapper pr-2 opaarea-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        Area
                    </button>
                    
                </div>
            </div>    </div>
    </div>           
     <div class="main-card mb-3 card">
        <div class="card-body">
            <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>
                                @if($item->status==0)
                                    <button class="mb-2 mr-2 btn btn-success">Enabled</button>
                                @else 
                                    <button class="mb-2 mr-2 btn btn-danger">disabled</button>
                                @endif
                            
                            </td>
                            <td>
                                <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#editArea{{$item->id}}">
                                   Edit
                                </button>
                                <button type="button" class="btn mr-2 mb-2 btn-danger" onclick="location.href='{{ url('admin/delete/area')}}/{{$item->id}}'">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <div class="modal fade" id="editArea{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-modal="true" style="top:90px;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Area</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form method="post" action="{{ url('admin/update/area') }}/{{$item->id}}">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <label for="exampleEmail" class="col-sm-8 col-form-label required">Area</label>
                                                    <input name="area" id="exampleName" placeholder="Enter Area Name" type="text" class="form-control  @if ($errors->has('area')) is-invalid @endif"  value="{{$item->name}}">
                                                    @if ($errors->has('area'))
                                                        <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('area') }}</em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <label for="exampleEmail" class="col-sm-8 col-form-label required">Status</label>
                                                    <select name="status" class="form-control  @if ($errors->has('status')) is-invalid @endif">
                                                        <option value="0" @if($item->status==0) selected @else @endif>Enable</option>
                                                        <option value="1" @if($item->status==1) selected @else @endif>Disable</option>

                                                    </select>
                                                    @if ($errors->has('status'))
                                                        <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('status') }}</em>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
            <div class="modal fade" id="createarea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true" style="top:90px;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Area</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form method="post" action="{{ url('admin/save/area') }}">
                            @csrf
                            <input type="hidden" name="city" value="{{$city->id}}">
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail" class="col-sm-8 col-form-label required">New area</label>
                                        <input name="area" id="tags" placeholder="Enter Area Name" type="text"  data-role="tagsinput"  class="form-control  @if ($errors->has('area')) is-invalid @endif" >
                                        @if ($errors->has('area'))
                                            <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('area') }}</em>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
@endsection