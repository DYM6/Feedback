<?php
include 'mvc.php';
	$model = new cModel();
	$controller = new cController($model);
	$controller->set_data();
?>