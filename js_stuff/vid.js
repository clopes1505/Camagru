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
    document.getElementById('capture').addEventListener('click', function()
    {
        context.drawImage(video, 0, 0, 500, 400);
        var data = canvas.toDataURL('image/png');
        upload.addEventListener('click', () => {
            var xhttp = new XMLHttpRequest();
            xhttp.onload=function() {
                console.log(xhttp.responseText);
            }
            xhttp.open("POST", "upload.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send('image='+encodeURIComponent(data.replace("data:image/png;base64,", "")));
        });
    });


    uploadpic.addEventListener('change', (event) => {
        if (uploadpic.files.length > 0 && upload.files[0].type.match(/image\/*/))
        {
			var img = new Image();
            img.addEventListener('load', () => {
				canvas.height = img.height;
                canvas.width = img.width;
                context.drawImage(img, 0, 0 ,500 ,400);
			});
			var request = new XMLHttpRequest();
			request.onload = () =>
			{
				if (request.status === 200)
				{
					console.log("200");
					console.log(request.responseText);
				}
				else
					console.log(request.responseText);
			}

            request.open("POST", "upload.php", true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send('image='+canvas);
        }
		img.src = URL.createObjectURL(uploadpic.files[0])
    });
});