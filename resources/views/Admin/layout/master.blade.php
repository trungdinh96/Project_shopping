<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
 
  <link rel="stylesheet" href="{{BASE_URL}}AdminLTE/plugins/fontawesome-free/css/all.min.css">
  

  <link rel="stylesheet" href="{{BASE_URL}}AdminLTE/dist/css/adminlte.min.css">
  @yield('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

   {{-- @include('Admin.layout.header') --}}

    @include('Admin.layout.sidebar')

  <div class="content-wrapper">
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('header_content')</h1>
          </div>
        </div>
      </div>
    </div>
   
    <div class="content">
      
      @yield('content')
    </div>
   
  </div>
  


 
  {{-- @include('Admin.layout.footer') --}}
</div>

<script src="{{BASE_URL}}AdminLTE/plugins/jquery/jquery.min.js"></script>

<script src="{{BASE_URL}}AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="{{BASE_URL}}AdminLTE/dist/js/adminlte.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@yield('js')
</body>
</html>
