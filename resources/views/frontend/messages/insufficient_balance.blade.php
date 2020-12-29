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
                                 <span class="name">၀မ်းနည်းပါတယ် ၀န်ဆောင်မှု ရယူရန် လုံလောက်သော ငွေ ပမာဏ မရှိပါ</span>
                            <br><br>
                            <a href="{{ url('/') }}"><button type="submit" class="btn lp_btn_success" id="" value="">  
                                <h5 style="color: white;font-weight: bold;">မူလစာမျက်နှာ</h5></button></a>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</body>
@stop