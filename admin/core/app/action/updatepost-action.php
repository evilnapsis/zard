<?php
/**
* @author evilnapsis
* @brief Actualizar los datos de un articulo
**/
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

		Core::redir("./?view=editpost&id=".$_POST["id"]);
?>