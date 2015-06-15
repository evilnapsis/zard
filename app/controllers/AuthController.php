<?php

class AuthController {
	public $default_layout = "layout";

	public function indexAction(){
		$meta = array("title"=>"Register, Login, Recover and Admin by Evilnapsis");
		View::render($this,"index/index",array("meta"=>$meta));
	}

	public function configAction(){
		$meta = array("title"=>"Register, Login, Recover and Admin by Evilnapsis");
		View::render($this,"index/config",array("meta"=>$meta));
	}


	public function registerAction(){
		$meta = array("title"=>"Registro | RLRA");
		View::render($this,"index/register",array("meta"=>$meta));
	}

	public function activateAction(){
		$meta = array("title"=>"Registro | RLRA");
		View::render($this,"index/activate",array("meta"=>$meta));
	}


	public function loginAction(){
		$meta = array("title"=>"Login | RLRA");
		View::render($this,"index/login",array("meta"=>$meta));
	}

	public function deleteuserAction(){
		$user = UserData::getById($_SESSION["user_id"]);
		if($user->is_admin){
			RecoverData::deleteFromUserId($_GET["id"]);
			UserData::delete($_GET["id"]);
			Core::alert("Usuario eliminado!");
			Core::redir("./?r=index/home");
		}
		Core::redir("./");
	}


	public function recoverAction(){
		$meta = array("title"=>"Recover | RLRA");
		View::render($this,"index/recover",array("meta"=>$meta));
	}

	public function getcodeAction(){
		if(!empty($_POST)){
			if($_POST["email"]!=""){
				$user = UserData::getByEmail($_POST["email"]);
				if($user!=null){
					if($user->is_active){
						$mycode = RecoverData::getUnUsedByUserId($user->id);
						$code= "";
						if($mycode==null){
								$str = "abcdefghijklmopqrstuvwxyz1234567890";
								$code = "";
								for ($i=0; $i < 6; $i++) { 
									$code .= $str[rand(0,strlen($str)-1)];
								}
								
		
								$recover = new RecoverData();
								$recover->user_id = $user->id;
								$recover->code = $code;
								$recover->add();
							}else{
								$code = $mycode->code;
							}


						$msg = "<body><h1>Codigo de recuperacion</h1>
						<p>Ahora puedes recuperar tu cuenta en el siguiente link:</p>
						<p><a href='http://youhost/app/index.php?r=index/processcode&e=".sha1(md5($_POST["email"]))."&c=".sha1(md5($code))."'>Activa tu cuenta:</a></p>
						<p>O tambien puedes usar el siguiente codigo de activacion: ".$code."</p>
						</body>";
		
			//			mail($_POST["email"], "Codigo de recuperacion", $msg);
			
						$f = fopen (ROOT."/recover.txt","w");
						fwrite($f, $msg);
						fclose($f);

						Core::alert("Se ha enviado un mensaje a tu correo electronico con los datos necesarios para recuperar su cuenta.");
						Core::redir("./?r=index/recover");



					}
					else{
						Core::alert("El usuario debe estar activo");
						Core::redir("./?r=index/activate");
					}


				}else{
					Core::alert("Usuario no existe");
					Core::redir("./?r=index/recover");
				}
				
			}
		}
	}


	public function homeAction(){
		if(Session::exists("user_id")){
			$user = UserData::getById(Session::get("user_id"));
			if($user!=null){
				$meta = array("title"=>"User Dashboard");
				View::render($this,"index/home",array("user"=>$user,"meta"=>$meta));
			}
		}
	}

	public function processlogoutAction(){
		Session::delete("user_id");
		session_destroy();
		Core::redir("./?r=admin/index");
	}


	public function processloginAction(){
		if(!empty($_POST)){
			if($_POST["email"]!=""&&$_POST["password"]!=""){
				$user = UserData::getLogin($_POST["email"],$_POST["password"]);
				if($user!=null){
					if($user->is_active){
						Session::set("user_id",$user->id);
						Core::redir("./?r=admin/index");
					}else{						
						Core::alert("Usuario inactivo");
						Core::redir("./?r=admin/index");
					}
				}else{
					Core::alert("Datos incorrectos");
					Core::redir("./?r=admin/index");
				}
			}else{
				Core::alert("Datos vacios");
				Core::redir("./?r=admin/index");
			}
		}
	}

	public function processactivationAction(){
		if(!empty($_POST)){
			if($_POST["email"]!=""&&$_POST["code"]!=""){
				$user = UserData::getByEmail($_POST["email"]);
				if(!$user->is_active){
					if($user->code==$_POST["code"]){
						$user->activate();
						Core::alert("Cuenta activada exitosamente, se iniciara su sesion, despues podra iniciar sesion con sus datos");
						$_SESSION["user_id"]=$user->id;
						Core::redir("./?r=index/home");					
					}
				}else{
					Core::alert("Este usuario esta activo");
					Core::redir("./?r=index/login");					
				}
			}

			else{
				Core::alert("Datos vacios");
				Core::redir("./?r=index/activate");
			}
		}
		else if($_GET["e"]!=""&&$_GET["c"]!=""){
				$users = UserData::getInactives();
				$user = null;
				foreach ($users as $u) {
					if(sha1(md5($u->email))==$_GET["e"] ){
						$user=$u;
						break;
					}
				}

				if($user!=null){
					if(sha1(md5($user->code))==$_GET["c"] ){
						$user->activate();
						Core::alert("Cuenta activada exitosamente, se iniciara su sesion, despues podra iniciar sesion con sus datos");
						$_SESSION["user_id"]=$user->id;
						Core::redir("./?r=index/home");					

					}else{
						Core::redir("./");					
					}

				}else{					
					Core::redir("./	");					
				}

			}
	}

	public function changepasswordAction(){
		if(!empty($_POST)){
			if($_POST["password"]!=""&&$_POST["confirm"]!=""){
				if($_POST["password"]==$_POST["confirm"]){
					$user=UserData::getById($_SESSION["user_id"]);
					$user->password = sha1(md5($_POST["password"]));
					$user->update_passwd();
					Core::alert("Contrase~a actualizada!");
					Core::redir("./?r=index/config");
				}else{
					Core::alert("Las contrase~as no coinciden");
					Core::redir("./?r=index/config");
				}	
			}else{
				Core::alert("Datos vacios!");
				Core::redir("./?r=index/config");

			}
		}
	}


	public function processcodeAction(){
		if(!empty($_POST)){
			if($_POST["email"]!=""&&$_POST["code"]!=""){
				$user = UserData::getByEmail($_POST["email"]);
				if($user->is_active){
					$recover = RecoverData::getUnUsedByUserId($user->id);
					if($recover!=null){
						if($recover->code==$_POST["code"]){
							$recover->used();
							$_SESSION["user_id"] = $user->id;
							Core::alert("Se iniciara sesion en su cuenta, aproveche para cambiar su contrase&ntile;a");
							Core::redir("./?r=index/home");					
						}
						else{					
							Core::alert("Codigo de recuperacion invalido");
							Core::redir("./?r=index/recover");					
						}

					}else{					
						Core::alert("No cuenta con codigo de recuperacion, debe solicitar uno");
						Core::redir("./?r=index/recover");					
					}
				}else{
					Core::alert("Este usuario no esta activo");
					Core::redir("./?r=index/login");					
				}
			}

			else{
				Core::alert("Datos vacios");
				Core::redir("./?r=index/activate");
			}
		}
		else if($_GET["e"]!=""&&$_GET["c"]!=""){
				$users = UserData::getActives();
				$user = null;
				foreach ($users as $u) {
					if(sha1(md5($u->email))==$_GET["e"] ){
						$user=$u;
						break;
					}
				}

				if($user!=null){
					$recover = RecoverData::getUnUsedByUserId($user->id);
					if($recover!=null){
						if(sha1(md5($recover->code))==$_GET["c"] ){
							$recover->used();
							Core::alert("Se iniciara sesion en su cuenta, aproveche para cambiar su contrase&ntile;a");
							$_SESSION["user_id"]=$user->id;
							Core::redir("./?r=index/home");					

						}else{
							Core::alert("Codigo invalido");
							Core::redir("./");					
						}
					}else{
						Core::alert("No existe el codigo");
						Core::redir("./");
					}


				}else{					
					Core::redir("./	");					
				}

			}
	}


	public function processregisterAction(){
		if(!empty($_POST)){
			if($_POST["name"]!=""&&$_POST["lastname"]!=""&&$_POST["email"]!=""&&$_POST["password"]!=""){
				$user = UserData::getByEmail($_POST["email"]);
				if($user==null){
					$str = "abcdefghijklmopqrstuvwxyz1234567890";
					$code = "";
					for ($i=0; $i < 6; $i++) { 
						$code .= $str[rand(0,strlen($str)-1)];
					}
					
	
					$user = new UserData();
					$user->name = $_POST["name"];
					$user->lastname = $_POST["lastname"];
					$user->email = $_POST["email"];
					$user->password = sha1(md5($_POST["password"]));
					$user->code = $code;
					$user->add();
	
					$msg = "<body><h1>Registro Exitoso</h1>
					<p>Ahora debes activar tu cuenta en el siguiente link:</p>
					<p><a href='http://youhost/app/index.php?r=index/processactivation&e=".sha1(md5($_POST["email"]))."&c=".sha1(md5($code))."'>Activa tu cuenta:</a></p>
					<p>O tambien puedes usar el siguiente codigo de activacion: ".$code."</p>
					</body>";
	
					mail($_POST["email"], "Registro Exitoso", $msg);
					$f = fopen (ROOT."/register.txt","w");
					fwrite($f, $msg);
					fclose($f);
					Core::alert("Registro Exitoso!, se ha enviado un correo electronico con los datos necesarios para activar su cuenta.");
					Core::redir("./?r=index/login");
				}else{
					Core::alert("El email proporcionado ya esta registrado.");
					Core::redir("./?r=index/register");

				}
			}else{
				Core::alert("No puede dejar campos vacios");				
				Core::redir("./?r=index/register");
			}
		}

//		Core::redir("./");
		//View::render($this,"index",array("meta"=>$meta));
	}


}


?>