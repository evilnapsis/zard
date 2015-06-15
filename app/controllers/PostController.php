<?php

class PostController {
	public $default_layout = "admin-layout";

	public function addAction(){
		$p = new PostData();
		$p->title = $_POST["title"];
		$p->content = $_POST["content"];
		if(isset($_POST["is_public"])){ $p->is_public=1;}
		if(isset($_POST["accept_comments"])){ $p->accept_comments=1;}
		if(isset($_POST["show_image"])){ $p->show_image=1;}
		$p->user_id = 1;

		if(isset($_FILES["image"])){
			$image=new Upload($_FILES["image"]);
			if($image->uploaded){
				$image->Process("storage/images/");
				if($image->processed){
					$img = new ImageData();
					$img->src = $image->file_dst_name;
					$img->user_id=$_SESSION["user_id"];
					$imgx=$img->add();
					$p->image_id=$imgx[1];
				}
			}
		}

		$px = $p->add();

		if(isset($_POST["category_id"])&&count($_POST["category_id"])>0){
			foreach ($_POST["category_id"] as $cat) {
				$pc = new PostCategoryData();
				$pc->post_id = $px[1];
				$pc->category_id = $cat;
				$pc->add();
			}
		}


		Core::redir("./?r=admin/posts");
	}

	public function addpageAction(){
		$p = new PostData();
		$p->title = $_POST["title"];
		$p->content = $_POST["content"];
		if(isset($_POST["is_public"])){ $p->is_public=1;}
		if(isset($_POST["accept_comments"])){ $p->accept_comments=1;}
		if(isset($_POST["show_image"])){ $p->show_image=1;}
		$p->user_id = 1;

		if(isset($_FILES["image"])){
			$image=new Upload($_FILES["image"]);
			if($image->uploaded){
				$image->Process("storage/images/");
				if($image->processed){
					$img = new ImageData();
					$img->src = $image->file_dst_name;
					$img->user_id=$_SESSION["user_id"];
					$imgx=$img->add();
					$p->image_id=$imgx[1];
				}
			}
		}

		$px = $p->addpage();


		Core::redir("./?r=admin/pages");
	}


	public function updateAction(){
		$p = PostData::getById($_POST["id"]);
		$p->title = $_POST["title"];
		$p->content = $_POST["content"];
		if(isset($_POST["is_public"])){ $p->is_public=1;}
		if(isset($_POST["accept_comments"])){ $p->accept_comments=1;}
		if(isset($_POST["show_image"])){ $p->show_image=1;}
		$p->update();

if(isset($_POST["category_id"])&&count($_POST["category_id"])>0){
		$sels = $_POST["category_id"];
		$asigs = PostCategoryData::getAllByPostId($_POST["id"]);
		$categories = CategoryData::getAll();
		foreach($categories as $category){
				$pc = PostCategoryData::getByPC($_POST["id"],$category->id);
				if($pc!=null){$pc->del();}
				foreach ($sels as $sel) {
					if(PostCategoryData::getByPC($_POST["id"],$sel)==null){
						$pc = new PostCategoryData();
						$pc->post_id = $_POST["id"];
						$pc->category_id = $sel;
						$pc->add();
					}
				}
		}
		}

		Core::redir("./?r=admin/editpost&id=".$_POST["id"]);
	}

	public function updatepageAction(){
		$p = PostData::getById($_POST["id"]);
		$p->title = $_POST["title"];
		$p->content = $_POST["content"];
		if(isset($_POST["is_public"])){ $p->is_public=1;}else{ $p->is_public=0;}
		if(isset($_POST["accept_comments"])){ $p->accept_comments=1;}else{ $p->accept_comments=0;}
		if(isset($_POST["show_image"])){ $p->show_image=1;}else{ $p->show_image=0;}
		$p->update();

		Core::redir("./?r=admin/editpage&id=".$_POST["id"]);
	}

	public function newpostAction(){
		View::render($this,"admin/newpost");
	}

	public function homeAction(){
		$meta = array("title"=>"Hello LB");
		Session::setFlashMsg("mensaje","Hola wey");
		Core::redir("./?r=index/index");
		//View::render($this,"index",array("meta"=>$meta));
	}


}


?>