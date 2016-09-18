<html>
<head>
<meta charset="utf8"/>
<title>.: Zard :.</title>

<link rel="stylesheet" type="text/css" href="admin/z-assets/res/bootstrap3/css/bootstrap.min.css">
<script src="admin/z-assets/res/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="admin/z-assets/res/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="admin/z-assets/navbar-xs.css">
</head>
<?php 
/// print_r($_GLOBAL); 
?>
<body>
<?php if(isset($_SESSION["user_id"])):?>

<nav class="navbar navbar-inverse navbar-xs" role="navigation">
<div class="container">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="./admin/"><b>Zard</b> Dashboard</a>
  </div>
  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Nuevo<b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="./admin/?view=newpost">Post</a></li>
          <li><a href="./admin/?view=newpage">Pagina</a></li>
        </ul>
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
  </div>
</nav>

<?php endif; ?>
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
          <li><a href="./?view=contact"> CONTACTO</a></li>
      </ul>
    <ul class="nav navbar-nav navbar-right">
      <li>
        <form class="navbar-form navbar-left" role="search">
        <input type="hidden" name="view" value="search">
      <div class="form-group">
        <input type="text" name="q" required class="form-control" placeholder="Buscar ...">
      </div>
      <button type="submit" class="btn btn-default">&nbsp;<i class="fa fa-search"></i>&nbsp;</button>
    </form>
      </li>
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
  View::load("index");
?>
<div class="container">

<div class="row">
<div class="col-md-12">
<hr style="margin:10px 0px;">
<ul class="list-inline">
  <li><a href="./">Inicio</a></li>
  <li><a href="./?view=contact">Contacto</a></li>
  <li><a href="./admin/">Acceder</a></li>
</ul>
<p style="padding:5px 0px;"><b>ZARD CMS v1.5</b> - MIT License</p>
</div>
</div>

</div>
<script src="admin/z-assets/res/bootstrap3/js/bootstrap.min.js"></script>
</body>

</html>