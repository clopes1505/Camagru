navigator.mediaDevices.getUserMedia({video: true, audio: false})
.then(function(stream)
{
	video.srcObject = stream;
	video.play();
});