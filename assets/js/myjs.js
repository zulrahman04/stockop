// camera stream video element
let on_stream_video = document.querySelector("#camera-stream");
// flip button element
let flipBtn = document.querySelector("#flip-btn");

// default user media options
let constraints = { audio: false, video: true };
let shouldFaceUser = true;

// check whether we can use facingMode
let supports = navigator.mediaDevices.getSupportedConstraints();
if (supports["facingMode"] === true) {
	flipBtn.disabled = false;
}

let stream = null;

function capture() {
	constraints.video = {
		width: {
			min: 72,
			ideal: 72,
			max: 72,
		},
		height: {
			min: 122,
			ideal: 122,
			max: 122,
		},
		facingMode: shouldFaceUser ? "user" : "environment",
	};
	navigator.mediaDevices
		.getUserMedia(constraints)
		.then(function (mediaStream) {
			stream = mediaStream;
			on_stream_video.srcObject = stream;
			on_stream_video.play();
		})
		.catch(function (err) {
			console.log(err);
		});
}

flipBtn.addEventListener("click", function () {
	if (stream == null) return;
	// we need to flip, stop everything
	stream.getTracks().forEach((t) => {
		t.stop();
	});
	// toggle / flip
	shouldFaceUser = !shouldFaceUser;
	capture();
});

capture();

document
	.getElementById("capture-camera")
	.addEventListener("click", function () {
		// Elements for taking the snapshot
		const video = document.querySelector("video");
		canvas.width = video.videoWidth;
		canvas.height = video.videoHeight;
		canvas.getContext("2d").drawImage(video, 0, 0);
		console.log(canvas);
	});
