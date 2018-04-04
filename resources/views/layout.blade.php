<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Godaddy @yield("page_title")</title>
    @yield("meta")

    <script>
        window.Laravel = { csrfToken: '{{ csrf_token() }}' }
    </script>
    <meta id="token" name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <link href="{{ asset("css/app.css") }}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container-fluid all-discover">
    @include("messages.error")
    @include("messages.success")
    @yield('content')
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- Custom js -->

@yield("js")

<script>
    //When click on any noty make it read
    {{--$('body').on('click', '.noti-message-link', function (e) {--}}
        {{--var link = $(this);--}}
        {{--$.ajax({--}}
            {{--async: false,--}}
            {{--type: "GET",--}}
            {{--url: base+'api/readNotifications?api_token='+localStorage.getItem("token"),--}}
        {{--}).done(function(data) {--}}
            {{--return false;--}}
            {{--window.location = link.attr('href');--}}
        {{--})--}}
    {{--});--}}
    {{--$( document ).ready(function() {--}}
        {{--$.ajax({--}}
            {{--url: url,--}}
            {{--type: 'HEAD',--}}
            {{--async: false,--}}
            {{--error: function () {--}}
                {{--if (sex == 'male') {--}}
                    {{--image = "uploads/users/profile_m.png";--}}
                {{--} else if (sex == 'female') {--}}
                    {{--image = "uploads/users/profile_f.png";--}}
                {{--}--}}
            {{--},--}}
            {{--success: function () {--}}
                {{--image = "/uploads/users/{{ Auth::user()->id }}/{{ Auth::user()->image }}";--}}
            {{--}--}}

        {{--});--}}
    {{--});--}}
</script>
</body>
</html>