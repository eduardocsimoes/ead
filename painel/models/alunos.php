<?php
	class Alunos extends model{

		public function getAlunos(){

			$array = array();

			$sql = "SELECT 
						*,
						(SELECT 
							count(*)
						 FROM
						 	aluno_curso
						 WHERE 
						 	aluno_curso.id_aluno = alunos.id) as qtcursos
					FROM 
						alunos";
			$sql = $this->db->prepare($sql);
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetchAll();
			}

			return $array;
		}

		public function getAluno($id_aluno){

			$array = array();

			$sql = "SELECT * FROM alunos WHERE id = :id_aluno";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_aluno", $id_aluno);
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetch();
			}

			return $array;
		}

		public function adicionar($nome, $email, $senha){

			$sql = "INSERT INTO alunos SET nome = :nome, email = :email, senha = :senha";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":nome", $nome);
			$sql->bindValue(":email", $email);
			$sql->bindValue(":senha", $senha);
			$sql->execute();
		}		

		public function excluir($id_aluno){

			$sql = "DELETE FROM aluno_curso WHERE id_aluno = :id_aluno";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_aluno", $id_aluno);
			$sql->execute();

			$sql = "DELETE FROM aluno WHERE id = :id_aluno";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_aluno", $id_aluno);
			$sql->execute();
		}

		public function update($id_aluno,$nome,$email,$senha = NULL){

			if(isset($senha) && !empty($senha)){

				$sql = "UPDATE alunos SET nome = :nome, email = :email, senha = :senha WHERE id = :id_aluno";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(":id_aluno", $id_aluno);
				$sql->bindValue(":nome", $nome);
				$sql->bindValue(":email", $email);
				$sql->bindValue(":senha", md5($senha));
				$sql->execute();
			}else{
				$sql = "UPDATE alunos SET nome = :nome, email = :email WHERE id = :id_aluno";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(":id_aluno", $id_aluno);
				$sql->bindValue(":nome", $nome);
				$sql->bindValue(":email", $email);
				$sql->execute();				
			}
		}

		public function deletaCursosAlunos($id_aluno){

			$sql = "DELETE FROM aluno_curso WHERE id_aluno = :id_aluno";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_aluno", $id_aluno);
			$sql->execute();			
		}

		public function adicionaCursosAlunos($id_aluno,$cursos){

			foreach($cursos as $curso){

				$sql = "INSERT INTO aluno_curso SET id_aluno = :id_aluno, id_curso = :id_curso";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(":id_aluno", $id_aluno);
				$sql->bindValue(":id_curso", $curso);
				$sql->execute();
			}
		}
	}
?>