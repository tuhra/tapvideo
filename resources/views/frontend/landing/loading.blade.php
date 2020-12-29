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
<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
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
                            <br><br><br><br><br><br><br><br><br>
                            <div class="loader">
                                <div class="bar1"></div>
                                <div class="bar2"></div>
                                <div class="bar3"></div>
                                <div class="bar4"></div>
                                <div class="bar5"></div>
                                <div class="bar6"></div>
                            </div>
                        </div>

                        <?php //dd($data['tranid']); ?>

                        <input type="hidden" name="tranid" id="tranid" class="loadingform" value="{{ $data['transID'] }}">
                        <input type="hidden" name="msisdn" id="msisdn" class="loadingform" value="{{ $data['MSISDN'] }}">
                        <input type="hidden" name="url" id="url" data-url="{{ url('/checkStatus') }}">

                    </div>
                </div>
            </div>
        </div>
    </div> 
</body>
</html>

<script src="{{ asset('frontend/js/jquery-3.4.1.min.js') }}"></script>
<script>
    $(function(){
        $(document).ready(function () {
            var redirectUrl = '';
            setTimeout(function () {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var url = $('#url').attr('data-url');
                var msisdn = $('#msisdn').val();
                var tranid = $('#tranid').val();
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, msisdn: msisdn, tranid: tranid},
                    dataType: 'JSON',
                    success: function (data) {
                        if ( parseInt(data.isNewUser) === 1 ) {
                            $('.pop-up').show();
                            redirectUrl = data.url;
                           // bonusList( data.bonus );
                        } else {
                            window.location.href = data.url;
                        }                     
                    }
                });
            }, 3000)
        })
    })
</script>







