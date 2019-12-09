delete_post = (pid) =>
{
	var confirmation = confirm("Are you sure youy wanna delete your post?");
	if(confirmation)
	{
		var request = new XMLHttpRequest();
		request.onload = () =>
		{
			if (request.status === 200)
				document.location.reload();
			else
				console.log(request.responseText);
		}
		request.open("POST", "delete.php");
		request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		request.send('pid='+pid);
	}
}