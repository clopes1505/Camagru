window.addEventListener("load", () =>
{
    var video = document.getElementById('video');
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var vendorURL = window.URL || window.webkitURL;
    var uploadpic = document.getElementById('file');
    var upload = document.getElementById('upload');
    navigator.mediaDevices.getUserMedia({video: true}).then((stream) => {video.srcObject = stream; video.play()});
    var save = document.getElementById('save');

	uploadpic.addEventListener('change', (event) => {
		if (uploadpic.files.length > 0)
		{
			var img = new Image();
				img.height = 400;
				img.width = 500;
			img.addEventListener('load', () => {
				canvas.height = img.height;
				canvas.width = img.width;
				context.drawImage(img, 0, 0 ,500 ,400);
			});
		}
		img.src = URL.createObjectURL(uploadpic.files[0])
	});
    document.getElementById('capture').addEventListener('click', function()
    {
        context.drawImage(video, 0, 0, 500, 400);
    });
	var xhttp = new XMLHttpRequest();
	xhttp.onload=function() {
		console.log(xhttp.responseText);
	}
	upload.addEventListener('click', () => {
		xhttp.open("POST", "upload.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send('image='+encodeURIComponent(canvas.toDataURL().replace("data:image/png;base64,", "")));
	});

});