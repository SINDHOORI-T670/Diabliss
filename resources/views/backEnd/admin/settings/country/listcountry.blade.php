@extends('backEnd.master')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-usb icon-gradient bg-tempting-azure"></i>
                </div>
                <div>Countries
                    {{-- <div class="page-title-subheading">Choose between regular React Bootstrap tables or advanced dynamic ones.</div> --}}
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <button type="button" class="btn-shadow  btn btn-info" data-toggle="modal" data-target="#createcountry">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        Country
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
                                <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#editCountry{{$item->id}}">
                                   Edit
                                </button>
                                <button type="button" class="btn mr-2 mb-2 btn-danger" onclick="location.href='{{ url('admin/delete/country')}}/{{$item->id}}'">
                                    Delete
                                </button>
                                <a class="btn mr-2 mb-2 btn-warning text-white" href="{{url('admin/list/city')}}/{{$item->id}}">Cities</a>
                            </td>
                        </tr>
                        <div class="modal fade" id="editCountry{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-modal="true" style="top:90px;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Country</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form method="post" action="{{ url('admin/update/country') }}/{{$item->id}}">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <label for="exampleEmail" class="col-sm-8 col-form-label required">Country</label>
                                                    <input name="country" id="exampleName" placeholder="Enter Country Name" type="text" class="form-control  @if ($errors->has('country')) is-invalid @endif"  value="{{$item->name}}">
                                                    @if ($errors->has('country'))
                                                        <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('country') }}</em>
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
            <div class="modal fade" id="createcountry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true" style="top:90px;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Country</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form method="post" action="{{ url('admin/save/country') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail" class="col-sm-8 col-form-label required">New Country</label>
                                        <input name="country" id="exampleName" placeholder="Enter Country Name" type="text" class="form-control  @if ($errors->has('country')) is-invalid @endif" >
                                        @if ($errors->has('country'))
                                            <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('country') }}</em>
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

@endsection