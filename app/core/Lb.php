<?php


// 14 de Octubre del 2014
// Lb.php
// @brief el objeto legobox
// estoy inspirado : 14/oct/2014 - 0:55am - viendo : un millon de formas de morir en el oeste por 2da vez el dia de hoy
class Lb {

	public function Lb(){
		$this->get = new Get();
		$this->post = new Post();
		$this->request = new Request();
		$this->cookie = new Cookie();
		$this->session = new Session();
		$this->default_controller ="index";
		$this->default_view ="index";
	}

	public function loadModule($module){

			if(!isset($_GET['module'])){

				if(isset($_GET["r"])){
					$d = explode("/", $_GET["r"]);
					if(count($d)!=2){
						echo "Invalid <b>R</b> parameters";
						exit;
					}else{

						if($d[0]!=""&&$d[1]!=""){
							$this->default_controller = $d[0];
							$this->default_view = $d[1];
						}
					}
				}


				$this->default_controller = $this->default_controller."Controller";
				require_once "app/controllers/".$this->default_controller.".php";
				$controller = new $this->default_controller;
				$method = $this->default_view."Action";
				if(method_exists($controller, $method)){
					$data = call_user_method($method, $controller);
				}else{
					echo "<b>".$method."</b> not found in ".$this->default_controller;
				}

			}else{
			}

	}

}

?>