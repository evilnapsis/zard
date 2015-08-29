<?php
/**
* @author evilnapsis
* @brief Actualizar una pagina
**/
		PostData::delById($_GET["id"]);
		Core::redir("./?view=pages");
?>