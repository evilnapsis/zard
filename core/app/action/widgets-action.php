<?php
$widgets = WidgetData::getPublics();
if(count($widgets)>0){
	foreach($widgets as $w){
		$widget = "<div class='panel panel-default'>";
		$widget .= "<div class='panel-heading'>".$w->title."</div>";
		$widget .="<div class='panel-body'>";
		$widget .= call_user_func(array(new Widget(),$w->func), $w->params);
		$widget.="</div></div>";
		echo $widget;
	}
}



?>