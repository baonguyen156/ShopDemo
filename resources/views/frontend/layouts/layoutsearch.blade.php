<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home | E-Shopper</title>
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
	<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('rate/js/jquery-1.9.1.min.js') }}"></script>
    <link  rel="stylesheet" href="{{ asset('rate/css/rate.css') }}">
    <!-- <style>
        .rate .ratings_stars{
            height:     15px;
            width:      16px;
            background: "{{asset('rate/images/200/start2.png')}}" no-repeat;
            background-size: 16px;
            float: left !important;
            margin-right: 4px;
        }
        .rate .ratings_over {
            background: "{{asset('rate/images/200/start-active2.png')}}" no-repeat;
            background-size: 16px;
        }
        .rate .ratings_hover {
            background: "{{asset('rate/images/200/start-hover2.png')}}" no-repeat;
            background-size: 16px;
        }
        .rate .vote{
            display: inline-block;
        }
        .rate .rate-np {
            font-size: 12px;
            color: #c89805;
            display: inline-block;
            margin-left: 3px;
            font-weight: bold;
            margin-top:0px;
            vertical-align: top;
        }
    </style> -->
    <meta id="viewport" name="viewport" content="" />
    <script>
        if(screen.width <= 736){
            document.getElementById("viewport").setAttribute("content", "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no");
        }
    </script>
</head>
<body>
    @include('frontend.layouts.header')

    <section>
        <div class="container">
            <div class="row">
                @include('frontend.layouts.menu-left')

                <div class="col-sm-9">
                    @yield('content')
                </div>
            </div>      
        </div>
    </section>

    @include('frontend.layouts.footer')
    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
	<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ asset('frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
		    $("a[rel^='prettyPhoto']").prettyPhoto();
		});
    </script>
</body>
</html>