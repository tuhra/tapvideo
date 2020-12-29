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
				<div class="clearfix"> </div>
			</div>
			<div class="content">
				<div style="padding: 1em 1.5em;">
			        <div class="row">
			            <div class="col-md-12 col-xs-12 cat-title">
			                <h4 class="captial"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i></a> <span>Search : "{{ $keyword }}"</span> </h4>
			            </div>
			        </div>
			    </div>

			    @include('frontend.slide')

				<!-- Movies By Category -->
				@if($vdos['body']['data'] != null)
					<div class="row welcome">
						<?php
							foreach ($vdos['body']['data'] as $vdo) {
						?>
						@if(!in_array($vdo['privacy']['view'], $validation))
							 <div class="col-md-2 col-xs-3 marginBot-30">
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
					            		<p style="color: #fff; font-size: 12px;">{{ preg_replace('/\s+/', '', $vdo['name']) }}</p>
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
					<div class="no-items"><center>Not search result.</center></div>
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


