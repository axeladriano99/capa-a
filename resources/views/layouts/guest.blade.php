<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<title>@yield('title')</title>
	<!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 10]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Favicon icon -->
	<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
	<!-- Google font-->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
	<!-- Required Fremwork -->
	<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bootstrap/css/bootstrap.min.css') }}">
	<!-- themify-icons line icon -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/themify-icons/themify-icons.css') }}">
	<!-- ico font -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/icofont/css/icofont.css') }}">
	<!-- Style.css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="fix-menu">
	<!-- Pre-loader start -->
	@include('layouts.preloader')
	<!-- Pre-loader end -->
	@yield('content')
	
	<!-- Warning Section Starts -->
	<!-- Older IE warning message -->
    <!--[if lt IE 10]>
    	<div class="ie-warning">
    		<h1>Warning!!</h1>
    		<p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    		<div class="iew-container">
    			<ul class="iew-download">
    				<li>
    					<a href="http://www.google.com/chrome/">
    						<img src="../files/assets/images/browser/chrome.png" alt="Chrome">
    						<div>Chrome</div>
    					</a>
    				</li>
    				<li>
    					<a href="https://www.mozilla.org/en-US/firefox/new/">
    						<img src="../files/assets/images/browser/firefox.png" alt="Firefox">
    						<div>Firefox</div>
    					</a>
    				</li>
    				<li>
    					<a href="http://www.opera.com">
    						<img src="../files/assets/images/browser/opera.png" alt="Opera">
    						<div>Opera</div>
    					</a>
    				</li>
    				<li>
    					<a href="https://www.apple.com/safari/">
    						<img src="../files/assets/images/browser/safari.png" alt="Safari">
    						<div>Safari</div>
    					</a>
    				</li>
    				<li>
    					<a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
    						<img src="../files/assets/images/browser/ie.png" alt="">
    						<div>IE (9 & above)</div>
    					</a>
    				</li>
    			</ul>
    		</div>
    		<p>Sorry for the inconvenience!</p>
    	</div>
    <![endif]-->
	<!-- Warning Section Ends -->
	<!-- Required Jquery -->
	<script type="text/javascript" src="{{ asset('bower_components/jquery/js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('bower_components/popper.js/js/popper.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('bower_components/bootstrap/js/bootstrap.min.js') }}"></script>
	<!-- jquery slimscroll js -->
	<script type="text/javascript" src="{{ asset('bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}"></script>
	<!-- modernizr js -->
	<script type="text/javascript" src="{{ asset('bower_components/modernizr/js/modernizr.js') }}"></script>
	<script type="text/javascript" src="{{ asset('bower_components/modernizr/js/css-scrollbars.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/common-pages.js') }}"></script>
</body>
</html>