<?php

class UserController {
	public $default_layout = "admin-layout";

	public function addAction(){
		$p = new UserData();
		$p->name = $_POST["name"];
		$p->username = $_POST["username"];
		$p->email = $_POST["email"];
		$p->password = $_POST["password"];
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

		//Core::redir("./?r=admin/users");
	}



	public function updateAction(){
		$p = UserData::getById($_POST["id"]);
		$p->name = $_POST["name"];
		$p->username = $_POST["username"];
		$p->email = $_POST["email"];
		$p->password = $_POST["password"];
		$p->kind_id = $_POST["kind_id"];
		$p->update();

		if(isset($_FILES["image"])){
			$image=new Upload($_FILES["image"]);
			if($image->uploaded){
				$image->Process("storage/images/");
				if($image->processed){
					$p = UserData::getById($_POST["id"]);
					$p->image=$image->file_dst_name;
					$p->update_image();
				}
			}
		}


		if($_POST["password"]!=""){
		$p = UserData::getById($_POST["id"]);
		$p->password=$_POST["password"];
		$p->update_passwd();

		}



		Core::redir("./?r=admin/edituser&id=".$_POST["id"]);
	}



}


?>