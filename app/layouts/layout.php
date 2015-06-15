<?php

$meta = $data["meta"];

?>
<html>
<head>
<meta charset="utf8"/>
<title><?php echo $meta["title"];?></title>

<link rel="stylesheet" type="text/css" href="res/bootstrap3/css/bootstrap.min.css">
<script src="res/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="res/font-awesome/css/font-awesome.min.css">
</head>
<?php 
/// print_r($_GLOBAL); 
?>
<body>
<div class="container">
<div class="row">
<div class="col-md-12">
<h1><?php echo ConfigData::getByKey("site_title")->description;?></h1>
<p><?php echo ConfigData::getByKey("site_description")->description;?></p>
</div>
</div>
</div>
<header class="navbar navbar-inverse navbar-static-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./"><b><?php echo ConfigData::getByKey("navbar_text")->description;?></b></a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
          <li><a href="./"> INICIO</a></li>
          <li><a href="./?r=index/contact"> CONTACTO</a></li>
      </ul>
      <!--
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#">Link</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </li>
    </ul>
    -->
    </nav>
  </div>
</header>
<div class="clearfix"></div>
<?php 
	require_once(View::$content);
?>
<div class="container">

<div class="row">
<div class="col-md-12">
<hr style="margin:10px 0px;">
<ul class="list-inline">
  <li><a href="./">Inicio</a></li>
  <li><a href="./">Contacto</a></li>
  <li><a href="./?r=admin/index">Acceder</a></li>
</ul>
<p style="padding:5px 0px;"><b>Wolf CMS v1.0</b> - License GPLv3</p>
</div>
</div>

</div>
<script src="../res/bootstrap3/js/bootstrap.min.js"></script>
</body>

</html>