var list = [];
var buf;
var next_coment = 1;
var cm_string = "comment";
var it_string = "iterator";

function checkPharma(pharm)
{
	var ifisin = false;
	var index = 0;
	for(i = list.length - 1; i >= 0; i--)
	{
		if(pharm == list[i])
		{
			index = i;
			ifisin = true;
		}
	}
	if(!ifisin)
	{
		list.push(pharm);
		document.getElementById(pharm).style.opacity = "0.25";
		return true;
	}
	else
	{
		delete list[index];
		document.getElementById(pharm).style.opacity = "1.0";
		return false;
	}

}

function save()
{
	var checklist = 0;
	var nicerList = [];
	for(i = list.length - 1; i >= 0; i--)
	{
		if(list[i] != undefined || list[i] != null)
		{
			nicerList.push(list[i]);
		}
	}
	if(nicerList.length != 0)
	{
		nicerList.push(document.getElementById('username').getAttribute("value"));
		send(nicerList.toString());
	}
	else
	{
		document.getElementById("pharmform").submit();
	}	
}

function send()
{
	document.getElementById("tranform").submit();
}

function validate()
{
	return "123456";
}

function hideForm()
{
	document.getElementById("tranform").style.display = "none";
	document.getElementById("submitBtn").style.display = "block";
	document.getElementById("potwierdzenie").style.display = "block";
	document.getElementById("nextBtn").style.display = "none";

	document.getElementById("od").innerHTML = document.forms["tranform"]["receiver"].value;
	document.getElementById("numer").innerHTML = document.forms["tranform"]["acc"].value;
	document.getElementById("kwota").innerHTML = document.forms["tranform"]["amount"].value;
	document.forms["tranform"]["acc"].value = validate();
}


window.onload=function()
{
	document.getElementById("nextBtn").addEventListener('click', hideForm);
	document.getElementById("submitBtn").addEventListener('click', send);
	document.getElementById("pharmasList").addEventListener('click', function(e) 
	{
		buf = e.target.id;
		if(buf != "pharmasList")
			if(checkPharma(buf))
			{

			}
			else
			{}
	});
}
