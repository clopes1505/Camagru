function redirect(pid)
{
	location.replace("../make_functional/comment_page.php?pid=" + pid);
}
function post(pid)
{
	var request = new XMLHttpRequest();
	var comment = document.getElementById("comment").value;

	request.onload = () =>
	{
		if (request.status === 200)
			document.location.reload();
	}

	request.open("POST", "comment.php");
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send('pid='+pid+'&comment='+comment);
}