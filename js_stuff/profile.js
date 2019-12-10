popup = () =>
{
	document.getElementById("myform").style.display = "block";
}
popdown = () =>
{
	document.getElementById("myform").style.display = "none";
}
window.addEventListener("load", () => 
{
    var not_yes = document.getElementById("not_yes");
	var not_no = document.getElementById("not_no");
	var request = new XMLHttpRequest();
	
    if (not_yes)
    {
        not_yes.addEventListener("click", () =>
        {
            request.open("POST", "notifications.php");
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.send("check=" + 1);
       });
    }
    if (not_no)
    {
		not_no.addEventListener("click", () =>
        {
			request.open("POST", "notifications.php");
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.send("check=" + 0);
        });
    }
});