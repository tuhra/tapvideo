@extends('frontend.layouts.master')
@section('content')
<body id="macgbg">
	<div class="agile-main"> 
		<div class="content-wrap">
			<div class="row">
				<div class="welcome otp">
					
					<div class="col-md-4 col-md-offset-4 ma-col">
						<center>
							<img src="{{ asset('frontend/images/TapTubeLogo.png') }}" class="img-responsive"> <br>
						 	<span class="service_name">မက်ဆေ့ရောက်ရှိလာသည့်တစ်ခါသုံးလျှို့ဝှက်နံပါတ်ကိုထည့်ပါ။</span>
						</center>
						<div id="wrapper">
                            <div id="dialog">
                            	{!! Form::open([
				                	'route' => 'frontend.otpValidation',
				                	'method' => 'POST'
				                ]) !!}
				                	<div class="notic_message">
				                        @include('frontend.messages.success')
				                        @include('frontend.messages.error')
				                    </div>                                
	                                <div id="form">
	                                  	<input type="text" maxLength="4" size="4" min="0" max="4" placeholder="****" autofocus="" name="otp" />
	                                  	<br><br> 
	                                </div>
	                                <center>
										<div class="card">
											<a href="{{ route('frontend.otpResent') }}"><button type="button" class="btn lp_btn_success"><h5 style="color: white;font-weight: bold;">ပြန်ပို့ရန်</h5></button></a> &nbsp;&nbsp; 
											<button type="submit" class="btn lp_btn_success"><h5 style="color: white;font-weight: bold;">အတည်ပြုရန်</h5></button>
										</div>
									</center>
								{!! Form::close() !!}
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div> 
</body>
@stop