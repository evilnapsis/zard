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
		<?php Action::execute("widgets",array());?>
		</div>
	</div>
</div>
