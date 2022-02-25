@extends('backEnd.master')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-usb icon-gradient bg-tempting-azure"></i>
                </div>
                <div>Sub Category for {{ucfirst($category->name)}}
                    {{-- <div class="page-title-subheading">Choose between regular React Bootstrap tables or advanced dynamic ones.</div> --}}
                </div>
            </div>
            <div class="page-title-actions">
                    <button type="button" data-toggle="tooltip" onclick="location.href='{{ url('admin/categories')}}'" title="" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark" data-original-title="Category List">
                        <i class="pe-7s-angle-left-circle"></i>
                    </button>
                <div class="d-inline-block dropdown">
                    
                    <button type="button" class="btn-shadow  btn btn-info" data-toggle="modal" data-target="#createcategory">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        Sub Category
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
                                <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#editCategory{{$item->id}}">
                                   Edit
                                </button>
                                <button type="button" class="btn mr-2 mb-2 btn-danger" onclick="location.href='{{ url('admin/delete/subcategory')}}/{{$item->id}}'">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <div class="modal fade" id="editCategory{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-modal="true" style="top:90px;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Sub Category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form method="post" action="{{ url('admin/update/subcategory') }}/{{$item->id}}">
                                        @csrf
                                        <input type="hidden" value="{{$category->id}}" name="cat_id"}}>
                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <label for="exampleEmail" class="col-sm-8 col-form-label required">Category</label>
                                                    <input name="category" id="exampleName" placeholder="Enter category Name" type="text" class="form-control  @if ($errors->has('category')) is-invalid @endif"  value="{{$item->name}}">
                                                    @if ($errors->has('category'))
                                                        <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('category') }}</em>
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
            <div class="modal fade" id="createcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true" style="top:90px;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Sub Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form method="post" action="{{ url('admin/save/subcategory') }}">
                            @csrf
                            <input type="hidden" value="{{$category->id}}" name="cat_id"}}>
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail" class="col-sm-8 col-form-label required">New category</label>
                                        <input name="category" id="exampleName" placeholder="Enter category Name" type="text" class="form-control  @if ($errors->has('category')) is-invalid @endif" >
                                        @if ($errors->has('category'))
                                            <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('category') }}</em>
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