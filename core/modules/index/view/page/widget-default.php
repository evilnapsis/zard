<?php
$post=PostData::getById($_GET["id"]);
Viewer::addView($post->id,"post_id","post_view");

?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<h1><?php echo $post->title;?></h1>
	<hr>

<div class="row">
		<div class="col-md-9">

<?php if($post->show_image&&$post->image_id!=null):
$image = ImageData::getById($post->image_id);
?>
<br>
<img src="storage/images/<?php echo $image->src;?>" class="img-responsive img-thumbnail" style="width:480px;">
<?php endif;?>


		<?php echo nl2br($post->content);?>
		<br><br>
		<?php if($post->accept_comments):?>
		<h4>Deja un comentario</h4>
<form role="form" method="post" action="./?r=index/addcomment">
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Nombre">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Correo electronico</label>
    <input type="email" name="email" required class="form-control" id="exampleInputEmail1" placeholder="Correo Electronico">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Comentario</label>
    <textarea class="form-control" name="comment" required rows="4" placeholder="Escribe tu comentario ..."></textarea>
  </div>
  <input type="hidden" name="post_id" value="<?=$post->id;?>">
  <button type="submit" class="btn btn-default">Enviar comentario</button>
</form>
<?php endif;?>
		</div>
		<div class="col-md-3">
		</div>
	</div>

		<br><br>

		</div>
	</div>
	
</div>
