<?php
class cModel
{
	private $connection;
	public function __construct()
	{
		$this->connection = new PDO('mysql:dbname=messages;host=localhost;port=3306', 'root', '123456');
	}
	public function get_data()
	{
		$sql_query = "SELECT idMessages, userFirstName, userSurname, userPatronymic, Message, dateTime FROM messages ORDER BY idMessages DESC";
		return $this->connection->query($sql_query);
	}
	public function set_data()
	{
		//инициализация полей
		$userFirstName = $userSurname = $userPatronymic = $userEMail = $Message = "";

		//запись в поля из js с обрезкой
		$trimmed_characters = "\0../,:..@,^..`,~";
		$userFirstName = trim($_POST['userFirstName'], $trimmed_characters.",0..9");
		$userSurname = trim($_POST['userSurname'], $trimmed_characters.",0..9");
		$userPatronymic = trim($_POST['userPatronymic'], $trimmed_characters.",0..9");
		$userEMail = trim($_POST['userEMail'], $trimmed_characters);
		$Message = trim($_POST['Message'],$trimmed_characters);

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
			echo " Превышена максимальная длина сообщения";
		}
		else
		*/
		{
			$query = "INSERT INTO messages (userFirstName, userSurname, userPatronymic, userEMail, Message) VALUES ('$userFirstName', '$userSurname', '$userPatronymic', '$userEMail','$Message')";
			$this->connection->exec($query);
		}
	}
	public function getMaxId()
	{
		$id=0;
		$query = "SELECT idMessages FROM messages ORDER BY idMessages DESC";
		$statement = $this->connection->prepare($query);
		$statement->execute();
		$statement->bindColumn('idMessages', $id,  PDO::PARAM_INT);
		$statement->fetch();
		return $id;
	}
}

class cController
{
	private $model;
	public function __construct($model)
	{
		$this->model = $model;
	}
	public function set_data()
	{
		return $this->model->set_data();
	}
	public function getMaxId()
	{
		return $this->model->getMaxId();
	}
}

class cView
{
	private $model;
	private $controller;
	public function __construct($model, $controller)
	{
		$this->model = $model;
		$this->controller = $controller;
	}

	public function View()
	{
		if ($result = $this->model->get_data())
		{
			while($row = $result->fetch())
			{
				echo "<div class='comment'>";
					echo "<div class='comment-headline'>#" . $row["idMessages"] . " ". $row["dateTime"] ." </div>";
					echo "<div class='comment-headline'>" . $row["userFirstName"] . " ".$row["userPatronymic"] . " ". $row["userSurname"] .  "</div><br>";
					echo "" . $row["Message"] . "</td>";
				echo "</div>";
			}
		}

	}
}
?>