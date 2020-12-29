<!DOCTYPE html>
<html>
<head>
<title>TAP TUBE </title> 
<!-- For-Mobile-Apps-and-Meta-Tags -->
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- //For-Mobile-Apps-and-Meta-Tags -->
<!-- Custom Theme files -->
<link href="{{ asset('frontend/css/bootstrap.css') }}" type="text/css" rel="stylesheet" media="all">
<link href="{{ asset('frontend/css/style.css') }}" type="text/css" rel="stylesheet" media="all"> 
 
</head>

<body id="loading">
    <div class="agile-main"> 
        <div class="content-wrap">
            <div class="row">
                <div class="welcome contact-form">
                    <div class="col-md-4 col-md-offset-4">
                        <br><br>
                        <center><img src="{{ asset('frontend/images/TapTubeLogo.png') }}" class="img-responsive"></center>
                        <div class="contact-form" style="width: 100%;">
                            <center>
                                <h5 class="lpname"> TAP Tube Chinese Movies</h5> <br>
                            </center>
                        </div>
                        <input type="hidden" name="url" id="url" value="{{ $url }}">
                    </div>
                </div>
            </div>
        </div>
    </div> 
</body>
</html>

<script src="{{ asset('frontend/js/jquery-3.4.1.min.js') }}"></script>
<script>
    var url = document.getElementById("url").value;
    window.location.href = url;
</script>