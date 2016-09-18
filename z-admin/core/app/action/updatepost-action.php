<?php
/**
* @author evilnapsis
* @brief Actualizar los datos de un articulo
**/
		$p = PostData::getById($_POST["id"]);
		$p->title = $_POST["title"];
		$p->content = $_POST["content"];
		$p->status = $_POST["status"];
		$p->visibility = $_POST["visibility"];

		if(isset($_POST["accept_comments"])){ $p->accept_comments=1;}
		if(isset($_POST["show_image"])){ $p->show_image=1;}
		$p->update();

if(isset($_POST["category_id"])&&count($_POST["category_id"])>0){
		$sels = $_POST["category_id"];
		$asigs = PostTaxData::getAllByPostId($_POST["id"]);
		$categories = TaxData::getCategories();
		foreach($categories as $category){
				$pc = PostTaxData::getByPC($_POST["id"],$category->id);
				if($pc!=null){$pc->del();}
				foreach ($sels as $sel) {
					if(PostTaxData::getByPC($_POST["id"],$sel)==null){
						$pc = new PostTaxData();
						$pc->post_id = $_POST["id"];
						$pc->tax_id = $sel;
						$pc->add();
					}
				}
		}
		}

		Core::redir("./?view=editpost&id=".$_POST["id"]);
?>