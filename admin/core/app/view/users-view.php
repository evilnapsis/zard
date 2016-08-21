<?php
$data["posts"]=UserData::getAll();
?>
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Usuarios
                        </h1>
                        <ol class="breadcrumb">
                            <li class="">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                            <li class="active">
                                <i class="fa fa-users"></i> Usuarios
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                    <a href="./?view=newuser" class="btn btn-default">Agregar</a><br><br>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-users fa-fw"></i> Usuarios</h3>
                            </div>
                                    <table class="table datatable table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Nombre</th>
                                                <th>Nombre de usuario</th>
                                                <th>Email</th>
                                                <th>Tipo</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($data["posts"] as $post):?>
                                            <tr>
                                                <td></td>
                                                <td><?=$post->name;?></td>
                                                <td><?=$post->username;?></td>
                                                <td><?=$post->email;?></td>
                                                <td><?=$post->getKind()->name;?></td>
                                                <td style="width:70px;">
                                                <a href="./?view=edituser&id=<?=$post->id;?>" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                                <a href="./?action=deluser&id=<?=$post->id;?>" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->