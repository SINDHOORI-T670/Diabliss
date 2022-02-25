@extends('backEnd.master')
@section('content')
<link rel="stylesheet" href="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.css" rel="stylesheet">

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
  input[type=file]{

      display: inline;

    }

    #image_preview{

      border: 1px solid black;

      padding: 10px;

    }

    #image_preview img{

      width: 200px;

      padding: 5px;

    }
    .pip {
      display: inline-block;
      position: relative;
    }
    .remove{
        display:block;
        float:right;
        width:30px;
        height:29px;
        background:url(https://web.archive.org/web/20110126035650/http://digitalsbykobke.com/images/close.png) no-repeat center center;
    }
</style>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-usb icon-gradient bg-happy-itmeo"></i>
                </div>
                <div>Create Product - Details
                    {{-- <div class="page-title-subheading">Tabs are used to split content between multiple sections. Wide variety available.</div> --}}
                </div>
            </div>
        </div>
    </div>            
    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
        <li class="nav-item">
            <a role="tab" class="nav-link active" id="tab-0"  href="{{url('admin/create/branch/details')}}">
                <span>Details</span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-1"  href="#tab-content-1">
                <span>Images</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-2">
                <span>Working Hours</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-3" data-toggle="tab" href="#tab-content-3">
                <span>Location</span>
            </a>
        </li> --}}
    </ul>
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i> Please add branch details .
                            
                        </div>
                        <form method="post" action="{{ url('admin/save/product_details') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                    {{-- <div class="form-row"> --}}
                                        <div class="col-md-12">
                                            <div class="position-relative form-group">
                                                <label for="exampleEmail" class="col-sm-2 col-form-label required">Status</label>
                                                <br><label class="pull-left switch">
                                                    <input type="checkbox" id="togBtn" class="form-control" name="status" value="0" checked>
                                                    <div class="slider round">
                                                        <!--ADDED HTML -->
                                                        <span class="on">ON</span>
                                                        <span class="off">OFF</span>
                                                        <!--END-->
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="position-relative form-group">
                                                <label for="exampleEmail" class="col-sm-2 col-form-label required">Title [English]</label>
                                                <input name="title" id="title" placeholder="Enter Title" type="text" class="form-control  @if ($errors->has('title')) is-invalid @endif" >
                                                @if ($errors->has('title'))
                                                    <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('title') }}</em>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="position-relative form-group">
                                                <label for="exampleEmail" class="col-sm-2 col-form-label required">Title [Arabic]</label>
                                                <input name="titlear" id="titlear" placeholder="Enter Title (Arabic)" type="text" class="form-control  @if ($errors->has('titlear')) is-invalid @endif" >
                                                @if ($errors->has('titlear'))
                                                    <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('titlear') }}</em>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="exampleEmail6"class="required">Category</label>
                                            <select name="category" id="category" class="form-control @if ($errors->has('category')) is-invalid @endif">
                                               <option value="0">Select</option>
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category'))
                                                <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('category') }}</em>
                                            @endif
                                        </div><br>
                                        <div class="col-md-12">
                                            <label for="exampleEmail6"class="required">Sub Category</label>
                                            <select name="subcategory" id="subcategory" class="form-control @if ($errors->has('subcategory')) is-invalid @endif">
                                                
                                            </select>
                                            @if ($errors->has('subcategory'))
                                                <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('subcategory') }}</em>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <label for="examplePhone" class="col-form-label required">Sort Order</label>
                                            <input name="sort" id="examplePhone" placeholder="Sort Order" type="number" class="form-control @if ($errors->has('sort')) is-invalid @endif">
                                            @if ($errors->has('sort'))
                                                <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('sort') }}</em>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <label for="examplePhone" class="col-form-label required">Preparation Time</label>
                                            
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input  min="0" name="time" id="examplePhone"  type="number" class="form-control  @if ($errors->has('time')) is-invalid @endif" placeholder="Preparation Time" value="0">
                                                    &nbsp;&nbsp; <select name="type" id="exampleSelect" class="form-control @if ($errors->has('type')) is-invalid @endif">
                                                        <option value="Hours">Hours</option>
                                                        <option value="Days">Days</option>
                                                    </select>
                                                    <br>
                                                    @if ($errors->has('time'))
                                                        <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('time') }}</em>
                                                    @endif
                                                    @if ($errors->has('type'))
                                                        <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('type') }}</em>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-12">
                                            <div class="position-relative form-group">
                                                <label for="exampleEmail" class="col-sm-2 col-form-label required">Unit</label>
                                                <input name="unit" id="unit" placeholder="Unit" type="text" class="form-control  @if ($errors->has('title')) is-invalid @endif" >
                                                @if ($errors->has('unit'))
                                                    <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('unit') }}</em>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="position-relative form-group">
                                                <label for="exampleEmail" class="col-sm-8 col-form-label required">Tags</label>
                                                <input name="tags[]" id="tags" placeholder="Tags" type="text"  data-role="tagsinput"  class="form-control  @if ($errors->has('tags')) is-invalid @endif" >
                                                @if ($errors->has('tags'))
                                                    <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('tags') }}</em>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required">Images (JPG)
                                                    (Recommended Width / Height: - 500px:500px)</label>
                                                <div class="custom-file" id="upload-form">
                                                  <input type="file" class="file-input uploadFile" id="uploadFile" accept="image/jpg,image/jpeg"  name="files[]" multiple="multiple" required>
                                                </div>
                                              </div>
                                              <div id="image_preview"></div>
                                              <br>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="position-relative form-group">
                                                <label for="exampleEmail" class="col-sm-10 col-form-label required">Youtube Video Link ID (Optional)</label>
                                                <input name="link" id="link" placeholder="Youtube Video Link ID" type="text" class="form-control  @if ($errors->has('link')) is-invalid @endif" >
                                                @if ($errors->has('link'))
                                                    <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('link') }}</em>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="position-relative form-group">
                                                <label for="exampleText" class="col-form-label required">Description</label>
                                                <textarea name="description" id="description" class="form-control @if ($errors->has('description')) is-invalid @endif" ></textarea>
                                                @if ($errors->has('description'))
                                                    <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('description') }}</em>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="position-relative form-group">
                                                <label for="exampleText" class="col-form-label required">Description [Arabic]</label>
                                                <textarea name="descriptionar" id="descriptionar" class="form-control @if ($errors->has('descriptionar')) is-invalid @endif" ></textarea>
                                                @if ($errors->has('descriptionar'))
                                                    <em id="firstname-error" class="error invalid-feedback">{{ $errors->first('descriptionar') }}</em>
                                                @endif
                                            </div>
                                        </div>
                            </div>
                            <div class="d-block text-right card-footer">
                                <button type="submit" class="btn-wide btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdn.ckeditor.com/4.14.0/standard-all/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script src="{{ url('admin/aetherupload/js/spark-md5.min.js') }}"></script>
<script src="{{ asset('admin/aetherupload/js/aetherupload.js') }}"></script>
<script type="text/javascript">

$(".uploadFile").change(function(){
  
  // $('#image_preview').html("");
  var $this = $(this);
  $this.hide();
  var total_file=document.getElementById("uploadFile").files.length;
  for(var i=0;i<total_file;i++)

  {
   var fileName = this.files[i].name;
   var divId = Math.floor((Math.random() * 100) + 1);
   $('#image_preview').append("<span class=\"pip\">" +
         "<span id='"+divId+"' class=\"remove\"></span>"+
         "<img height='200' width='300' src='"+URL.createObjectURL(event.target.files[i])+"'>" +
         "</span>");
         
//    var selectbox = '<div class='+divId+'><select name="materialList[]" class="form-control ct"><option value='+fileName+'>' + fileName + '</option> </select> <div class="form-control"><input type="number" min="1" name="materialOrder[]"><div>';
//    $('#selectOrder').append(selectbox);

  }
  
  $("#upload-form").append("<input type='file' class='file-input uploadFile' id='uploadMoreFile' accept='image/jpg, image/jpeg' name='files[]' multiple='multiple'>");

 $(".remove").click(function(){
   file = $(this).attr('id');
   $(this).parent(".pip").remove();
   $("."+file).remove();
 });

});

$(document).on('change','#uploadMoreFile',function(){
 var $this = $(this);
 $this.hide();
var total_file=document.getElementById("uploadMoreFile").files.length;
for(var i=0;i<total_file;i++)

  {
   var divId = Math.floor((Math.random() * 100) + 1);
   var fileName = this.files[i].name;
   $('#image_preview').append("<span class=\"pip\">" +
         "<span id='"+divId+"' class=\"remove\"></span>" +
         "<img height='200' width='300' src='"+URL.createObjectURL(event.target.files[i])+"'>" +
         "</span>");
//    var selectbox = '<div class='+divId+'><select name="materialList[]" class="form-control"><option value='+fileName+'>' + fileName + '</option> </select> <div class="form-control"><input type="number" min="1" name="materialOrder[]"></div></div>';
//    $('#selectOrder').append(selectbox);

  }
 $(".remove").click(function(){
   file = $(this).attr('id');
   $(this).parent(".pip").remove();
   $("."+file).remove();
 });
  $("#upload-form").append("<input type='file' class='file-input' id='uploadMoreFile' name='files[]' multiple='multiple'>");
 //  for(var i = 0 ; i < this.files.length ; i++){
 //   var fileName = this.files[i].name;
 //   var selectbox = '<select name="materialList[]" class="form-control"><option value='+fileName+'>' + fileName + '</option> </select> <div class="form-control"><input type="number" min="1" name="materialOrder[]"><div>';
 //   $('#selectOrder').append(selectbox);
 // }
});
CKEDITOR.config.toolbar = [
   ['Styles','Format','Font','FontSize'],
   '/',
   ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste'],
   '/',
   ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
   ['Flash','Smiley','TextColor','BGColor']
] ;
    CKEDITOR.replace( 'description' );
    CKEDITOR.replace( 'descriptionar' );
    $("#togBtn").on('change', function() {
        if ($(this).is(':checked')) {
            $(this).attr('value', '0');
            $(this).attr("checked",true);
            // alert($(this).val());
        }
        else {
           $(this).attr('value', '1');
           $(this).removeAttr('checked');
        //    alert($(this).val());
        }
    });
    $(document).on('change', '#category', function() {
        var cat_id =  $('#category').val();     // get id the value from the select
        $.ajax({
            url:"{{route('getSubcategory')}}",
            method:"get",
            data:{cat_id:cat_id},
            success:function(data)
            {
                // console.log(data);
                $('#subcategory').html(data);
            } 
        }) 
    });
</script> 
@endsection