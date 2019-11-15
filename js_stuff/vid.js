var video = document.getElementById('video'),
canvas = document.getElementById('my_canvas'),
context = canvas.getContext('2d'),
vendorURL = window.URL || window.webkitURL;
var image;
navigator.getMedia =    navigator.getUserMedia || 
                        navigator.webkitGetUserMedia || 
                        navigator.mozGetUserMedia || 
                        navigator.msGetUserMedia;
navigator.getMedia({
    video: true,
    audio: false
}, function(stream){
    video.srcObject = stream;
    video.play();
}, function(error) 
{
​
});
​
document.getElementById('capture').addEventListener('click', function()
{
context.drawImage(video, 0, 0, 400, 300);
if (image.src)
context.drawImage(image, 20, 10, 100, 70);
photo.setAttribute('src', canvas.toDataURL('image/png'));  
});