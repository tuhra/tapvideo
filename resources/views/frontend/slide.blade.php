<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
	  	<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
	    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
	    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
	    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
	    <li data-target="#carousel-example-generic" data-slide-to="4"></li>
	    <li data-target="#carousel-example-generic" data-slide-to="5"></li>
	    <li data-target="#carousel-example-generic" data-slide-to="6"></li>

	    {{-- @for ($i=0; $i < $slider_count; $i++) 
	    	@if(0 == $i)
	    		<li data-target="#carousel-example-generic" data-slide-to="{{$i}}" class="active"></li>
	    	@else
	    		<li data-target="#carousel-example-generic" data-slide-to="{{$i}}"></li>
	    	@endif
	    @endfor --}}

	</ol>
	<!-- Wrapper for slides -->
	<div class="carousel-inner">

		{{-- @foreach($sliders as $key => $slider)
			@if(0 == $key)
			    <div class="item active">
			    	<a href="{{ url('videos/'.$slider->video_id.'?myid_auth_password=taptubemyid@tech2020') }}">
				    	<img src="{{ asset($slider->media->file_path . $slider->media->file_name) }}" alt="First slide">
				    </a>
			    </div>
			@else 
			    <div class="item">
			    	<a href="{{ url('videos/'.$slider->video_id.'?myid_auth_password=taptubemyid@tech2020') }}">
				    	<img src="{{ asset($slider->media->file_path . $slider->media->file_name) }}" alt="First slide">
				    </a>
			    </div>
			@endif
		@endforeach --}}

	    <div class="item active">
	    	<a href="{{ url('videos/378945228?myid_auth_password=taptubemyid@tech2020') }}">
		    	<img src="{{ asset('frontend/banner/1.jpeg') }}" alt="First slide">
		    </a>
	    </div>
	    <div class="item">
	    	<a href="{{ url('videos/380874080?myid_auth_password=taptubemyid@tech2020') }}">
		    	<img src="{{ asset('frontend/banner/2.jpg') }}" alt="Second slide">
		    </a>
	    </div>
	    <div class="item">
	    	<a href="{{ url('videos/380872482?myid_auth_password=taptubemyid@tech2020') }}">
	    		<img src="{{ asset('frontend/banner/3.jpg') }}" alt="Third slide">
	    	</a>
	    </div>
	    <div class="item">
	    	<a href="{{ url('videos/373090905?myid_auth_password=taptubemyid@tech2020') }}">
		    	<img src="{{ asset('frontend/banner/4.jpg') }}" alt="Fourth slide">
		    </a>
	    </div>
	    <div class="item">
	    	<a href="{{ url('videos/380414532?myid_auth_password=taptubemyid@tech2020') }}">
		    	<img src="{{ asset('frontend/banner/5.jpg') }}" alt="Five slide">
		    </a>
	    </div>
	    <div class="item">
	    	<a href="{{ url('videos/380447429?myid_auth_password=taptubemyid@tech2020') }}">
		    	<img src="{{ asset('frontend/banner/6.jpg') }}" alt="Six slide">
		    </a>
	    </div>
	    <div class="item">
	    	<a href="{{ url('videos/380175365?myid_auth_password=taptubemyid@tech2020') }}">
		    	<img src="{{ asset('frontend/banner/7.jpg') }}" alt="Seven slide"> 
		    </a>
	    </div>
	</div>
</div>
<!-- /main carousel -->
<br><br><hr>