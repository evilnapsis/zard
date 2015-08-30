<?php
/**
* @author evilnapsis
* @brief Agregar un usuario
**/
		$p = new UserData();
		$p->name = $_POST["name"];
		$p->username = $_POST["username"];
		$p->email = $_POST["email"];
		$p->password = sha1(md5($_POST["password"]));
		$p->kind_id = $_POST["kind_id"];

		if(isset($_FILES["image"])){
			$image=new Upload($_FILES["image"]);
			if($image->uploaded){
				$image->Process("storage/images/");
				if($image->processed){
					$p->image=$image->file_dst_name;
				}
			}
		}

		$px = $p->add();

		Core::redir("./?view=users");
?>