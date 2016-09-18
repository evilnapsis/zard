<?php
$data["images"]= ImageData::getAll();
?>
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <i class="fa fa-picture-o"></i> Galeria 
                        </h1>
                        <ol class="breadcrumb">
                            <li class="">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                            <li class="active">
                                <i class="fa fa-picture-o"></i> Galeria
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                    <a href="./?view=newimage" class="btn btn-default">Agregar</a><br><br>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-th-list fa-fw"></i> Imagenes</h3>
                            </div>
                                <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table datatable table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Vista previa</th>
                                                <th>Titulo</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($data["images"] as $post):
                                        ?>
                                            <tr>
                                                <td style="width:10px;"></td>
                                                <td style="width:120px;">
                                                	<img src="storage/images/<?php echo $post->src;?>" style="width:120px;">
                                                </td>
                                                <td><?=$post->title;?></td>
                                                <td style="width:90px;">
                                                <a href="./?view=editimage&id=<?=$post->id;?>" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                                <a href="./?action=delimage&id=<?=$post->id;?>" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->