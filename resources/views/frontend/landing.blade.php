@extends('frontend.layouts.master')
@section('content')
<body id="lpbody">
	<div class="agile-main"> 
		<div class="content-wrap">
			<div class="row">
				<div class="welcome">
					<div class="col-md-4 col-md-offset-4 col">
						<center><img src="{{ asset('frontend/images/TapTubeLogo.png') }}" class="img-responsive"></center>
						<div class="contact-form" style="width: 100%;">
							<form>
								<center>
									<h5 class="lpname"> TAP Tube Chinese Movies</h5> <br>
									<b>စိတ်ဝင်စားဖွယ် တရုတ်ဇာတ်ကားကောင်းများကို ကြည့်ရှုရန်  </b>
								</center>
								{{--<span class="service-btn"><b> နေ့စဉ်ဝန်ဆောင်မှု(၉၉)ကျပ် </b></span>--}}
								<br>
	                           	<a href="{{ route('frontend.subscribe') }}"><button type="button" class="btn lp_btn"><h5 style="color: #000;"><b>ဝန်ဆောင်မှုရယူရန်</b></h5></button></a>
							</form>
							<br>
							<center>
								<div class="card footer-card">
									<a href="{{ url('term-and-condition') }}" class="card-link" target="_blank">စည်းမျဉ်းစည်းကမ်းချက်များ</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="{{ url('faq') }}" class="card-link" target="_blank">မေးလေ့ရှိသောမေးခွန်းများ</a>
								</div>
							</center>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> 
</body>

@stop