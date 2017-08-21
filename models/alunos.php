<?php
	class Alunos extends model{

		private $info;

		public function verificarLogin(){

			if(isset($_SESSION['lgsocial']) && !empty($_SESSION['lgsocial'])){
				return true;
			}else{
				return false;
			}
		}

		public function fazerLogin($email, $senha){

			$sql = "SELECT * FROM alunos WHERE email = :email AND senha = :senha";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":email", $email);
			$sql->bindValue(":senha", $senha);
			$sql->execute();

			if($sql->rowCount() > 0){
				$row = $sql->fetch();

				$_SESSION['lgsocial'] = $row['id'];

				return true;
			}else{
				return false;
			}
		}

		public function isInscrito($id){

			$sql = "SELECT * FROM aluno_curso WHERE id_curso = :id_curso AND id_aluno = :id_aluno";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_curso", $id);
			$sql->bindValue(":id_aluno", $_SESSION['lgsocial']);
			$sql->execute();

			if($sql->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}

		public function setAluno($id){

			$sql = "SELECT * FROM alunos WHERE id = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id", $id);
			$sql->execute();

			if($sql->rowCount() > 0){
				$this->info = $sql->fetch();
			}
		}

		public function getNome(){

			return $this->info['nome'];
		}

		public function getId(){
			return $this->info['id'];
		}
	}
?>