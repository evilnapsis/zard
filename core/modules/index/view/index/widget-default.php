<?php
$categories = CategoryData::getAll();
?>
<div class="container">
	<div class="row">
		<div class="col-md-9">
		<?php 
		$posts = PostData::getLast10(); 
		?>
		<?php foreach($posts as $post):?>
				<h2><a href="./?view=post&id=<?php echo $post->id; ?>"><?php echo $post->title;?></a></h2>
				<p><?php echo $post->content;?>.</p>
				<a href="./?view=post&id=<?php echo $post->id; ?>" class="btn btn-default"> Leer mas <i class="fa fa-arrow-right"></i> </a>
			<?php endforeach; ?>
		</div>
		<div class="col-md-3">
		<?php if(count($categories)>0):?>
		<div class="panel panel-default">
		<div class="panel-heading">CATEGORIAS</div>
		<div class="list-group">
		<?php foreach($categories as $cat):?>
		  <a href="#" class="list-group-item"><?=$cat->name;?></a>
		<?php endforeach;?>
		</div>
		</div>
		<?php endif;?>
		</div>
	</div>
</div>
