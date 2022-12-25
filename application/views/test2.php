<style type="text/css">
video {
    width: 192px;
    height: 192px;
    background: rgba(0, 0, 0, 0.2);
    -webkit-transform: scaleX(-1);
    /* mirror effect while using front cam */
    transform: scaleX(-1);
    /* mirror effect while using front cam */
}

#canvas {
    width: 192px;
    height: 192px;
    -webkit-transform: scaleX(-1);
    /* mirror effect while using front cam */
    transform: scaleX(-1);
    /* mirror effect while using front cam */
}
</style>

<div class="container p-5" align="center">
    <div class="">
        <b>Your Cam:</b><br>
        <video id="camera-stream" class="border border-5 border-danger"></video>
    </div>
    <div class="">
        <button disabled id="flip-btn" class="btn btn-sm btn-warning">
            Flip Camera
        </button>
        <button id="capture-camera" class="btn btn-sm btn-primary">
            Take photo
        </button>
    </div>
    <div class="mt-3">
        <b>Output:</b>
        <br>
        <canvas id="canvas" class="bg-light shadow border border-5 border-success">
        </canvas>
    </div>
    <input type="text" id="existing">
</div>
<script src="<?= base_url('assets') ?>/js/myjs.js"></script>
<script src="<?= base_url('assets') ?>/js/webcam.min.js"></script>


<script language="JavaScript">
$("#canvas").on("change", function() {
    canvas = document.getElementById('canvas')
    img = canvas.toDataURL('image/png')
    document.getElementById('existing').src = img
})
</script>