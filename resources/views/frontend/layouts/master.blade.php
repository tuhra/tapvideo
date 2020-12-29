<!DOCTYPE html>
<html>
<head>
<title>TAP TUBE </title> 
<!-- For-Mobile-Apps-and-Meta-Tags -->
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- //For-Mobile-Apps-and-Meta-Tags -->
<!-- Custom Theme files -->
<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
<link href="{{ asset('frontend/css/bootstrap.css') }}" type="text/css" rel="stylesheet" media="all">
<link href="{{ asset('frontend/css/style.css') }}" type="text/css" rel="stylesheet" media="all"> 
<script src="{{ asset('frontend/js/jquery-2.2.3.min.js') }}"></script>
<!-- pop-up-box -->
<script src="{{ asset('frontend/js/jquery.magnific-popup.js') }}" type="text/javascript"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
	$(document).ready(function() {
		$('.popup-top-anim').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});																							
	}); 
</script>
</head>
	@yield('content')
		<!-- Multi-Slider -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/owl.carousel.min.js"></script>
		<script type="text/javascript">
			$('.owl-carousel').owlCarousel({
			  loop: false,
			  margin: 10,
			  nav: true,
			  navText: [
			    "<i class='fa fa-caret-left'></i>",
			    "<i class='fa fa-caret-right'></i>"
			  ],
			  autoplay: true,
			  autoplayHoverPause: true,
			  responsive: {
			    0: {
			      items: 3
			    },
			    600: {
			      items: 3
			    },
			    1000: {
			      items: 10
			    }
			  }
			});
			$('.owl-carousel-new').owlCarousel({
			  loop: false,
			  margin: 10,
			  nav: true,
			  navText: [
			    "<i class='fa fa-caret-left'></i>",
			    "<i class='fa fa-caret-right'></i>"
			  ],
			  autoplay: true,
			  autoplayHoverPause: true,
			  responsive: {
			    0: {
			      items: 1
			    },
			    600: {
			      items: 2
			    },
			    1000: {
			      items: 3
			    }
			  }
			})
		</script>
		<!-- menu-js -->
		<script src="{{ asset('frontend/js/classie.js') }}"></script>
		<script src="{{ asset('frontend/js/main.js') }}"></script>
		<!-- //menu-js -->	 
		 
		<!-- Alert Message -->
	    <script type="text/javascript">
	        $(function() {
		        if(!$('div').hasClass('pop-up')) { 
		        	$('#overlay').removeClass('blur-in');
				}
	          	$('.pop-up').hide();
	          	$('.pop-up').fadeIn(1000);              
	              	$('.close-button').click(function (e) { 
	              	$('.pop-up').fadeOut(700);
	              	$('#overlay').removeClass('blur-in');
	              	$('#overlay').addClass('blur-out');
	              	e.stopPropagation();
	            });
	        });

	        $('.searchButton').click(function() {
		        var valKeyword = $(".searchTerm" ).val();
		        if(valKeyword != 0) {
		            window.location = "/search/" + valKeyword;
		        }   
		    });
	    </script>

		<!-- Bootstrap core JavaScript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
	    <script src="{{ asset('frontend/js/bootstrap.js') }}"></script>
	    <script src="https://cdn.jsdelivr.net/npm/clipboard@1/dist/clipboard.min.js"></script>

</html>