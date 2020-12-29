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
				<center><img src="{{ asset('frontend/images/T-&-C-bg.png') }}" class="img-responsive"></center>
				<!-- //banner -->
				<div class="welcome"> <br>
					<h3 class="w3ls-title">“Tap Tube” ဝန်ဆောင်မှု ၏ စည်းမျဉ်းစည်းကမ်းများ</h3>
					<br><br>
					<p class="w3-text" style="text-align: left;">
						“Tap Tube” ဝန်ဆောင်မှုကိုအသုံးမပြုမီ ဤစည်းမျဉ်းစည်းကမ်းများကို ဖတ်ရှုနားလည်သိရှိထားရန်လို အပ်ပါသည်။        ဤစည်းမျဉ်းစည်းကမ်းများအရ   “Tap Tube ” ဝန်ဆောင်မှု ကို စီမံဆောင်ရွက်လျှက်ရှိပါသည်။ သင်သည် “Tap Tube” ဝန်ဆောင်မှု သို့ ဝင်ရောက်အသုံးပြုနေသူဖြစ်ပါက ဤစည်းမျဉ်းစည်းကမ်းများကို သဘောတူလက်ခံပြီးဖြစ်ကြောင်း အတည်ပြုပါသည်။  ဤစည်းမျဉ်း စည်းကမ်းများ၏ အကြောင်းအရာတစ်ခုခုကို လက်ခံသဘောတူညီမှုမရှိပါက Tap Tube” ဝန်ဆောင်မှု ကို အသုံးပြုနိုင်မည် မဟုတ်ပါ။  <br><br>

						<strong> User</strong> ကန့်သတ်ချက်<br><br>
						<strong>“Tap Tube”</strong> ဝန်ဆောင်မှုအား အသုံးပြုသူသည် အောက်ဖော်ပြပါ စည်းကမ်း သတ်မှတ်ချက်များကို သဘော တူညီမှုပြုလုပ်ရန်လိုအပ်ပါသည်။  <br><br>

						စည်းမျဉ်းစည်းကမ်းများကို ပြင်ဆင်ခြင်း<br><br>

						၁။   ။စည်းမျဉ်းစည်းကမ်းများကို လိုအပ်သည့်အချိန်၌ ပြင်ဆင်ခြင်း     သို့မဟုတ် ဖြည့်စွက်ခြင်း စသည်တို့အားလုပ်ပိုင်ခွင့်ရှိပါသည်။ ထိုဆောင်ရွက်မှုများ အကောင်အထည်ပေါ်လာပါက---- စည်းမျဉ်းစည်းကမ်း အသစ်များကို စတင်အသုံးမပြုမီ ၁၅ ရက်ခန့် ကြိုတင်၍ အကြောင်းကြားနိုင်ရန်ကြိုးစားပါမည်။  <br><br>

						၂။  	။“Tap Tube” ဝန်ဆောင်မှုကို အသုံးပြုနေသော သူများအတွက် အခါအားလျှော်စွာ ကျင်းပပြု လုပ်လေ့ ရှိသော Promotion များနှင့် အခြားသော Campaign များအတွက် လိုအပ်သောစည်းမျဉ်းစည်းများကို လိုအပ်သလို ထုတ်ပြန် ကြေငြာသွားမည်ဖြစ်ပြီး အငြင်းပွားမှုကိစ္စ အကြောင်းအရာ  တစ်စုံတစ်ရာ ရှိခဲ့ပါက      “My Tel” မှဆုံးဖြတ်ချက် အတိုင်းသာ သဘောတူ နားလည်ပြီး လိုက်နာဆောင်ရွက်ရမည်ကို သိရှိပြီးဖြစ်ပါသည်။   <br><br>

						အဖိုးအခ ကောက်ခံခြင်း <br><br>

						ဝန်ဆောင်မှုအသုံးပြုကာ ရုပ်ရှင်များ ကြည့်ရှုခြင်းအတွက် အခကြေးငွေ ကောက်ခံမည် မဟုတ်ပဲ လူကြီးမင်း၏ Mobile အင်တာနက် ဒေတာသုံးစွဲသည့်အဖိုးအခသာ ကျသင့်ပါမည်။                
						ကောက်ခံမှုအားလုံးတွင် ကုန်သွယ်ခွန် ၅% ပါဝင်မည်ကို သတိပြုပါ။ 
						အဆိုပါ စည်းကမ်းချက်များ သည် လူကြီးမင်းအနေဖြင့် TAP Tube ဝန်ဆောင်မှု သုံးစွဲခြင်းကိုရပ်တန့်သည့် အချိန်ထိ တရားဝင် တည်ရှိမည်ဖြစ်သည်။ <br><br>

						သဘောတူညီချက်ကာလ<br><br>

						ဤစည်းမျဉ်းစည်းကမ်းများသည် TAP Tube နှင့် My ID  သုံးစွဲသူကြား သဘောတူညီချက် ဖြစ်ပြီး MyTel မှ အချိန်မရွေး ပြုပြင်ပြောင်းလဲနိုင်သည်။ ဤသဘောတူညီချက်သည် Tap Tube စတင်အသုံးပြုသည့်နေ့မှစ၍ အကျုံးဝင်မည် ဖြစ်ပြီး မသုံးစွဲတော့သည်အထိတိုင် ဤစည်းကမ်းသတ်မှတ်ချက်များနှင့် အညီ လိုက်နာကျင့်သုံးရမည်ဖြစ်သည်။ <br><br>
					</p>
					<h3 class="w3ls-title">Terms and conditions of “Tap Tube” Service</h3><br><br>
					<p class="w3-text" style="text-align: left;">
						You should have known and agree the following Terms and Conditions (the “Terms”) before using Tap Tube Portal Service. The Chinese portal is being operated according to these terms and conditions. By taking service and using the application, you signify that you have read,
						understood, and agree to be bound by these Terms and Conditions and any other applicable rules, policies and terms associated therewith (collectively, the “Terms”).
						If you cannot accept and agree the Terms, you would not be able to use the application. <br><br>

						<strong>User Limitation</strong><br><br>
						If you would like to use “Tap Tube” service, you should have to follow and accept the following terms and conditions.<br><br>

						<strong>Amendment of Terms and Conditions</strong><br><br>

						1. We have the right for amendment and supplement of the Terms if it is necessary.If we would really need to carry out those actions, we would firstly inform all users 15 days in advance.<br><br>

						2. There will be occasional special promotions and campaigns for users and the necessary Terms for those promotions and campaigns will be announced in time. You properly should have known that if there were any argument concerned with those promotions and campaigns,
						only the decision of the application would be confirmed.<br><br>

						<stron>Charges</strong><br><br>
						There will be no charge for watching the movie by using TAP Tube and your mobile internet data will only be charged for this.
 						Please note that all collections will have 5% commercial tax.
						These terms will remain in effect until you stop using TAP Tube Services<br><br>

						<strong>The Agreement term</strong><br><br>
						These above rules are the agreement for the Tap Tube and My ID user and they can be changed at any time from MyTel Operator.						 
					</p>
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




