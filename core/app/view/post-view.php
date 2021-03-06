<?php
$post=PostData::getById($_GET["id"]);
$comments = CommentData::getApprovedByPostId($post->id);
Viewer::addView($post->id,"post_id","post_view");
?>
<div class="container">
	<div class="row">
		<div class="col-md-9">
    <?php if(isset($_SESSION["user_id"])):?>
      <p><a href="./admin/?view=editpost&id=<?php echo $post->id; ?>" class="btn btn-warning">Modificar Articulo</a>
    <?php endif;?>
		<h1><?php echo $post->title;?></h1>
        <p class="text-muted"><i class='fa fa-clock-o'></i> <?php echo date("d-M-Y h:i:s",strtotime($post->created_at)); ?></p>
	<hr>
<?php if($post->show_image&&$post->image_id!=null):
$image = ImageData::getById($post->image_id);
?>
<br>
<img src="admin/storage/images/<?php echo $image->src;?>" class="img-responsive img-thumbnail">
<?php endif;?>
<div class="clearfix"></div>
<div>
		<?php echo nl2br($post->content);?>
</div>
		<br><br>
<?php if(count($comments)>0):?>
<h4>Comentarios (<?php echo count($comments)?>)</h4>
<ul class="media-list">
<?php foreach($comments as $comment):
$answers = CommentData::getApprovedByCommentId($comment->id);
?>
  <li class="media">
    <div class="media-body">
      <h4 class="media-heading"><?php echo $comment->name;?></h4>
      <p><?php echo $comment->content; ?></p>
<?php if(count($answers)>0):?>
<?php foreach($answers as $answer):
?>

  <div class="media">
    <div class="media-body">
      <h4 class="media-heading"><?php echo $answer->name;?></h4>
      <p><?php echo $answer->content; ?></p>
    </div>
  </div>

<?php endforeach; ?>
<?php endif; ?>

    </div>

  </li>

<?php endforeach; ?>
</ul>
<?php endif;?>
<div class="row">
<div class="col-md-7">
    <div class="well">
    <h4>Deja un comentario</h4>
<form role="form" method="post" action="./?action=addcomment">
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" name="name" required class="form-control" id="exampleInputEmail1" placeholder="Nombre">
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
</div>
</div>
</div>
		<br><br>

		</div>
<div class="col-md-3">
		<?php Action::execute("widgets",array());?>
		</div>
	</div>
	
</div>
</div>