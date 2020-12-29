<nav class="top-nav">
	<ul class="icon-list">
		<li class="menu-title"><img src="{{ asset('frontend/images/TapTubeLogo.png') }}" class="img-responsive"> 
			<img src="{{ asset('frontend/images/navi-menu-bg.png') }}" class="img-responsive" width="100%"></li>
		<li><a class="active" href="{{ url('welcome') }}?myid_auth_password=taptubemyid@tech2020">
			<img src="{{ asset('frontend/images/home-icon.png') }}"> ပင်မစာမျက်နှာ </a></li>
		<li><a href="{{ url('favourite') }}"> 
			<img src="{{ asset('frontend/images/favourite-icon.png') }}"> နှစ်သက်သော </a></li>
		<li><a href="#" class="menu"> 
			<img src="{{ asset('frontend/images/all-movie-icon.png') }}"> ဇာတ်လမ်းအားလုံး<span class="glyphicon glyphicon-menu-down"></span></a>
			<ul class="nav-sub">
				<li><a href="{{ url('category/1193466') }}" class=""><span class="glyphicon glyphicon-play-circle"></span> လူကြိုက်များသောဇာတ်လမ်းများ</a></li>
				<li><a href="{{ url('category/1212455') }}" class=""><span class="glyphicon glyphicon-play-circle"></span> ဇာတ်လမ်းအသစ်များ</a></li> 
				<li><a href="{{ url('category/1089181') }}" class=""><span class="glyphicon glyphicon-play-circle"></span> အတိုက်အခိုက်ဇာတ်လမ်းများ</a></li> 
				<li><a href="{{ url('category/1212453') }}" class=""><span class="glyphicon glyphicon-play-circle"></span> ကလေးများအတွက်</a></li>
			</ul>
			<div class="clearfix"> </div>
			<script>
				$( "li a.menu" ).click(function() {
					$( "ul.nav-sub" ).slideToggle( 300, function() {
					// Animation complete.
					});
				});
			</script> 
		</li>
		<!-- <li><a href="#"> <img src="{{ asset('frontend/images/download-icon.png') }}"> ကိုယ်ပိုင် </a></li> -->
		<li><a href="{{ url('faq') }}"> 
			<img src="{{ asset('frontend/images/FAQ-Icon.png') }}"> မေးလေ့ရှိသောမေးခွန်းများ </a></li>
		<li><a href="{{ url('term-and-condition') }}"> 
			<img src="{{ asset('frontend/images/teams-and-conditions.png') }}"> စည်းမျဉ်းသတ်မှတ်ချက်များ </a></li>
		<li><a href="{{ url('help') }}"> 
			<img src="{{ asset('frontend/images/Help-&-Feedback-icon.png') }}"> ကူညီမှုနှင့်မှတ်ချက်ပေးရန်</a></li>
	</ul>
</nav>