<?php
/**
* @author evilnapsis
* @brief Agregar un articulo
**/
		$p = new PostData();
		$p->title = $_POST["title"];
		$p->content = $_POST["content"];
		if(isset($_POST["is_public"])){ $p->is_public=1;}
		if(isset($_POST["accept_comments"])){ $p->accept_comments=1;}
		if(isset($_POST["show_image"])){ $p->show_image=1;}
		$p->user_id = 1;

		if(isset($_FILES["image"])){
			$image=new Upload($_FILES["image"]);
			if($image->uploaded){
				$image->Process("storage/images/");
				if($image->processed){
					$img = new ImageData();
					$img->src = $image->file_dst_name;
					$img->user_id=$_SESSION["user_id"];
					$imgx=$img->add();
					$p->image_id=$imgx[1];
				}
			}
		}

		$px = $p->add();

		if(isset($_POST["category_id"])&&count($_POST["category_id"])>0){
			foreach ($_POST["category_id"] as $cat) {
				$pc = new PostCategoryData();
				$pc->post_id = $px[1];
				$pc->category_id = $cat;
				$pc->add();
			}
		}


		Core::redir("./?view=posts");
?>