<?php
/**
* @author evilnapsis
* @brief Eliminar una categoria
**/
		$cat = CategoryData::getById($_GET["id"]);
		$cat->del();
		Core::redir("./?r=admin/categories");
?>