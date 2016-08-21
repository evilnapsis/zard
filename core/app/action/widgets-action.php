<?php
$categories = CategoryData::getAll();
?>
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
