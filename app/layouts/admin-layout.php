<?php 
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DashBoard | WOLF 1.0</title>

    <!-- Bootstrap Core CSS -->
    <link href="res/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->

<?php if(isset($_SESSION["user_id"])):?>
    <link href="res/css/sb-admin.css" rel="stylesheet">
<?php endif;?>
<script src="res/jquery.min.js"></script>
<script src="res/morris/raphael-min.js"></script>
<script src="res/morris/morris.js"></script>
  <link rel="stylesheet" href="res/morris/morris.css">
  <link rel="stylesheet" href="res/morris/example.css">

<script src="res/datatables/jquery.dataTables.js"></script>
<script src="res/datatables/dataTables.bootstrap.js"></script>


    <!-- Custom Fonts -->
    <link href="res/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<style type="text/css">
    .container-fluid {
        min-height: 100%;
    }
</style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<?php if(isset($_SESSION["user_id"])):
$user=UserData::getById($_SESSION["user_id"]);
?>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><b>WOLF</b> <sup>0.8</sup></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-left top-nav">
            <li><a href="./">Ver Blog</a></li>
            <li><a href="./?r=admin/newpost"><i class="fa fa-asterisk"></i> Nuevo Post</a></li>
            </ul>

            <ul class="nav navbar-right top-nav">
                <!--
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
              -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user->name;?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="./?r=admin/edituser&id=<?php echo $_SESSION['user_id'];?>"><i class="fa fa-fw fa-user"></i> Perfil</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="./?r=auth/processlogout"><i class="fa fa-fw fa-power-off"></i> Salir</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="./?r=admin/index"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="./?r=admin/posts"><i class="fa fa-fw fa-th-large"></i> Posts</a>
                    </li>
                    <li>
                        <a href="./?r=admin/galery"><i class="fa fa-fw fa-picture-o"></i> Galeria</a>
                    </li>
                    <li>
                        <a href="./?r=admin/pages"><i class="fa fa-fw fa-file"></i> Paginas</a>
                    </li>

                    <li>
                        <a href="./?r=admin/comments"><i class="fa fa-fw fa-comments"></i> Comentarios</a>
                    </li>
                    <li>
                        <a href="./?r=admin/msgs"><i class="fa fa-fw fa-envelope-o"></i> Mensajes</a>
                    </li>

                    <li>
                        <a href="./?r=admin/categories"><i class="fa fa-fw fa-th-list"></i> Categorias</a>
                    </li>
                            <li>
                                <a href="./?r=admin/users"><i class="fa fa-fw fa-users"></i> Usuarios</a>
                            </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-cogs"></i> Configuracion <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="./?r=admin/generalcfg">General</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid" >

<?php 
    require_once(View::$content);
?>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php else:?>
<br><br><br><br><br><div class="container">
    <div class="row">

        <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
        <div class="panel-heading">
        Login
        </div>
        <div class="panel-body">
        <form role="form" method="post" action="./?r=auth/processlogin">
  <div class="form-group">
    <label for="exampleInputEmail1">Correo electronico</label>
    <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Correo electronico">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-block btn-default">Acceder</button>
<!--<br>  <a href="./?r=auth/recover">Olvide mi contrase&ntilde;a ...</a>-->
</form>
        </div>
        </div>
        <!-- -->

        </div>
    </div>
</div>

<?php endif;?>
<script>
    $(".datatable").dataTable();
</script>
    <!-- jQuery Version 1.11.0 -->
    <script src="res/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="res/js/bootstrap.min.js"></script>


</body>

</html>
