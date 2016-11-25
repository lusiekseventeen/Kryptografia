
function redirect2creator()
{
	window.location = "https://localhost/Raiffeisen/transfer.php";
}

window.onload=function()
{
	document.getElementById("addButton").addEventListener('click', redirect2creator);
	document.getElementById("editButton").addEventListener('click', redirect2editor);
}
