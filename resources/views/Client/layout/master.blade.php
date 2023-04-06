<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{BASE_URL}}Clients/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{BASE_URL}}Clients/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{BASE_URL}}Clients/css/prettyPhoto.css" rel="stylesheet">
    <link href="{{BASE_URL}}Clients/css/price-range.css" rel="stylesheet">
    <link href="{{BASE_URL}}Clients/css/animate.css" rel="stylesheet">
	<link href="{{BASE_URL}}Clients/css/main.css" rel="stylesheet">
	<link href="{{BASE_URL}}Clients/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{BASE_URL}}Clients/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{BASE_URL}}Clients/{{BASE_URL}}Clients/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{BASE_URL}}Clients/{{BASE_URL}}Clients/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{BASE_URL}}Clients/{{BASE_URL}}Clients/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="{{BASE_URL}}Clients/{{BASE_URL}}Clients/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	@include('Client.layout.header')
	

    @yield('content')
	
	
	@include('Client.layout.footer')
	

  
    <script src="{{BASE_URL}}Clients/js/jquery.js"></script>
	<script src="{{BASE_URL}}Clients/js/bootstrap.min.js"></script>
	<script src="{{BASE_URL}}Clients/js/jquery.scrollUp.min.js"></script>
	<script src="{{BASE_URL}}Clients/js/price-range.js"></script>
    <script src="{{BASE_URL}}Clients/js/jquery.prettyPhoto.js"></script>
    <script src="{{BASE_URL}}Clients/js/main.js"></script>
</body>
</html>