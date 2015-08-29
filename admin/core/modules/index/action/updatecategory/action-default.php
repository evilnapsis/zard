<?php
/**
* @author evilnapsis
* @brief Actualizar una categoria
**/
		$cat = CategoryData::getById($_POST["id"]);
		$cat->name = $_POST["name"];
		$cat->update();
		Core::redir("./?r=admin/categories");
?>