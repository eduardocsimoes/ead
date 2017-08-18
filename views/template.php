<html>
	<head>
		<title>Meu site</title>
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/style.css">
		<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
	</head>
	<body>
		<a href="<?php echo BASE_URL; ?>">Home</a>

		<h1>Este é o topo</h1>
		<hr>
		<?php $this->loadViewInTemplate($viewName, $viewData); ?>
	</body>
</html>