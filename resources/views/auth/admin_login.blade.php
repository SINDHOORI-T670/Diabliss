<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from wowy.botble.com/admin/login by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Jan 2022 10:53:58 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Admin | Wowy</title>
<meta name="robots" content="noindex,follow" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="7a4J8B2RvrIk4F2mY5xzFMmB4Pup8aXSltQeU90R">
<meta property="og:image" content="{{ URL::asset('public/admin/storage/general/logo-light.png') }}">
<meta name="description" content="Copyright 2022 &amp;copy; Wowy. Version: 1.6.3">
<meta property="og:description" content="Copyright 2022 &amp;copy; Wowy. Version: 1.6.3">
<link rel="icon shortcut" href="{{ URL::asset('public/admin/storage/general/favicon-150x150.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('public/admin/vendor/core/core/base/libraries/font-awesome/css/fontawesome.mine4d0.css') }}">
<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('public/admin/vendor/core/core/base/libraries/pace/pace-theme-minimale4d0.css') }}">
<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('public/admin/vendor/core/core/base/libraries/toastr/toastr.mine4d0.css') }}">
<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('public/admin/vendor/core/core/base/css/coree4d0.css') }}">
<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('public/admin/vendor/core/plugins/language/css/languagee4d0.css') }}">
<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('public/admin/vendor/core/core/acl/css/animate.mine4d0.css') }}">
<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('public/admin/vendor/core/core/acl/css/logine4d0.css') }}">
<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('public/admin/vendor/core/core/base/css/themes/defaulte4d0.css') }}">
<script src="{{ URL::asset('public/admin/vendor/core/core/base/js/appe4d0.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/admin/vendor/core/core/base/libraries/bootstrap.bundle.mine4d0.js') }}" type="text/javascript"></script>
</head>
<body class=" login  " style=" background-image: url({{  URL::asset('public/admin/vendor/core/core/acl/images/backgrounds/3.jpg') }}); ">
<div class="container-fluid">
<div class="row">
<div class="faded-bg animated"></div>
<div class="hidden-xs col-sm-7 col-md-8">
<div class="clearfix">
<div class="col-sm-12 col-md-10 col-md-offset-2">
<div class="logo-title-container">
<div class="copy animated fadeIn">
<h1>Wowy</h1>
<p>Copyright 2022 © Wowy. Version: <span>1.6.3</span></p>
</div>
</div> 
</div>
</div>
</div>
<div class="col-xs-12 col-sm-5 col-md-4 login-sidebar">
<div class="login-container">
<p>Sign In Below:</p>
<form method="POST" action="https://wowy.botble.com/admin/login" accept-charset="UTF-8" class="login-form"><input name="_token" type="hidden" value="7a4J8B2RvrIk4F2mY5xzFMmB4Pup8aXSltQeU90R">
<div class="form-group mb-3" id="emailGroup">
<label>Email/Username</label>
<input class="form-control" placeholder="Email/Username" name="username" type="text" value="botble">
</div>
<div class="form-group mb-3" id="passwordGroup">
<label>Password</label>
<input class="form-control" placeholder="Password" name="password" type="password" value="159357">
</div>
<div>
<label>
<input checked="checked" name="remember" type="checkbox" value="1"> Remember me?
</label>
</div>
<br>
<button type="submit" class="btn btn-block login-button">
<span class="signin">Sign in</span>
</button>
<div class="clearfix"></div>
<br>
<p><a class="lost-pass-link" href="password/reset.html" title="Forgot Password">Lost your password?</a></p>
</form>
<div class="clearfix"></div>
</div> 
</div> 
</div> 
</div>
<script type="text/javascript">
    var BotbleVariables = BotbleVariables || {};

            BotbleVariables.languages = {
            notices_msg: {"create_success_message":"Created successfully","update_success_message":"Updated successfully","delete_success_message":"Deleted successfully","success_header":"Success!","error_header":"Error!","no_select":"Please select at least one record to perform this action!","processing_request":"We are processing your request.","error":"Error!","success":"Success!","info":"Info!","enum":{"validate_message":"The :attribute value you have entered is invalid."}},
        };
    </script>
<script src="{{ URL::asset('public/admin/vendor/core/core/base/libraries/respond.mine4d0.js" type="text/javascript') }}"></script>
<script src="{{ URL::asset('public/admin/vendor/core/core/base/libraries/excanvas.mine4d0.js" type="text/javascript') }}"></script>
<script src="{{ URL::asset('public/admin/vendor/core/core/base/libraries/ie8.fix.mine4d0.js" type="text/javascript') }}"></script>
<script src="{{ URL::asset('public/admin/vendor/core/core/base/libraries/modernizr/modernizr.mine4d0.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/admin/vendor/core/core/base/libraries/bootstrap-datepicker/js/bootstrap-datepicker.mine4d0.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/admin/vendor/core/core/base/js/coree4d0.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/admin/vendor/core/core/base/libraries/toastr/toastr.mine4d0.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/admin/vendor/core/core/base/libraries/pace/pace.mine4d0.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/admin/vendor/core/core/base/libraries/mcustom-scrollbar/jquery.mCustomScrollbare4d0.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/admin/vendor/core/core/base/libraries/stickytableheaders/jquery.stickytableheaderse4d0.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/admin/vendor/core/core/base/libraries/jquery-waypoints/jquery.waypoints.mine4d0.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/admin/vendor/core/core/base/libraries/spectrum/spectrume4d0.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/admin/vendor/core/core/base/libraries/jquery-validation/jquery.validate.mine4d0.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/admin/vendor/core/core/base/libraries/jquery-validation/additional-methods.mine4d0.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/admin/vendor/core/plugins/language/js/language-globale4d0.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/admin/vendor/core/core/acl/js/logine4d0.js') }}" type="text/javascript"></script>
<div id="stack-footer">
</div>
<script src="{{ URL::asset('public/admin/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js') }}" data-cf-settings="|49" defer=""></script></body>

<!-- Mirrored from wowy.botble.com/admin/login by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Jan 2022 10:54:15 GMT -->
</html>
