@extends('frontend.layouts.master')
@section('content')
<body id="macgbg">
	<div class="agile-main"> 
		<div class="content-wrap">
			<div class="row">
				<div class="welcome">
					<div class="col-md-4 col-md-offset-4 ma-col">
						<center><img src="{{ asset('frontend/images/TapTubeLogo.png') }}" class="img-responsive"></center>
						<div class="contact-form" style="width: 95%;">
							<br>						
							<center>
								<span class="service_name"> TAP Tube ဝန်ဆောင်မှုရယူရန်သင်၏ဖုန်းနံပါတ်အား ရိုက်ထည့်ပြီး အတည်ပြုရန်ကိုနှိပ်ပါ။ </span>
							</center>
							<br>

							<div class="notic_message">
		                        @include('frontend.messages.success')
		                        @include('frontend.messages.error')
		                    </div>

							{!! Form::open([
			                'route' => 'frontend.postMsisdn',
			                'method' => 'POST'
			                ]) !!}
								<div class="input-group-login">
		                            <span value="95" id="" class="input-group-addon1">+95</span> 
		                            <input id="phone" type="text" class="input-group-addon2" name="phone" placeholder="9*** *** ***" autofocus="" maxlength="10">
	                           </div>
	                            
	                           <button type="submin" class="btn lp_btn_success"><h5 style="color: white;font-weight: bold;">အတည်ပြုရန်</h5></button>
	                       	{!! Form::close() !!}

							<br><br><br>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> 
</body>
@stop
