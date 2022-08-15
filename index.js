//работа с таймером
 let maxId=0;

listRequest();
setInterval('getMaxId()',20000);

//обновление списка сообщений
function listRequest()
{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() 
		{
			if(xmlhttp.readyState == 4)
			{
				if (xmlhttp.status == 200) 
				{
					document.getElementById("messagelist").innerHTML = xmlhttp.responseText;
					document.getElementById("error").innerHTML = "";
				}
			}
		};
		xmlhttp.onerror = function()
		{
			document.getElementById("error").innerHTML = "server error, status: "+xmlhttp.status;
		}
		xmlhttp.open("POST","showMessageList.php",true);
		xmlhttp.send();
}

//запрос максимального значения индекса сообщения
function getMaxId()
{
	var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4)
			{
				if (xmlhttp.status == 200) 
				{
					if(maxId < Number(xmlhttp.response))
					{
						maxId=Number(xmlhttp.response);
						listRequest();
					}
					document.getElementById("error").innerHTML = "";
				}
			}
	
		}
		xmlhttp.onerror = function()
		{
			document.getElementById("error").innerHTML = "server error, status: "+xmlhttp.status;
		}
		xmlhttp.open("POST","getMaxId.php",true);
		xmlhttp.send();
}

//обработка нажатия кнопки sendMessage
function XMLSend()
{
	var userFirstName = document.querySelector('#userFirstName').value;
	var userSurname = document.querySelector('#userSurname').value;
	var userPatronymic = document.querySelector('#userPatronymic').value;
	var userEMail = document.querySelector('#EMail').value;
	var Message = document.querySelector('#Message').value;
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			document.getElementById('SendMessageButton').disabled = false;
			document.getElementById('Message').value="";
			listRequest();
			//console.log(this);
			document.getElementById("hint").innerHTML = xmlhttp.responseText;
			document.getElementById("error").innerHTML = "";
		}
	}
	xmlhttp.onerror = function()
		{
			document.getElementById("error").innerHTML = "server error, status: "+xmlhttp.status;
		}
	document.getElementById('SendMessageButton').disabled = true;
	xmlhttp.open('POST','messageProcess.php', true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	let a = "userFirstName="+userFirstName+"&userSurname="+userSurname+"&userPatronymic="+userPatronymic+"&userEMail="+userEMail+"&Message="+Message;
	xmlhttp.send(a);
}