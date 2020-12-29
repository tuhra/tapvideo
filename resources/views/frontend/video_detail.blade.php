@extends('frontend.layouts.master')
@section('content')
<style>
.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  color: white;
  text-align: center;
}
</style>
<body class="bg">
	
	<div class="agile-main"> 
        <div class="content-wrap">
            {{--<div class="header"> 
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
            </div>--}}
            <div class="content">
                <div style="padding: 1em 1.5em;">
                    <div class="row">
                        <div class="col-md-12 col-xs-12 cat-title">
                            <h4 class="capital"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i></a> 
                                {{ $vdo['body']['name'] }} </span> </h4>
                        </div>
                    </div>
                </div>
                <center>
                    <div class='embed-container'>
                        <?php echo $vdo['body']['embed']['html']; ?>
                    </div>
                    <span>      
                        <input type="hidden" name="video_id" value="{{ $id }}" id="video_id">
                        <input type="hidden" name="video_uri" value="{{ $vdo['body']['uri'] }}" id="video_uri">
                        <input type="hidden" name="video_name" value="{{ $vdo['body']['name'] }}" id="video_name">
                        <input type="hidden" name="video_description" value="{{ $vdo['body']['description'] }}" id="video_description">
                        <input type="hidden" name="video_category" value="{{ $vdo['body']['parent_folder']['name'] }}" id="video_category">
                        <a href="#" id="fav_btn"> <img src="{{ asset('frontend/images/fav.png') }}" id="fav_icon">  Favourite </a>
                        
                        <a href="{{ url($id.'/download_guide') }}"> <img src="{{ asset('frontend/images/download.png') }}">  Download </a> 
                        <br><br>
                        {{--<a href="{{ url($id.'/download_guide') }}" class="btn btn-info">Download Guide</a>--}}
                        <div style="display:none" id="frameDiv">
                        </div>
                    </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 

                    
                    <br><br><br>
                </center>
                <br>
                 
                <!-- footer -->
                {{--<div class="w3agile footer"> 
                    <div class="footer-text">
                        <p> TAP TUBE &copy; 2020  . All Rights Reserved.</p>
                    </div>
                </div>--}}

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@1/dist/clipboard.min.js"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/download.js' )}}"></script>
</body>
@stop


