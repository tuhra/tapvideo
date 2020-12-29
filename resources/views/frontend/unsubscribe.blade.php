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
					<a href="{{ url('welcome') }}"><img src="{{ asset('frontend/images/TapTubeLogoHeader.png') }}" class="img-responsive" width=""> </a>
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
					<a href="#small-dialog" class="sign-in popup-top-anim"><span class="glyphicon glyphicon-user"></span></a> 
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
				<!-- banner -->
				<!-- <div class="banner about-banner"> 
					<div class="banner-img">  
						<h3>About Us</h3>   
					</div> 
				</div> -->
				<center><img src="{{ asset('frontend/images/logout-background.png') }}" class="img-responsive"></center>
				<!-- //banner -->
				<div class="welcome"> 
					 
					<br>
					<p class="w3-text text-center">
						<strong> Phone Number : <a>{{ $msisdn }}</a></strong> <br>
						<strong> ဝန်ဆောင်မှုရယူခြင်း - <a>နေ့စဉ်ဝန်ဆောင်မှု</a></strong>
					</p>
					<br><br><br>
					 <div class="contact-form"> 
					 	<?php $is_not_enough = check_is_enough(); ?>
    					@if(TRUE != $is_not_enough)
							<button type="button" class="btn unscribe_btn" id="myBtn"><h5 style="color: red;font-weight: bold;">ဝန်ဆောင်မှုအားရပ်ဆိုင်းရန်</h5></button>
						@endif
					</div>
				</div>
				 
				<!-- footer -->
				<div class="w3agile footer"> 
					<div class="footer-text">
						<p> TAP TUBE &copy; 2020  . All Rights Reserved.</p>
					</div>
				</div>

				<!-- Alert Message -->
				<!-- The Modal -->
	            <div id="myModal" class="modal">
	              	<!-- Modal content -->
	              	<div class="popup">
	              		<div class="box">
	              			<div>
			                    <center>
			                        TAP Tube Chinese Movies <br>ဝန်ဆောင်မှုအားရပ်တန့်မည်မှာသေချာပါသလား
			                        <br><br>
			                        {!! Form::open([
					            		'route' => 'frontend.postUnsubscribe',
					             		'method' => 'POST'
					        		]) !!}
			                       		<button type="submit" class="btn logout_btn close-button" id="" value="">သေချာပါသည် </button>
			                       		<button type="button" class="btn logout_btn close-button close1" id="" value="">မသေချာပါ </button>
			                       	{!! Form::close() !!}
			                        	<br> 
			                    </center>
			                </div>
		                </div>
	              	</div>
	            </div>
	            <script>
                var modal = document.getElementById("myModal");
                var btn = document.getElementById("myBtn");
                var span = document.getElementsByClassName("close1")[0];
                btn.onclick = function() {
                  modal.style.display = "block";
                }
                span.onclick = function() {
                  modal.style.display = "none";
                }
                window.onclick = function(event) {
                  if (event.target == modal) {
                    modal.style.display = "none";
                  }
                }
            </script>
			</div>
		</div>
	</div>
</body>
@stop


