<?php

class IndexController {
	public $default_layout = "layout";

	public function indexAction(){
		$meta = array("title"=>".: Wolf Blog :.");
		View::render($this,"index/index",array("meta"=>$meta));
	}

	public function contactAction(){
		$meta = array("title"=>".: Contactame :.");
		View::render($this,"index/contact",array("meta"=>$meta));
	}


	public function postAction(){
		$meta = array("title"=>".: Ver post | Wolf :.");
		View::render($this,"index/post",array("meta"=>$meta));
	}

	public function pageAction(){
		$meta = array("title"=>".: Ver pagina | Wolf :.");
		View::render($this,"index/page",array("meta"=>$meta));
	}


	public function addcommentAction(){
		$comment = new CommentData();
		$comment->name = $_POST["name"];
		$comment->email = $_POST["email"];
		$comment->content = $_POST["comment"];
		$comment->post_id = $_POST["post_id"];
		$comment->add();
		Core::redir("./?r=index/post&id=$_POST[post_id]");
	}

	public function addmsgAction(){
		$comment = new CommentData();
		$comment->name = $_POST["name"];
		$comment->email = $_POST["email"];
		$comment->content = $_POST["comment"];
		$comment->addmsg();
		Core::redir("./?r=index/contact");
	}


}


?>