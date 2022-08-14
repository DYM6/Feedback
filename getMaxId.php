<?php

//include 'connection.php';

$id=0;

try 
{
	$connection = new PDO('mysql:dbname=messages;host=localhost;port=3306', 'root', '123456');
	$query = "SELECT idMessages FROM messages ORDER BY idMessages DESC";
	$statement = $connection->prepare($query);
	$statement->execute();
	$statement->bindColumn('idMessages', $id,  PDO::PARAM_INT);
	$statement->fetch();

	echo $id;

}
catch (PDOException $e) 
{
	echo "Database error: " . $e->getMessage();
}


?>