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
				<center><img src="{{ asset('frontend/images/help-feedback-background.png') }}" class="img-responsive"></center>
				<!-- //banner -->
				<div class="welcome"> 
					<h3 class="w3ls-title">ကူညီမှုနှင့်မှတ်ချက်ပေးရန်</h3>
					<br>
					<p class="w3-text">
						Tap Tube Chinese Movies အသုံးပြုရာတွင် တစ်စုံတစ်ရာ အဆင်မပြေမှုများ ဆွေးနွေးအကြံပြုလိုသည်များရှိပါက
						<br><br>
						Facebook Page: <br>
						<a href="http://shorturl.at/xQX16" target="_blank">Tap Tube Facebook Page</a><br><br> 
						Email: <br>
						<a href="mailto:taptube19@gmail.com">taptube19@gmail.com</a><br><br> 
						<br> 
						Phone Number : 09 409798349 သို့ရုံးချိန်အတွင်းဆက်သွယ်မေးမြန်းနိုင်ပါသည်။
						<br><br>
					</p>
					<br>
					
					<div class="contact-form">
						<h3 class="w3ls-title"> မက်ဆေ့ပို့ရန်</h3><br>

						@if (count($errors) > 0)
						    <div class="alert alert-danger">
						     	<button type="button" class="close" data-dismiss="alert">×</button>
						     	<ul style="list-style-type: none;">
						      		@foreach ($errors->all() as $error)
						       			<li>{{ $error }}</li>
						      		@endforeach
						     	</ul>
						    </div>
					   	@endif
					   	@if ($message = Session::get('success'))
					   		<div class="alert alert-success alert-block">
					    		<button type="button" class="close" data-dismiss="alert">×</button>
					           		<strong>{{ $message }}</strong>
					   		</div>
					   @endif
						<form action="{{url('sendmail')}}" method="post">
							{{ csrf_field() }}
							<input type="text" name="name" placeholder="အမည်" required="">
							<input type="text" name="email" placeholder="အီးမေးလ်လိပ်စာ" value="taptube19@gmail.com" readonly="">
							<input type="text" name="phone" placeholder="ဖုန်းနံပါတ်" required="">
							<input type="text" name="subject" placeholder="အကြောင်းအရာ" required="">
							<input type="text" name="message" placeholder="မက်ဆေ့" required="">
							<input type="submit" name="send" class="btn btn-info" value="ပို့ရန်">
						</form> 
					</div>

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



