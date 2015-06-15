<?php

class AdminController {
	public $default_layout = "admin-layout";

	public function indexAction(){
		$meta = array("title"=>"MM");
		View::render($this,"admin/index",array("meta"=>$meta));
	}



	public function commentsAction(){
		View::render($this,"admin/comments",array());
	}



	public function msgsAction(){
		View::render($this,"admin/msgs",array());
	}

	public function newpostAction(){
		View::render($this,"admin/newpost");
	}

	public function newuserAction(){
		View::render($this,"admin/newuser");
	}

	public function newpageAction(){
		View::render($this,"admin/newpage");
	}


	public function newcategoryAction(){
		View::render($this,"admin/newcategory");
	}

	public function editpostAction(){
		View::render($this,"admin/editpost");
	}

	public function edituserAction(){
		View::render($this,"admin/edituser");
	}


	public function editpageAction(){
		View::render($this,"admin/editpage");
	}

	public function editimageAction(){
		View::render($this,"admin/editimage");
	}

	public function postsAction(){
		View::render($this,"admin/posts",array("posts"=>PostData::getAll()));
	}

	public function generalcfgAction(){
		View::render($this,"admin/generalcfg",array("posts"=>ConfigData::getAll()));
	}


	public function pagesAction(){
		View::render($this,"admin/pages",array("posts"=>PostData::getPages()));
	}

	public function usersAction(){
		View::render($this,"admin/users",array("posts"=>UserData::getAll()));
	}


	public function galeryAction(){
		View::render($this,"admin/galery",array("images"=>ImageData::getAll()));
	}


	public function categoriesAction(){
		View::render($this,"admin/categories",array("categories"=>CategoryData::getAll()));
	}
	//add section

	public function addcategoryAction(){
		$cat = new CategoryData();
		$cat->name = $_POST["name"];
		$cat->add();
		Core::redir("./?r=admin/categories");
	}

	//update section

	public function updatecategoryAction(){
		$cat = CategoryData::getById($_POST["id"]);
		$cat->name = $_POST["name"];
		$cat->update();
		Core::redir("./?r=admin/categories");
	}

	public function updgeneralcfgAction(){
		foreach ($_POST as $k => $v) {
			$key = ConfigData::getByKey($k);
			$key->description = $v;
			$key->update();
		}
		Core::redir("./?r=admin/generalcfg");
	}


	public function aprovecommentAction(){
		$cat = CommentData::getById($_GET["id"]);
		$cat->aprove();
		Core::redir("./?r=admin/comments");
	}

	public function answercommentAction(){
		$cat = new CommentData();
		$cat->content = $_POST["content"];
		$cat->comment_id = $_POST["comment_id"];
		$cat->answer();
		Core::redir("./?r=admin/comments");
	}

	public function answermsgAction(){
		$msg = CommentData::getById($_POST["comment_id"]);
		mail($msg->email, "Respuesta", $_POST["content"]);
		Core::redir("./?r=admin/msgs");
	}

	// delete section

	public function deletecategoryAction(){
		$cat = CategoryData::getById($_GET["id"]);
		$cat->del();
		Core::redir("./?r=admin/categories");
	}

	public function delpageAction(){
		PostData::delById($_GET["id"]);
		Core::redir("./?r=admin/pages");
	}

}


?>