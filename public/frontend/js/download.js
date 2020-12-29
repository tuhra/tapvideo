var download_url = $('#video_url').text();
var clipboard = new Clipboard('#download');

clipboard.on('success', function(e) {
    console.log('Copied text: ' + $("#video_url").text());
});
clipboard.on('error', function(e) {
    console.log(e);
});

function copyText() {
  swal({
      title: "Get the download link?",
      text: download_url,
      buttons: "Yes, copy it!",
    }).then(function () {
        swal(
        {
            title: "Copied!",
            text: 'The text has been copied.',
            buttons: "OK"
        });
    });
}

$(document).ready(function () {
    $(document).on('click', '#fav_btn', function (e) {
        e.preventDefault();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var video_id = $('#video_id').val();
        var video_uri = $('#video_uri').val();
        var video_name = $('#video_name').val();
        var video_description = $('#video_description').val();
        var video_category = $('#video_category').val();
        var video_pictures = $('#video_pictures').val();
        $("#fav_icon").attr('src',"{{ asset('frontend/images/fav-full.png') }}");
        $.ajax({
            url: '/favourite',
            type: 'POST',
            data: {_token: CSRF_TOKEN, video_id: video_id, video_uri: video_uri, video_name: video_name, video_description: video_description, video_category: video_category, video_pictures: video_pictures},
            dataType: 'JSON',
            success: function (data) {
                swal(data.success);
            }
        }); 
    })

    $(document).on('click', '#download', function () {
        var download_url = $('#video_url').val();
        copyURL();
        swal({
            icon: "http://demo.tapinnovationsmm.com//frontend/images/flim.png",
            imageHeight: 200,
            imageAlt: 'Download Guide',
            text: 'ဒေါင်းလော့လင့် ကော်ပီယူပြီးပါပြီ...သင့်ဖုန်းရဲ့ Browser မှာ Paste ချလိုက်ရင် ဒေါင်းလော့ဆွဲသွားမှာဖြစ်ပါတယ်။',
            buttons: 'ဒေါင်းလော့ဆွဲနည်း Video ပြန်ကြည့်မယ်'
        }).then(function () {
        copyURL();
        });
    })
    


    function copyURL() {
        document.getElementById('video_url').style.display = "block";
        var copyText = document.getElementById("video_url");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
        document.getElementById('video_url').style.display = "none";

    }

    $("#scroll_icon").on('click', function(e) {
        e.preventDefault();
        window.location.href = "#top";
        window.scrollTo(0, 0);
        setTimeout(window.scrollTo(0, 0));
    });
}) 