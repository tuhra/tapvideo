@extends('frontend.layouts.master')
@section('content')
<body>
	<div class="agile-main" id="top"> 
		<div class="menu-wrap" id="style-1"> 
			@include('frontend.layouts.nav')
			<button class="close-button" id="close-button">C</button>
		</div> 
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="video">
            <iframe src="{{ asset('video/guide.mp4') }}" width="100%" height="315" frameborder="0" allowfullscreen></iframe>
        </div>
        &nbsp;&nbsp;&nbsp;
        <div class="col-md-12 col-lg-12 col-xs-12">
        	<span style="color: #000;">ရုပ်ရှင်အား ‌ဒေါင်းလော့ဆွဲရန် အောက်မှခလုတ်လေးကို နှိပ်ပေးပါ...</span>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 20px;">
        	<?php
        	    if (isset($download)) {
        	        $link = $download->download_link;
        	    } else {
        	        $link = 'download link not found';
        	    }
        	?>
            <br>
            <center>
        	   <a href="#" id="download" class="btn btn-info">Copy Link</a>
        	   <input type="text" id="video_url" value="{{ $link }}" style="display: none;">
            </center>
        </div>
        <div class="col-md-12 col-lg-12 col-xs-12" style="background-color: #bfc8d6;">
            <center>
                <img src="{{ asset('frontend/images/noti1.png') }}" class="img-responsive img-fluid">
            </center><br>
        	<p style="color: #000;">အပေါ်မှာပြထားသည့်အတိုင်း Box လေးတစ်ခုကျလာလျှင်ဒေါင်းလော့လင့်ကို  ကူးယူပြီးပါပြီ...</p><br>
        	<p style="color: #000;">သင်က I Phone သုံးတယ်ဆိုရင် "Safari" (သို့မဟုတ်) Android ဖုန်းသုံးတယ်ဆိုရင် Browser မှာ Paste လုပ်ရပါမယ်...</p>
        </div><br><br>
        <div class="col-md-12 col-lg-12 col-xs-12" style="margin-top: 100px; margin-bottom: 50px;">
        	<center>
        	<img src="{{ asset('frontend/images/url.jpeg') }}" class="img-fluid img-responsive" id="flim">
        	</center>
        </div><br><br>
        <div class="col-md-12 col-lg-12 col-xs-12">
        	<p style="color: #000;">Browser ထည်းမှာအဖြူတန်းလေးကိုဖိပြီး Paste လုပ်လို့ရပါတယ်...</p><br>
        	<p style="color: #000;">Paste လုပ်လိုက်သည်နှင့်ရုပ်ရှင်ကားကို ဒေါင်းလော့ဆွဲသွားမှာဖြစ်ပါတယ်။ ဒေါင်းလော့ဆွဲထားသောရုပ်ရှင်ကားများကို သင့်ဖုန်း Gallery ထည်းတွင် ကြည့်ရှုနိုင်ပါပြီ...</p><br>
        	<p style="color: #000;">ဇာတ်လမ်း အသစ်အသစ်တွေကို အချိန်နှင့်တပြေးညီကြည့်ရှုနိုင်ဖို့ Tap Tube ရဲ့ Facebook Page လေးကို Like, see first လုပ်ထားဖို့ဝောာ့လိုမယ်နော်...</p>
        </div>
        <div class="col-md-12 col-lg-12 col-xs-12" style="background-color: #bfc8d6;">
            <br>
        	<p style="color: #000;">လင့်ကိုနှိပ်ပီး Tap Tube ရဲ့ Facebook Page ကိုသွားပါ။</p><br>
            <center>
        	   <a href="https://www.facebook.com/pages/category/Movie/TAP-Tube-119936726069598/" target="blank">TAP TUBE Facebook Page</a>
            </center>
            &nbsp;&nbsp;&nbsp;
        </div><br><br>	
	</div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@1/dist/clipboard.min.js"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/download.js' )}}"></script>
@stop



