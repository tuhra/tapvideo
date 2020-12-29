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
<body class="">
	<div class="agile-main"> 
        <div class="content-wrap">
            <center>
                <iframe width="100%" height="315"
                src="{{ asset('images/dl-uj.mp4') }}">
                </iframe>
                <br><br><br>
                <button id="copy-dl" class="btn btn-primary btn-lg">Copy Link</button>
                <input type="text" id="video_url" value="{{ $download->download_link }}" style="display: none;">
            </center>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@1/dist/clipboard.min.js"></script>
	<script type="text/javascript">
        var download_url = $('#video_url').val();
        var clipboard = new Clipboard('#copy-dl');

        clipboard.on('success', function(e) {
            console.log('Copied text: ' + download_url);
        });
        clipboard.on('error', function(e) {
            console.log(e);
        });

        $(document).ready(function () {

            $(document).on('click', '#copy-dl', function () {
                copyURL();
                var options = {
                    title: 'Title',
                    text: '<img width="250" height="200" src="http://lorempixel.com/400/200/sports/2/">',
                    html: true
                };
                swal(options);
                // swal({
                //     title: "Get the download link?",
                //     text: download_url,
                //     buttons: "Yes, copy it!",
                // }).then(function () {
                // swal({
                //         title: "Copied!",
                //         text: 'The text has been copied.',
                //         buttons: "OK"
                //     });
                // });
            })
            


            function copyURL() {
                document.getElementById('video_url').style.display = "block";
                var copyText = document.getElementById("video_url");
                copyText.select();
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy");
                document.getElementById('video_url').style.display = "none";

            }


        }) 
	</script>
</body>
@stop


