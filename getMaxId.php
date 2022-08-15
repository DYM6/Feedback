<?php
	include 'mvc.php';
	$controller = new cController(new cModel());
	echo $controller->getMaxId();
?>