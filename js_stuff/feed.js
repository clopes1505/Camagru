function like(id)
{
	var request = new XMLHttpRequest();

	request.onload = function(response)
	{

		if (request.status === 200)
		{
			var likes = document.getElementById("num_likes-"+id);
			likes.innerHTML = 1 + Number(likes.innerHTML);
		}
		else if (request.status === 205)
		{
			var likes = document.getElementById("num_likes-"+id);
			likes.innerHTML = Number(likes.innerHTML) - 1;
		}
		else
			console.log(request.responseText);

	}
	request.open("POST", "like.php");
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send('pid='+id);
}
var pagenum = 1;
var profilenum = 1;
function loadmore ()
{
 	var profile_feed = document.getElementById("profile_feed");
	var feed = document.getElementById("feed");
	if (feed)
	{
		var request = new XMLHttpRequest();
		request.onload = () => {
		if(request.status === 200)
		{
			pagenum++;
			feed.innerHTML += request.responseText;
		}
		else
			console.log(request.responseText);
		};
		request.open("POST", "/camagru/make_functional/feeb.php?page=" + pagenum);
		request.send();
	}
	else if (profile_feed)
	{
		var request = new XMLHttpRequest();
		request.onload = () => {
		if(request.status === 200)
		{
			profilenum++;
			profile_feed.innerHTML += request.responseText;
		}
		else
		console.log(request.responseText);
	};
		request.open("POST", "/camagru/make_functional/profile_feeb.php?page=" + profilenum);
		request.send();
	}
}
window.addEventListener("load", () => {
    loadmore();
});
infiniteScroll = () =>
{
    var profile_wrap = document.getElementById('profile_feed');
    var feed_wrap = document.getElementById('feed');
    if (profile_wrap)
    {
        var contentHeight = profile_wrap.offsetHeight;
        var y = window.pageYOffset + window.innerHeight;
        if (y >= contentHeight)
            loadmore();
    }
    if (feed_wrap)
    {
        var contentHeight = feed_wrap.offsetHeight;
        var y = window.pageYOffset + window.innerHeight;
        if (y >= contentHeight)
            loadmore();
    }
}
window.onscroll = infiniteScroll;