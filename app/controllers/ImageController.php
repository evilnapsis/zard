<?php

class ImageController {
	public $default_layout = "admin-layout";

	public function addAction(){
		$p = new PostData();

		if(isset($_FILES["image"])){
			$image=new Upload($_FILES["image"]);
			if($image->uploaded){
				$image->Process("storage/images/");
				if($image->processed){
					$img = new ImageData();
					$p->title = $_POST["title"];
					$p->content = $_POST["content"];

					$img->src = $image->file_dst_name;
					$img->user_id=$_SESSION["user_id"];
					$imgx=$img->add();
				}
			}
		}
		Core::redir("./?r=admin/galery");
	}

	public function updateAction(){
		$p = ImageData::getById($_POST["id"]);
		$p->title = $_POST["title"];
		$p->description = $_POST["description"];
		if(isset($_POST["is_public"])){ $p->is_public=1;}
		$p->user_id = 2;
		$p->update();


		Core::redir("./?r=admin/editimage&id=".$_POST["id"]);
	}


	public function newAction(){
		View::render($this,"image/new");
	}

	public function delAction(){
		ImageData::delById($_GET["id"]);
		Core::redir("./?r=admin/galery");
	}


}


?>