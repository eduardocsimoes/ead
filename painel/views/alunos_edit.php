<h1>Editar Aluno</h1>

<form method="POST">

	Nome do aluno:<br>
	<input type="text" name="nome" value="<?php echo $aluno['nome']; ?>"><br><br>

	Email:<br>
	<input type="email" name="email" value="<?php echo $aluno['email']; ?>"><br><br>

	Senha:<br>
	<input type="password" name="senha" placeholder="*****"><br><br>

	Cursos inscritos:<br>
	<select name="cursos[]" multiple>
		<?php foreach($cursos as $curso){ ?>
			<option value="<?php echo $curso['id']; ?>" <?php echo (in_array($curso['id'], $inscrito)) ? "selected='selected'" : ''; ?>><?php echo $curso['nome']; ?></option>
		<?php } ?>
	</select><br><br>

	<input type="submit" value="Salvar">
</form>