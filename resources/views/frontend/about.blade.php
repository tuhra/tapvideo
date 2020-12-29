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
					<a href="{{ url('welcome') }}"><img src="{{ asset('frontend/images/TapTubeLogoHeader.png') }}" class="img-responsive" width=""> </a>
				</div> 
				<div class="clearfix"> </div>
			</div>

			<div class="content">
				<center><img src="{{ asset('frontend/images/about-tap-tube-bg.png') }}" class="img-responsive"></center>
				<!-- //banner -->
				<div class="welcome"> 
					<h3 class="w3ls-title">App ရယူရန်</h3>
					<br>
					<div class="card text-center">
						<a href="#"><button type="button" class="btn store-btn"><h5><img src="{{ asset('frontend/images/googleplaystore.png') }}" width="25px;"> Google PLay</h5></button></a>						
					</div>
					<br>
					<div class="w3-text" style="padding: 10px;">
						<div class="row">
							<div class="col-xs-1 col-md-1 text-right"> 
								<img src="{{ asset('frontend/images/TapTubeLogo.png') }}" width="30px"> 
							</div>
							<div class="col-xs-11 col-md-11"> 
								TAP Tube ဆိုတာ တရုတ်ရုပ်ရှင်ဇာတ်လမ်းများကို အချိန်မရွေး နေရာမရွေး ကြည့်ရှုနိုင်တဲ့ 
								Website/ APP တစ်ခုဖြစ်ပါတယ်။ Internet ချိတ်ဆက်ထားသောဖုန်းများ၊ တက်ဘလက်များ စသည်ဖြင့် TAP Tube ဝန်ဆောင်မှုအတွက်မှတ်ပုံတင်တားတဲ့ ဖုန်းနံပါတ်ဖြင့် ငွေပေးချေပြီး တိုက်ရိုက်ကြည့်ရှုနိုင်ပါတယ်။
							</div>
						</div>
						<br><br>
						<div class="row">
							<div class="col-xs-1 col-md-1 text-right">
								<img src="{{ asset('frontend/images/all-movie-icon.png') }}" width="30px">
							</div>
							<div class="col-xs-11 col-md-11"> 
								တရုတ်နိုင်ငံမှ HD အရည်သွေးဖြင့်ဇာတ်ကားကောင်းများကို English / မြန်မာ စာတန်းထိုး နှစ်မျိုးစလုံး
								နှင့်ကြည့်ရှုနိုင်ပါသည်။ ဇာတ်လမ်းတွေကြည့်ရှုဖို့ ရွေးချယ်ရခက်နေပါသလား။ စိတ်လှုပ်ရှားစရာဇာတ်ကားကောင်းများအား အပါတ်စဉ်တင်ဆက်ပေးမှာဖြစ်ပါတယ်။ သင့်ကိုကြည့်ရှုဖို့
								သူငယ်ချင်းမှအကြံပေးသော ရုပ်ရှင်နာမည်ကိုမေ့နေပါသလား။ ကိစ္စမရှိပါဘူး။ သရုပ်ဆောင်နာမည်၊
								ဇာတ်လမ်းအမျိုးအစားအကြောင်းအရာ နည်းနည်းသိရုံဖြင့် ရှာဖွေလို့ရပါတယ်။ အက်ရှင်၊ ဒရာမာ၊ ဟာသ၊ အချစ်၊ သရဲကား၊ စစ်ကား အစရှိသော တရုတ်ရုပ်ရှင်အမျိုးအစားပေါင်းများစွာကို ကြည့်ရှုနိုင်ပါတယ်။
								<br><br>
								ရုပ်ရှင်တွေကိုကြည့်ရှုဖို့ APP အား Google Play Store မှ Download ဆွဲ၍သော်၎င်း၊ <a href="{{ url('/') }}">www.taptubemm.com</a>
								Website မှ ၎င်းဝန်ဆောင်မှုရယူပြီး <b>တစ်ရက် (၉၉) ကျပ်</b> ဖြင့် ကြည့်ရှုနိုင်မှာ ဖြစ်ပါတယ်။ 
							</div>
						</div>
					</div>
					<br> 
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


