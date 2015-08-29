<?php
/**
* @author evilnapsis
* @brief Agregar categorias
**/
		$cat = new CategoryData();
		$cat->name = $_POST["name"];
		$cat->add();
		Core::redir("./?view=categories");
?>