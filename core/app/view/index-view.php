<div class="container">
	<div class="row">
		<div class="col-md-9">
		<?php 
		$posts = PostData::getLast(10); 
		?>
		<?php foreach($posts as $post):?>
<?php if($post->image_id!=null):
$image = ImageData::getById($post->image_id);
?>
<img src="admin/storage/images/<?php echo $image->src;?>" class="img-responsive img-thumbnail" style="width:180px;">
<div class="clearfix"></div>
<?php endif;?>		
				<h2><a href="./?view=post&id=<?php echo $post->id; ?>"><?php echo $post->title;?></a></h2>
				<p class="text-muted"><i class='fa fa-clock-o'></i> <?php echo date("d-M-Y h:i:s",strtotime($post->created_at)); ?></p>
				<p><?php echo $post->content;?></p>
				<a href="./?view=post&id=<?php echo $post->id; ?>" class="btn btn-default"> Leer mas <i class="fa fa-arrow-right"></i> </a>
				<hr>
			<?php endforeach; ?>
		</div>
		<div class="col-md-3">
		<?php Action::execute("widgets",array());?>
		</div>
	</div>
</div>
