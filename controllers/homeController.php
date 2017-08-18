<?php 
	class homeController extends controller{

		public function index(){

			$usuarios = new Usuarios();

			$dados = array(
				'nome' => $usuarios->getNome()
			);

			$this->loadTemplate('home', $dados);
		}
	}
 ?>