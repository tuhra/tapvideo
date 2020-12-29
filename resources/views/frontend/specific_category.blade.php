@extends('frontend.layouts.master')
@section('content')
<body class="bg">
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
				<div class="login search_frame">
					<a href="#small-dialog2" class="sign-in popup-top-anim"><span class="glyphicon glyphicon-search"></span></a> 
					<!-- search modal -->
					<div id="small-dialog2" class="mfp-hide">
						<div class="login-modal"> 	
							<div class="booking-info">
								<center><img src="{{ asset('frontend/images/TapTubeLogo.png') }}" class="img-responsive" width=""></center>
							</div>
							<br><br>
							<div class="login-form">
								<div class="styled-input">
									<input type="text" name="searchtxt" required="" class="searchTerm" />
									<label>Search ...</label>
									<span></span>
								</div>
								<input type="submit" class="btn lp_btn_success searchButton" value="Search">
							</div> 
						</div>
					</div>
					<!-- // search modal --> 
				</div> 
				<div class="login">
					{{--<a href="#small-dialog" class="sign-in popup-top-anim"><span class="glyphicon glyphicon-user"></span></a> --}}
					<!-- login modal -->
					<div id="small-dialog" class="mfp-hide">
						<div class="login-modal"> 	
						 	<div class="profile col-md-12 col-sm-12 col-xs-12">
	                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
	                                <figure>
	                                    <div id="Profile"> 
	                                    	<img src="https://image.flaticon.com/icons/svg/236/236832.svg">
	                                    </div>
	                                </figure>
	                                <br>
	                                <span style="height: 7px;width: 7px;background-color: #00FF00;border-radius: 50%;display: inline-block;"></span><span style="color: #000;font-size: 11px;"> သင်သည်ဝန်ဆောင်မှုကိုရယူထားပြီးဖြစ်ပါသည်</span>
	                                <br><br>
	                                <div>
	                                	ဖုန်းနံပါတ် - {{ Session::get('msisdn') }} <br>
										နှစ်သက်သောဗွီဒီယို - {!! fav_vdo_count() !!} ခု
	                                </div>
	                                 
	                            </div>
	                        </div>
						</div>
					</div>
				</div> 
				{{--<div class="login">
					<a href="{{ url('logout') }}"><img src="{{ asset('frontend/images/logout-icon-nav.png') }}" class="padding"></a>
				</div>--}}
				<div class="clearfix"> </div>
			</div>
			<div class="content">
				<div style="padding: 1em 1.5em;">
			        <div class="row">
			            <div class="col-md-12 col-xs-12 cat-title">
			            	<?php $cat_name = '';?>
			            		@if($cat_id == '1193466')
						            <?php $cat_name = 'လူကြိုက်များသောဇာတ်လမ်းများ'; ?>
						            <center><img src="{{ asset('frontend/images/All.jpg') }}?operations&filters" class="img-responsive"></center>
						        @elseif($cat_id == '1212455')
						            <?php $cat_name = 'ဇာတ်လမ်းအသစ်များ'; ?>
						            <center><img src="{{ asset('frontend/images/New.jpg') }}?operations&filters" class="img-responsive"></center>
						        @elseif($cat_id == '1089181') 
						            <?php $cat_name = 'အတိုက်အခိုက်ဇာတ်လမ်းများ';  ?>
						            <center><img src="{{ asset('frontend/images/Action.jpg') }}?operations&filters" class="img-responsive"></center>
						        @elseif($cat_id == '1212453')
						            <?php $cat_name = 'ကလေးများအတွက်'; ?>
						            <center><img src="{{ asset('frontend/images/Kid.jpg') }}?operations&filters" class="img-responsive"></center>     
						        @endif
			                <h4 class="captial"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i></a> <span>{{ $cat_name }} </span> </h4>
			            </div>
			        </div>
			    </div>
				<br><br> 
				<!-- Movies By Category -->
				@if($vdos['body']['data'] != null)
					<div class="row welcome">
						<?php
							foreach ($vdos['body']['data'] as $vdo) {
						?>
							@if(!in_array($vdo['privacy']['view'], $validation))
							 <div class="col-md-2 col-xs-4 marginBot-30">
				            	<center>
				            		<a href="{{ $vdo['uri'] }}?myid_auth_password=taptubemyid@tech2020" class="cat">
				            			<?php
		                                    $vdo_id = explode("/", $vdo['uri']);
		                                    $vdo_id = end($vdo_id);
		                                ?>
		                                @if(is_file(public_path('upload/video_thumbnails/' . $vdo_id. '.jpg')))
		                                	<img src="{{ asset('upload/video_thumbnails/'.$vdo_id.'.jpg') }}" class="img-responsive" style="width:100%;">
		                                @else
		                                	<img src="{{ asset('frontend/images/video-thumbnail.png') }}" class="img-responsive" style="width:100%;">
		                                @endif    
					            		<!-- <img src="{{ $vdo['pictures']['sizes']['3']['link'] }}" class="img-responsive" style="margin-bottom: 10px;"> -->
					            		
					            		<p style="color: #fff; font-size: 12px;">{{ preg_replace('/\s+/', '', $vdo['name']) }}</p>
					            	 	<br>
					            	 </a>
			            	 	</center>
				            </div>
				           	@endif
						<?php		
							}
						?>	
					</div>
					@include('frontend.pagination');
				@else
					<div class="no-items"><center>Video is empty.</center></div>
				@endif
				 
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


