<?php
/**
* @author evilnapsis
* @brief Agregar un mensaje
**/
		$comment = new CommentData();
		$comment->name = $_POST["name"];
		$comment->email = $_POST["email"];
		$comment->content = $_POST["comment"];
		$comment->addmsg();
		Core::redir("./?view=contact");
?>