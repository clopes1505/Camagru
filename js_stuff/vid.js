window.addEventListener("load", () =>
{
    var video = document.getElementById('video');
    var canvas = document.createElement('canvas');
	var sticky_canvas = document.createElement('canvas');
	var display = document.getElementById('display_canvas');
	var sticker_display = document.getElementById('sticker_canvas');
	var context = canvas.getContext('2d');
	var sticky_context = sticky_canvas.getContext('2d');
    var uploadpic = document.getElementById('file');
    var upload = document.getElementById('upload');
    navigator.mediaDevices.getUserMedia({video: true}).then((stream) => {video.srcObject = stream; video.play()});
	var capture = document.getElementById('capture');
	var umbreon = document.getElementById('umbreon');
	var chartato = document.getElementById('chartato');
	var goodboy = document.getElementById('goodboy');
	var raichu = document.getElementById('raichu');
	var sticky= document.getElementById('sticky');

	uploadpic.addEventListener('change', () => {
		if (uploadpic.files.length > 0)
		{
			var img = new Image();
				img.height = 400;
				img.width = 500;
			img.addEventListener('load', () => {
				canvas.height = img.height;
				canvas.width = img.width;
				sticky_canvas.height = canvas.height;
				sticky_canvas.width = canvas.width;
				context.drawImage(img, 0, 0 ,500 ,400);
				display.src = canvas.toDataURL();
				video.style.display = "none";
				capture.style.display = "none";
				uploadpic.style.display = "none";
				upload.style.display = "block";
				sticky.style.display = "block";
			});
		}
		img.src = URL.createObjectURL(uploadpic.files[0])
	});
   capture.addEventListener('click', function()
    {
		canvas.height = video.offsetHeight;
		canvas.width = video.offsetWidth;
		sticky_canvas.height = canvas.height;
		sticky_canvas.width = canvas.width;
		context.drawImage(video, 0, 0, 500, 400);
		display.src = canvas.toDataURL();
		video.style.display = "none";
		capture.style.display = "none";
		uploadpic.style.display = "none";
		upload.style.display = "block";
		sticky.style.display = "block";
	});
	umbreon.addEventListener("click", () => {
		sticky_context.drawImage(umbreon, 0, 0, 100, 100);
		sticker_display.src = sticky_canvas.toDataURL();
	})
	chartato.addEventListener("click", () => {
		sticky_context.drawImage(chartato, 100, 20, 100, 100);
		sticker_display.src = sticky_canvas.toDataURL();
	})
	goodboy.addEventListener("click", () => {
		sticky_context.drawImage(goodboy, 390, 270, 100, 100);
		sticker_display.src = sticky_canvas.toDataURL();
	})
	raichu.addEventListener("click", () => {
		sticky_context.drawImage(raichu, 0, 270, 100, 100);
		sticker_display.src = sticky_canvas.toDataURL();
	})
	var xhttp = new XMLHttpRequest();
	xhttp.onload=function() {
		if (xhttp.status === 200)
			location.replace("feed.php");
		console.log(xhttp.responseText);
	}
	upload.addEventListener('click', () => {
		xhttp.open("POST", "upload.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send('image='+encodeURIComponent(canvas.toDataURL().replace("data:image/png;base64,", "")) + '&sticker='+encodeURIComponent(sticky_canvas.toDataURL().replace("data:image/png;base64,", "")));
	});
});