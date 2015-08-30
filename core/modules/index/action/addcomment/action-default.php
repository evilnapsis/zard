<?php
/**
* @author evilnapsis
* @brief Agregar un comentario
**/
		$comment = new CommentData();
		$comment->name = $_POST["name"];
		$comment->email = $_POST["email"];
		$comment->content = $_POST["comment"];
		$comment->post_id = $_POST["post_id"];
		$comment->add();
		Core::redir("./?view=post&id=$_POST[post_id]");
?>