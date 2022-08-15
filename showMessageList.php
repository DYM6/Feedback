<html>

<head>
<link rel="stylesheet" href="style_for_table.css">
</head>

<body>
<?php
	include 'mvc.php';
	$model = new cModel();
	$controller = new cController($model);
	$view = new cView($model, $controller);
	$view->View();
?>
</body>

</html>