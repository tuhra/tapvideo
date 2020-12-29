@extends('frontend.layouts.master')
@section('content')
<body class="bg">
<body>
	<div class="agile-main"> 
		<div class="menu-wrap" id="style-1"> 
			@include('frontend.layouts.nav')
			<button class="close-button" id="close-button">C</button>
		</div>
		<div class="content-wrap">
			<div class="header"> 
				<div class="menu-icon">   
					<button class="menu-button" id="open-button">O</button>
				</div>
				<div class="logo">
					<a href="{{ url('welcome?myid_auth_password=taptubemyid@tech2020') }}"><img src="{{ asset('frontend/images/TapTubeLogoHeader.png') }}" class="img-responsive" width=""> </a>
				</div>
				<div class="clearfix"> </div>
			</div>

			<div class="content">
				<!-- banner -->
				<!-- <div class="banner about-banner"> 
					<div class="banner-img">  
						<h3>About Us</h3>   
					</div> 
				</div> -->
				<center><img src="{{ asset('frontend/images/FAQ-background.png') }}" class="img-responsive"></center>
				<!-- //banner -->
				<div class="welcome"> 
					<h3 class="w3ls-title">မေးလေ့ရှိသောမေးခွန်းများ</h3>
					<br><br>
					<p class="w3-text">
						<strong> Q.Tap Tube ဆိုတာဘာလဲ? </strong> <br>
						A. တရုတ်နိုင်ငံမှ အမျိုးအစားစုံလင်သော Movies များကို တစ်နေရာတည်းတွင် စုစည်းကြည့်ရှုနိုင်သော Website တစ်ခုဖြစ်ပါတယ်။ 
						<br><br>
						<strong> Q. Tap Tube ကို ဘယ်လိုမျိုးမှတစ်ဆင့် ရယူနိုင်မှာလဲ?  </strong><br>
						A. Tap Tube ကို MyTel sim card အသုံးပြု ပီး MyID Application သို့ဝင်ရောက်ကာ free ရယူ နိုင်ပါသည်။
						<br><br>
						<strong> Q. Charges က ဘယ်လိုကောက်ခံမှာလဲ?  </strong><br>
						A. Tap Tube မှ ဗွီဒီယိုဖိုင်များကို   My ID မှတစ်ဆင့် Free ဝင်ရောက်ကြည့်ရှု နိုင်မည် ဖြစ်ပီး အင်တာနက် အသုံးပြုမှု အတွက် ဒေတာ အဖိုးခသာ ကောက်ခံမည် ဖြစ်ပါသည်။ 
						<br><br>
						<strong> Q. Wifi ဖြင့် ဗွီဒီယိုဖိုင်ကို ကြည့်ရှုနိုင်မှာလား? </strong><br>
						A. Wifi ဖြင့်လည်း ဗွီဒီယိုဖိုင်များကို ကြည့်ရှုနိုင်မှာဖြစ်ပါတယ်။ 
						<br><br>
						<strong> Q. ဗွီဒီယိုဖိုင်က ဘယ်လိုအမျိုးအစားတွေပါဝင်မှာလဲ?  </strong><br>
						A. Action , Drama, Comedy, Horror, Adventure, Romance, Kids Movies အစရှိသော Movies များစွာပါရှိပါတယ်။ 
						<br><br>
						<strong> Q. Movie ရဲ့အရည်အသွေးက ဘယ်လိုမျိုးလဲ?    </strong><br>
						A. သင့်၏ Phone ၊ Tablet ဖြင့်အဆင်ပြေ ချောမွေ့စေရန် အကောင်းဆုံးသောသင်လျော်သည့်အရည်သွေးရှိ Movie ဖိုင်များကို တင်ဆက်ပေးမှာဖြစ်ပါတယ်။
					</p><br><br>
					<h3 class="w3ls-title">Frequently Asked Questions</h3><br><br>
					<p class="w3-text">
						<strong> Q. What is Tap Tube? </strong><br>
						A. The Tap Tube is you can see the film perfectly China.
						<br><br>
						<strong> Q: How can I get the service?</strong><br>
						A: You can get the service freely by using MyID application.
						<br><br>
						<strong> Q. How can I pay for service fees? </strong><br>
						A: You only need to pay data charges for using Mobile data , not for service. Service can be get freely by customer. 
						<br><br>
						<strong> Q. Can I watch all videos with Wi-Fi?</strong><br>
						A: Yes, the user can watch all videos with Wi-Fi.
						<br><br>
					</p><br>					 
				</div>				 
				<!-- footer -->
				<div class="w3agile footer"> 
					<div class="footer-text">
						<p> TAP TUBE &copy; 2020  . All Rights Reserved.</p>
					</div>
				</div> 
			</div>
		</div>
	</div> 
</body>
@stop

