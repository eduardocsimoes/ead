<?php 
	class Aulas extends model{

		public function marcarAssistido($id){

			$id_aluno = $_SESSION['lgsocial'];

			$sql = "INSERT INTO historico SET data_viewer = NOW(), id_aluno = :id_aluno, id_aula = :id_aula";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_aluno", $id_aluno);
			$sql->bindValue(":id_aula", $id);
			$sql->execute();
		}

		public function getAulasDoModulo($id){

			$array = array();

			$sql = "SELECT * FROM aulas WHERE id_modulo = :id ORDER BY ordem";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id", $id);
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetchAll();

				foreach ($array as $aulachave => $aula) {
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

			/*$sql = "SELECT 
						tipo 
					,(SELECT 
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
			$sql->execute();*/

			$sql = "SELECT tipo FROM aulas WHERE id = :id_aula";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_aula", $id_aula);
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

				//$array['assistido'] = $row['assistido'];
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

		public function addAula($id_curso, $id_modulo, $nome, $tipo){

			$ordem = 1;

			$sql = "SELECT ordem FROM aulas WHERE id_modulo = :id_modulo ORDER BY ordem DESC LIMIT 1";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_modulo", $id_modulo);
			$sql->execute();

			if($sql->rowCount() > 0){
				$sql = $sql->fetch();
				$ordem = intval($sql['ordem']);
				$ordem++;
			}

			$sql = "INSERT INTO aulas SET id_modulo = :id_modulo, id_curso = :id_curso, ordem = :ordem, tipo = :tipo";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_modulo", $id_modulo);
			$sql->bindValue(":id_curso", $id_curso);
			$sql->bindValue(":ordem", $ordem);
			$sql->bindValue(":tipo", $tipo);
			$sql->execute();

			$id_aula = $this->db->lastInsertId();

			if($tipo == 'video'){
				$sql = "INSERT INTO videos SET id_aula = :id_aula, nome = :nome";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(":id_aula", $id_aula);
				$sql->bindValue(":nome", $nome);
				$sql->execute();				
			}else{
				$sql = "INSERT INTO questionarios SET id_aula = :id_aula";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(":id_aula", $id_aula);
				$sql->execute();
			}
		}

		public function delAula($id_aula){

			$sql = "DELETE FROM aulas WHERE id = :id_aula";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_aula", $id_aula);
			$sql->execute();			

			$sql = "DELETE FROM questionarios WHERE id_aula = :id_aula";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_aula", $id_aula);
			$sql->execute();

			$sql = "DELETE FROM videos WHERE id_aula = :id_aula";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_aula", $id_aula);
			$sql->execute();

			$sql = "DELETE FROM historico WHERE id_aula = :id_aula";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_aula", $id_aula);
			$sql->execute();			
		}

		public function updateVideoAula($id_aula,$nome,$descricao,$url){

			$sql = "UPDATE videos SET nome = :nome_aula, descricao = :descricao, url = :url WHERE id_aula = :id_aula";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_aula", $id_aula);
			$sql->bindValue(":nome_aula", $nome);
			$sql->bindValue(":descricao", $descricao);
			$sql->bindValue(":url", $url);
			$sql->execute();
		}	

		public function updateQuestionarioAula($id_aula,$pergunta,$opcao1,$opcao2,$opcao3,$opcao4,$resposta){

			$sql = "UPDATE questionarios SET pergunta = :pergunta, opcao1 = :opcao1, opcao2 = :opcao2, opcao3 = :opcao3, opcao4 = :opcao4, resposta = :resposta WHERE id_aula = :id_aula";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_aula", $id_aula);
			$sql->bindValue(":pergunta", $pergunta);
			$sql->bindValue(":opcao1", $opcao1);
			$sql->bindValue(":opcao2", $opcao2);
			$sql->bindValue(":opcao3", $opcao3);
			$sql->bindValue(":opcao4", $opcao4);
			$sql->bindValue(":resposta", $resposta);
			$sql->execute();
		}			
	}
 ?>