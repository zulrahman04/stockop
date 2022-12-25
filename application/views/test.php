<style type="text/css">
    .videobox {
        position: relative;
    }

    .videobox span {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        z-index: 1;
        background: url(https://i.imgur.com/A9J4iWz.png) no-repeat center center;
    }
</style>

<style type="text/css">
    body {
        font-family: Helvetica, sans-serif;
    }

    h2,
    h3 {
        margin-top: 0;
    }

    form {
        margin-top: 15px;
    }

    form>input {
        margin-right: 15px;
    }

    #results {
        float: right;
        margin: 20px;
        padding: 20px;
        border: 1px solid;
        background: #ccc;
    }
</style>
<!-- <div class="col-md-5">
    <div class="videobox">
        <video autoplay="true" id="video-webcam" style="width: 300px;height: 300px;">Browsermu tidak mendukung bro,
            upgrade donk ! </video>
        <span></span>
        <button onclick="takeSnapshot()">Ambil Gambar</button>
    </div>
</div> -->

<div id="results">Your captured image will appear here...</div>
<div id="my_camera">

</div>

<form>
    <input type=button value="Take Snapshot" onClick="take_snapshot()">
</form>

<script src="<?= base_url('assets') ?>/js/webcam.min.js"></script>
<script language="JavaScript">
    Webcam.set({
        facingMode: "environment",
        // live preview size
        width: 320,
        height: 240,

        // device capture size
        dest_width: 320,
        dest_height: 240,

        // final cropped size
        crop_width: 440,
        crop_height: 140,

        // format and quality
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    Webcam.attach('#my_camera');
</script>


<!-- Code to handle taking the snapshot and displaying it locally -->
<script language="JavaScript">
    function take_snapshot() {
        // take snapshot and get image data
        Webcam.snap(function(data_uri) {
            // display results in page
            document.getElementById('results').innerHTML =
                '<h2>Here is your image:</h2>' +
                '<img src="' + data_uri + '"/>';
        });
    }
</script>

<!-- <script type="text/javascript">
// seleksi elemen video
var video = document.querySelector("#video-webcam");

// minta izin user
navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia ||
    navigator.msGetUserMedia || navigator.oGetUserMedia;

// jika user memberikan izin
if (navigator.getUserMedia) {

    // jalankan fungsi handleVideo, dan videoError jika izin ditolak
    navigator.getUserMedia({
            video: true
        }

        , handleVideo, videoError);
}

// fungsi ini akan dieksekusi jika  izin telah diberikan
function handleVideo(stream) {
    video.srcObject = stream;
}

// fungsi ini akan dieksekusi kalau user menolak izin
function videoError(e) {
    // do something
    alert("Izinkan menggunakan webcam untuk demo!")
}

function takeSnapshot() {
    // buat elemen img
    var img = document.createElement('img');
    var context;

    // ambil ukuran video
    var width = video.offsetWidth,
        height = video.offsetHeight;

    // buat elemen canvas
    canvas = document.createElement('canvas');
    canvas.width = width;
    canvas.height = height;

    // ambil gambar dari video dan masukan
    // ke dalam canvas
    context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, width, height);

    // render hasil dari canvas ke elemen img
    img.src = canvas.toDataURL('image/png');
    document.body.appendChild(img);
}
</script> -->