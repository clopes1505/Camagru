var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var vendorURL = window.URL || window.webkitURL;
var uploadpic = document.getElementById('upload');
navigator.mediaDevices.getUserMedia({video: true}).then((stream) => {video.srcObject = stream; video.play()});

document.getElementById('capture').addEventListener('click', function()
{
    context.drawImage(video, 0, 0, 500, 400);
    //photo.setAttribute('src', canvas.toDataURL('image/png'));  
});

uploadpic.addEventListener('change', (event) => {
    if (uploadpic.files.length > 0)
    {
        var img = new Image();
        img.addEventListener('load', () => {
            canvas.height = img.height;
            canvas.width = img.width;
            context.drawImage(img, 0, 0);
        });
        img.src = URL.createObjectURL(uploadpic.files[0])
    }
});