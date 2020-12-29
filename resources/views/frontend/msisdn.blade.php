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
								<span class="service_name"> တရုတ်ဇာတ်ကားကောင်းများစွာကို စိတ်ကြိုက်ကြည့်ရှုနိုင်ပါသည်။ </span>
								<br>
								{{--<span class="service_name">တစ်ရက် ၉၉ ကျပ်</span>--}}
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
		                            <input id="phone" type="text" class="input-group-addon2" name="phone" placeholder="9*** *** ***" autofocus="" maxlength="10" style="border: solid 3px #0000ff;background:none;">
	                           </div>
	                            
	                           <button type="submit" class="btn lp_btn_success"><h5 style="color: white;font-weight: bold;">အတည်ပြုရန်</h5></button>
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
