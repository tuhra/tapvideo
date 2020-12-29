@extends('frontend.layouts.master')
@section('content')
<body class="bg">

	<div class="agile-main cover blur-in" id="overlay"> 
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
					<a href="#"><img src="{{ asset('frontend/images/TapTubeLogoHeader.png') }}" class="img-responsive" width=""> </a>
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
				<!-- Header Menu -->
				<div class="content-header"> 
					<span> <a href="#"> ပင်မစာမျက်နှာ </a></span>
					<span> <a href="{{ url('favourite') }}"> နှစ်သက်သော </a></span>
					<span> <a href="{{ url('category/1212453') }}"> ကလေးများအတွက် </a></span>
					<!-- <span> <a href="#"> ကိုယ်ပိုင် </a></span> -->
					{{--<span> <a href="{{ url('about') }}"> <b style="color: #21409a">Tap</b><b style="color: #f15a31"> Tube</b> အကြောင်း</a></span>--}}
				</div>
				@include('frontend.slide')

				<!-- Popular Movies -->
				@if($popular_vdos['body']['data'] != null)
				<div class="">					
					<div style="padding: 0.2em 1em;">
				        <div class="row">
				            <div class="col-md-9 col-xs-7">
				                <h4>လူကြိုက်များသောဇာတ်လမ်းများ</h4>
				            </div>
				            <div class="col-md-3 col-xs-5">
				                <!-- Controls -->
				                <div class="controls pull-right">
				                    <a href="{{ url('category/1193466') }}" class="right"> အားလုံးကြည့်မည်</a>
				                </div>
				            </div>
				        </div>
				    </div>

				    <div class="carousel-wrap">
					  	<div class="owl-carousel">	
							@foreach ($popular_vdos['body']['data'] as $popular_vdo)
								@if (!in_array($popular_vdo['privacy']['view'], $validation))
								    <div class="item">
    				            		<?php
    	                                    $array = explode("/", $popular_vdo['uri']);
    	                                    $vdo_id = end($array);
    	                                ?>
    									<a href="{{ url('videos/'. $vdo_id .'?myid_auth_password=taptubemyid@tech2020') }}" class="wht-txt">
    				            			@if(is_file(public_path('upload/video_thumbnails/' . $vdo_id. '.jpg')))
    		                                	<img src="{{ asset('upload/video_thumbnails/'.$vdo_id.'.jpg') }}" class="img-responsive" style="width:120%;">
    		                                @else
    		                                	<img src="{{ asset('frontend/images/video-thumbnail.png') }}" class="img-responsive" style="width:120%;">
    		                                @endif
    		                            	<!-- {{ $popular_vdo['name'] }} -->
    				            			<p style="color: #fff; font-size: 12px;">{{ preg_replace('/\s+/', '', $popular_vdo['name']) }}</p>
    					            	 	<br>
    					            	</a>
    					            </div>
								@endif
							@endforeach
					  	</div>
					</div>
				</div>
				@endif
				<br> 
				<!-- New Movies -->
				@if($new_vdos['body']['data'] != null)
				<div class="">					
					<div style="padding: 0.2em 1em;">
				        <div class="row">
				            <div class="col-md-9 col-xs-7">
				                <h4>ဇာတ်လမ်းအသစ်များ</h4>
				            </div>
				            <div class="col-md-3 col-xs-5">
				                <!-- Controls -->
				                <div class="controls pull-right">
				                    <a href="{{ url('category/1212455') }}" class="right"> အားလုံးကြည့်မည်</a>
				                </div>
				            </div>
				        </div>
				    </div>
			        <div class="carousel-wrap">
					  	<div class="owl-carousel">
					  		@foreach ($new_vdos['body']['data'] as $new_vdo)
					  			@if (!in_array($new_vdo['privacy']['view'], $validation))					
								<div class="item">
			            		<?php
                                    $array = explode("/", $new_vdo['uri']);
                                    $vdo_id = end($array);
                                ?>
									<a href="{{ url('videos/'. $vdo_id .'?myid_auth_password=taptubemyid@tech2020') }}" class="wht-txt">
				            			@if(is_file(public_path('upload/video_thumbnails/' . $vdo_id. '.jpg')))
		                                	<img src="{{ asset('upload/video_thumbnails/'.$vdo_id.'.jpg') }}" class="img-responsive" style="width:100%;">
		                                @else
		                                	<img src="{{ asset('frontend/images/video-thumbnail.png') }}" class="img-responsive" style="width:100%;">
		                                @endif
				            			<!-- {{ $new_vdo['name'] }} -->
				            			<p style="color: #fff; font-size: 12px;">{{ preg_replace('/\s+/', '', $new_vdo['name']) }}</p>
					            	 	<br>
					            	</a>
					            </div>
					            @endif
							@endforeach
					  	</div>
					</div> 
				</div>
				@endif
				<br>
				<!-- All Movies -->
				@if($vdos['body']['data'] != null)
				<div class="">					
					<div style="padding: 0.2em 1em;">
				        <div class="row">
				            <div class="col-md-9 col-xs-7">
				                <h4>ဇာတ်လမ်းအားလုံး</h4>
				            </div>
				            <div class="col-md-3 col-xs-5">
				                <!-- Controls -->
				                <div class="controls pull-right">
				                    <a href="{{ url('category') }}" class="right"> အားလုံးကြည့်မည်</a>
				                </div>
				            </div>
				        </div>
				    </div>
			        <div class="carousel-wrap">
					  	<div class="owl-carousel">
					  		@foreach ($vdos['body']['data'] as $vdo)
					  			@if (!in_array($vdo['privacy']['view'], $validation))							
								<div class="item">
				            		<?php
	                                    $array = explode("/", $vdo['uri']);
	                                    $vdo_id = end($array);
	                                ?>
									<a href="{{ url('videos/'. $vdo_id .'?myid_auth_password=taptubemyid@tech2020') }}" class="wht-txt">
					            		<?php
		                                    $vimeo_uri = 'http://player.vimeo.com'.$vdo['uri'];
		                                    $array = explode("/", $vimeo_uri);
		                                    $vdo_id = end($array);
		                                ?>
				            			@if(is_file(public_path('upload/video_thumbnails/' . $vdo_id. '.jpg')))
		                                	<img src="{{ asset('upload/video_thumbnails/'.$vdo_id.'.jpg') }}" class="img-responsive" style="width:100%;">
		                                @else
		                                	<img src="{{ asset('frontend/images/video-thumbnail.png') }}" class="img-responsive" style="width:100%;">
		                                @endif
				            			<!-- {{ $vdo['name']}} -->
				            			<p style="color: #fff; font-size: 12px;">{{ preg_replace('/\s+/', '', $vdo['name']) }}</p>
					            	 	<br>
					            	</a>
					            </div>
					           	@endif
							@endforeach
					  	</div>
					</div>
				</div>
				@endif
				<br>
				<!-- Action Movies -->
				@if($action_vdos['body']['data'] != null)
				<div class="">					
					<div style="padding: 0.2em 1em;">
				        <div class="row">
				            <div class="col-md-9 col-xs-7">
				                <h4>အတိုက်အခိုက်ဇာတ်လမ်းများ</h4>
				            </div>
				            <div class="col-md-3 col-xs-5">
				                <!-- Controls -->
				                <div class="controls pull-right">
				                    <a href="{{ url('category/1089181') }}" class="right"> အားလုံးကြည့်မည်</a>
				                </div>
				            </div>
				        </div>
				    </div>
			        <div class="carousel-wrap">
					  	<div class="owl-carousel">
					  		@foreach ($action_vdos['body']['data'] as $action_vdo)	
					  			@if (!in_array($action_vdo['privacy']['view'], $validation))						
								<div class="item">
				            		<?php
	                                    $array = explode("/", $action_vdo['uri']);
	                                    $vdo_id = end($array);
	                                ?>
									<a href="{{ url('videos/'. $vdo_id .'?myid_auth_password=taptubemyid@tech2020') }}" class="wht-txt">
				            			@if(is_file(public_path('upload/video_thumbnails/' . $vdo_id. '.jpg')))
		                                	<img src="{{ asset('upload/video_thumbnails/'.$vdo_id.'.jpg') }}" class="img-responsive" style="width:100%;">
		                                @else
		                                	<img src="{{ asset('frontend/images/video-thumbnail.png') }}" class="img-responsive" style="width:100%;">
		                                @endif
				            			<!-- {{ $action_vdo['name'] }} -->
				            			<p style="color: #fff; font-size: 12px;">{{ preg_replace('/\s+/', '', $action_vdo['name']) }}</p>
					            	 	<br>
					            	</a>
					            </div>
					            @endif
							@endforeach
					  	</div>
					</div> 
				</div>
				@endif
				<br>
				<!-- Kids Movies -->
				@if($kid_vdos['body']['data'] != null)
				<div class="">					
					<div style="padding: 0.2em 1em;">
				        <div class="row">
				            <div class="col-md-9 col-xs-7">
				                <h4>ကလေးများအတွက်</h4>
				            </div>
				            <div class="col-md-3 col-xs-5">
				                <!-- Controls -->
				                <div class="controls pull-right">
				                    <a href="{{ url('category/1212453') }}" class="right"> အားလုံးကြည့်မည်</a>
				                </div>
				            </div>
				        </div>
				    </div>
			        <div class="carousel-wrap">
					  	<div class="owl-carousel">
					  		@foreach ($kid_vdos['body']['data'] as $kid_vdo)
					  			@if (!in_array($kid_vdo['privacy']['view'], $validation))					
								<div class="item">
				            		<?php
	                                    $array = explode("/", $kid_vdo['uri']);
	                                    $vdo_id = end($array);
	                                ?>
									<a href="{{ url('videos/'. $vdo_id .'?myid_auth_password=taptubemyid@tech2020') }}" class="wht-txt">
				            			@if(is_file(public_path('upload/video_thumbnails/' . $vdo_id. '.jpg')))
		                                	<img src="{{ asset('upload/video_thumbnails/'.$vdo_id.'.jpg') }}" class="img-responsive" style="width:100%;">
		                                @else
		                                	<img src="{{ asset('frontend/images/video-thumbnail.png') }}" class="img-responsive" style="width:100%;">
		                                @endif
				            			<!-- {{ $kid_vdo['name'] }} -->
				            			<p style="color: #fff; font-size: 12px;">{{ preg_replace('/\s+/', '', $kid_vdo['name']) }}</p>
					            	 	<br>
					            	</a>
					            </div>
					            @endif
							@endforeach
					  	</div>
					</div> 
				</div>
				@endif
				<br>
				<!-- Favorite Movies -->
				@if($favourite_vdos != null)
				<div class="">					
					<div style="padding: 0.2em 1em;">
				        <div class="row">
				            <div class="col-md-9 col-xs-7">
				                <h4>Recent Play</h4>
				            </div>
				            <div class="col-md-3 col-xs-5">
				                <!-- Controls -->
				                <div class="controls pull-right">
				                    <a href="{{ url('favourite') }}" class="right"> အားလုံးကြည့်မည်</a>
				                </div>
				            </div>
				        </div>
				    </div>
			        <div class="carousel-wrap">
					  	<div class="owl-carousel">
					  		@foreach($favourite_vdos as $fv)
								<div class="item">
				            		<?php
	                                    $array = explode("/", $fv->video_uri);
	                                    $vdo_id = end($array);
	                                ?>
									<a href="{{ url('videos/'. $vdo_id .'?myid_auth_password=taptubemyid@tech2020') }}" class="wht-txt">
    		            			@if(is_file(public_path('upload/video_thumbnails/' . $vdo_id. '.jpg')))
                                    	<img src="{{ asset('upload/video_thumbnails/'.$vdo_id.'.jpg') }}" class="img-responsive" style="width:100%;">
                                    @else
                                    	<img src="{{ asset('frontend/images/video-thumbnail.png') }}" class="img-responsive" style="width:100%;">
                                    @endif
                        			
                                    <!-- {{ videoName($fv->video_id) }} -->
                                    <?php
                                    	$video = videoName($fv->video_id);
                                    ?>
                                    <p style="color: #fff; font-size: 12px;">{{ preg_replace('/\s+/', '', $video) }}</p>
					            	<br>
					            	</a>
					            </div>
					  		@endforeach
					  	</div>
					</div> 
				</div>
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


