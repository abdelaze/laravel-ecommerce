<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">



  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{url('design/admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('design/admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{url('design/admin/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
   <!-- I Should Call .min.css but i put some modification  -->
  @if(direction() == 'ltr')
  <link rel="stylesheet" href="{{url('/')}}/design/admin/dist/css/AdminLTE.min.css">

  <style>
  /*  I made This By My Self*/
    .box-body table input {
     width: 100%;
     padding: 3px;
     box-sizing: border-box;

    }
  </style>
  @else
   <link rel="stylesheet" href="{{url('/')}}/design/admin/dist/css/rtl/AdminLTE.min.css">
   <link rel="stylesheet" href="{{url('/')}}/design/admin/dist/css/rtl/bootstrap-rtl.min.css">
   <link rel="stylesheet" href="{{url('/')}}/design/admin/dist/css/rtl/rtl.css">
   <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
   <style>
   /*  I made This By My Self*/
     .box-body table input {
      width: 100%;
      padding: 3px;
      box-sizing: border-box;

     }

     html,body {

        font-family: 'Cairo', sans-serif;
     }

   </style>
  @endif

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{url('design/admin/dist/css/skins/_all-skins.min.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{url('design/admin/bower_components/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{url('design/admin/bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{url('design/admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{url('design/admin/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{url('design/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">


<script src="{{url('/design/admin/dist/js/myfunc.js')}}"></script>


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="{{url('design/admin/jstree/themes/default/style.css')}}">




</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
