var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var vendorURL = window.URL || window.webkitURL;
var uploadpic = document.getElementById('upload');
navigator.mediaDevices.getUserMedia({video: true}).then((stream) => {video.srcObject = stream; video.play()});
var save = document.getElementById('save');
document.getElementById('capture').addEventListener('click', function()
{
    context.drawImage(video, 0, 0, 500, 400);
    var data = canvas.toDataURL('image/png');
    // console.log(data);

    var xhttp = new XMLHttpRequest();
    xhttp.onload=function() {
        console.log(xhttp.responseText);
    }
    xhttp.open("POST", "feed.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('image='+encodeURIComponent(data.replace("data:image/png;base64,", "")));

    // sever (adduser or whereever and satuff dude...php)
    
    // 2. listen for data 
    // if isset($_POST || $_GET thingy) (site sent)
        // 3. decode (site sent)
    // else 
        //error handle thingy
        // post handle 
    // 4. save (site sent)

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