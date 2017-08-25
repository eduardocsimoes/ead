<?php
	class homeController extends controller{

		public function __construct(){

			$u = new Usuarios();
			if(!$u->verificarLogin()){
				header("Location: ".BASE_URL."login");
			}
		}

		public function index(){

			$dados = array(
				'cursos' => array()
			);

			$cursos = new Cursos();
			$dados['cursos'] = $cursos->getCursos();
			
			$this->loadTemplate('home', $dados);
		}

		public function excluir($id){

			$c = new Cursos();
			$c->excluir($id);

			header("Location: ".BASE_URL);
		}

		public function adicionar(){

			$dados = array();

			$c = new Cursos();

			if(isset($_POST['nome']) && !empty($_POST['nome'])){
				$nome = $_POST['nome'];
				$descricao = $_POST['descricao'];
				$imagem = $_FILES['imagem'];

				if(!empty($imagem['tmp_name'])){
					$md5name = $nome.".jpg";
					$types = array('image/jpeg', 'image/jpg', 'image/png');

					if(in_array($imagem['type'], $types)){
						move_uploaded_file($imagem['tmp_name'], "../assets/images/cursos/".$md5name);

						$c->adicionar($nome, $descricao, $md5name);

						header("Location: ".BASE_URL);
					}
				}
			}

			$this->loadTemplate("curso_add", $dados);
		}

		public function editar($id){

			$dados = array(
				'curso' => array(),
				'modulos' => array()
			);

			$cursos = new Cursos();
			$modulos = new Modulos();
			$aulas = new Aulas();

			if(isset($_POST['nome']) && !empty($_POST['nome'])){
				$nome = addslashes($_POST['nome']);
				$descricao = addslashes($_POST['descricao']);
				$imagem = $_FILES['imagem'];

				if(!empty($imagem['tmp_name'])){

					$md5name = $nome.'.jpg';
					$types = array('image/jpeg','image/jpg','image/png');

					if(in_array($imagem['type'], $types)){
						move_uploaded_file($imagem['tmp_name'], "../assets/images/cursos/".$md5name);

						$cursos->updateCurso($id,$nome,$descricao,$md5name);
					}
				}

				$cursos->updateCurso($id,$nome,$descricao);

				header("Location: ".BASE_URL);
			}

			if(isset($_POST['modulo']) && !empty($_POST['modulo'])){
				$modulo = addslashes($_POST['modulo']);
				$modulos->addModulo($id,$_POST['modulo']);
			}

			if(isset($_POST['aula']) && !empty($_POST['aula'])){
				$aula = addslashes($_POST['aula']);
				$moduloaula = addslashes($_POST['moduloaula']);
				$tipo = addslashes($_POST['tipo']);

				$aulas->addAula($id, $moduloaula, $aula, $tipo);
			}

			$dados['curso'] = $cursos->getCurso($id);

			$dados['modulos'] = $modulos->getModulos($id);

			$this->loadTemplate('curso_edit', $dados);
		}

		public function del_modulo($id){

			$modulos = new Modulos();

			if(!empty($id)){
				$id = addslashes($id);

				$id_curso = $modulos->getModulo($id);
				$modulos->delModulo($id);

				header("Location: ".BASE_URL."home/editar/".$id_curso['id_curso']);
			}else{
				header("Location: ".BASE_URL);
			}
		}

		public function edit_modulo($id_modulo){

			$array = array();

			$modulos = new Modulos();

			if(isset($_POST['modulo']) && !empty($_POST['modulo'])){
				$nome = addslashes($_POST['modulo']);

				$id_curso = $modulos->getModulo($id_modulo);
				$modulos->updateModulo($id_modulo,$nome);

				header("Location: ".BASE_URL."home/editar/".$id_curso['id_curso']);
			}

			$array['modulo'] = $modulos->getModulo($id_modulo);

			$this->loadTemplate('curso_edit_modulo', $array);
		}	

		public function del_aula($id_aula){

			$aulas = new Aulas();

			if(!empty($id_aula)){
				$id = addslashes($id_aula);

				$id_curso = $aulas->getCursoDaAula($id_aula);
				$aulas->delAula($id_aula);

				header("Location: ".BASE_URL."home/editar/".$id_curso['id_curso']);
			}else{
				header("Location: ".BASE_URL);
			}
		}

		public function edit_aula($id_aula){

			$array = array();
			
			$aulas = new Aulas();

			$array['aula'] = $aulas->getAula($id_aula);

			if(isset($_POST['nome']) && !empty($_POST['nome'])){
				$nome = addslashes($_POST['nome']);
				$descricao = addslashes($_POST['descricao']);
				$url = addslashes($_POST['url']);

				$id_curso = $aulas->getCursoDaAula($id_aula);
				$aulas->updateVideoAula($id_aula,$nome,$descricao,$url);

				header("Location: ".BASE_URL."home/editar/".$id_curso['id_curso']);
			}

			if(isset($_POST['pergunta']) && !empty($_POST['pergunta'])){
			
				$pergunta = addslashes($_POST['pergunta']);
				$opcao1 = addslashes($_POST['opcao1']);
				$opcao2 = addslashes($_POST['opcao2']);
				$opcao3 = addslashes($_POST['opcao3']);
				$opcao4 = addslashes($_POST['opcao4']);
				$resposta = addslashes($_POST['resposta']);

				$id_curso = $aulas->getCursoDaAula($id_aula);
				$aulas->updateQuestionarioAula($id_aula,$pergunta,$opcao1,$opcao2,$opcao3,$opcao4,$resposta);

				header("Location: ".BASE_URL."home/editar/".$id_curso['id_curso']);
			}

			if($array['aula']['tipo'] == 'video'){
				$view = 'curso_edit_aula_video';
			}else{
				$view = 'curso_edit_aula_poll';
			}

			$this->loadTemplate($view, $array);
		}	
	}
?>