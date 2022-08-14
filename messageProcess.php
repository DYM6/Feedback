<?php
//include 'connection.php';

//инициализация полей
$userFirstName = $userSurname = $userPatronymic = $userEMail = $Message = "";

//запись в поля из js
$userFirstName = $_POST['userFirstName'];
$userSurname = $_POST['userSurname'];
$userPatronymic = $_POST['userPatronymic'];
$userEMail = $_POST['userEMail'];
$Message = $_POST['Message'];

//проверки значений полей
$max_field_length=20;
//$max_message_length=10000;
if ($userSurname =="")
{
	echo "Введите фамилию";
}
else if ($userFirstName =="")
{
	echo "Введите имя";
}
/*else if ($userPatronymic =="")
{
	echo "Введите отчество";
}*/
else if ($userEMail =="")
{
	echo "Введите почту";
}
else if ($Message =="")
{
	echo "Введите текст сообщения";
}
else if (strlen($userFirstName)>$max_field_length)
{
	echo "Ваше имя подозрительно длинное";
}
else if (strlen($userSurname)>$max_field_length)
{
	echo "Ваша фамилия подозрительно длинная";
}
else if (strlen($userPatronymic)>$max_field_length)
{
	echo "Ваше отчество подозрительно длинное";
}
else if (strlen($userEMail)>$max_field_length)
{
	echo "Ваш почтовый адрес подозрительно длинный";
}
else /*if (strlen($Message)/2>$max_message_length)
{
	echo strlen($Message);
	echo " Превышена максимальная длина сообщения (вот же не лень тебе было все это набирать...)";
}
else
*/

	//PDO
try 
{
	$connection = new PDO('mysql:dbname=messages;host=localhost;port=3306', 'root', '123456');
	$query = "INSERT INTO messages (userFirstName, userSurname, userPatronymic, userEMail, Message) VALUES ('$userFirstName', '$userSurname', '$userPatronymic', '$userEMail','$Message')";
	$affectedRowsNumber = $connection->exec($query);
	if($affectedRowsNumber > 0 )
	{
		//echo strlen($Message);
		echo "Сообщение отправлено";
	}
	else 
	{
		echo "Сообщение не отправлено";
	}
}
catch (PDOException $e) 
{
	echo "Database error: " . $e->getMessage();
}
?>