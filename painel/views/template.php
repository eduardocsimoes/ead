<html>
	<head>
		<title>Meu site</title>
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/template.css">
		<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>		
		<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
	</head>
	<body>
		<div class="topo">
			<div class="topo-left">
				<a href="<?php echo BASE_URL; ?>">Cursos</a>	
				<a href="<?php echo BASE_URL; ?>alunos">Alunos</a>
			</div>
			<div class="topo-right-botao">				
				<a href="<?php echo BASE_URL; ?>/login/logout">Sair</a>	
			</div>
		</div>

		<?php $this->loadViewInTemplate($viewName, $viewData); ?>
	</body>
</html>