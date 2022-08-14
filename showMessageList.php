<html>

<head>
<link rel="stylesheet" href="style_for_table.css">
</head>

<body>
<?php
	//include 'connection.php';
	$connection = new PDO('mysql:dbname=messages;host=localhost;port=3306', 'root', '123456');
	$sql_query = "SELECT idMessages, userFirstName, userSurname, Message FROM messages ORDER BY idMessages DESC";
	$result = $connection->query($sql_query);
	while($row = $result->fetch())
	{
			echo "<div class='comment'>";
				echo "<div class='comment-headline'>" . $row["idMessages"] . " </div>";
				echo "<div class='comment-headline'>" . $row["userFirstName"] . " ". $row["userSurname"] . "</div><br>";
				echo "" . $row["Message"] . "</td>";
            echo "</div>";
	}
?>
</body>

</html>