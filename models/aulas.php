<?php 
	class Aulas extends model{

		public function marcarAssistido($id_aula){

			$id_aluno = $_SESSION['lgsocial'];

			$sql = "INSERT INTO historico SET data_viewer = NOW(), id_aluno = :id_aluno, id_aula = :id_aula";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_aluno", $id_aluno);
			$sql->bindValue(":id_aula", $id_aula);
			$sql->execute();
		}

		public function getAulasDoModulo($id){

			$array = array();
			$aluno = $_SESSION['lgsocial'];

			$sql = "SELECT * FROM aulas WHERE id_modulo = :id ORDER BY ordem";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id", $id);
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetchAll();

				foreach ($array as $aulachave => $aula) {

					$array[$aulachave]['assistido'] = $this->isAssistido($aula['id'], $aluno);

					if($aula['tipo'] == 'video'){
						$sql = "SELECT nome FROM videos WHERE id_aula = :id_aula";
						$sql = $this->db->prepare($sql);
						$sql->bindValue(":id_aula", $aula['id']);
						$sql->execute();

						if($sql->rowCount() > 0){
							$sql = $sql->fetch();
							$array[$aulachave]['nome'] = $sql['nome'];
						}
					}else if($aula['tipo'] == 'poll'){
						$array[$aulachave]['nome'] = "Questionario";
					}
				}	
			}

			return $array;
		}

		public function getCursoDaAula($id_aula){

			$sql = "SELECT id_curso FROM aulas WHERE id = :id_aula";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_aula", $id_aula);
			$sql->execute();

			if($sql->rowCount() > 0){
				$sql = $sql->fetch();

				return $sql['id_curso'];
			}else{
				return 0;
			}
		}

		public function getAula($id_aula){

			$array = array();

			$id_aluno = $_SESSION['lgsocial'];

			$sql = "SELECT 
						tipo,
						(SELECT 
							count(*) 
						 FROM 
						 	historico 
						 WHERE 
						 	historico.id_aula = aulas.id 
						 AND 
						 	historico.id_aluno = :id_aluno) as assistido
					FROM 
						aulas 
					WHERE 
						id = :id_aula";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_aula", $id_aula);
			$sql->bindValue(":id_aluno", $id_aluno);
			$sql->execute();

			if($sql->rowCount() > 0){
				$row = $sql->fetch();

				if($row['tipo'] == 'video'){

					$sql = "SELECT * FROM videos WHERE id_aula = :id_aula";
					$sql = $this->db->prepare($sql);
					$sql->bindValue(":id_aula", $id_aula);
					$sql->execute();

					if($sql->rowCount() > 0){
						$array = $sql->fetch();
						$array['tipo'] = 'video';
					}
				}else if($row['tipo'] == 'poll'){

					$sql = "SELECT * FROM questionarios WHERE id_aula = :id_aula";
					$sql = $this->db->prepare($sql);
					$sql->bindValue(":id_aula", $id_aula);
					$sql->execute();

					if($sql->rowCount() > 0){
						$array = $sql->fetch();
						$array['tipo'] = 'poll';
					}
				}

				$array['assistido'] = $row['assistido'];
			}

			return $array;
		}

		public function setDuvida($duvida, $id_aluno){

			$sql = "INSERT INTO duvidas SET data_duvida = NOW(), duvida = :duvida, id_aluno = :id_aluno";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":duvida", $duvida);
			$sql->bindValue(":id_aluno", $id_aluno);
			$sql->execute();
		}

		private function isAssistido($id_aula, $id_aluno){

			$sql = "SELECT id FROM historico WHERE id_aluno = :id_aluno AND id_aula = :id_aula";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_aula", $id_aula);
			$sql->bindValue(":id_aluno", $id_aluno);
			$sql->execute();

			if($sql->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}
	}
 ?>