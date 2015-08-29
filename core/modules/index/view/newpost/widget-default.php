
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Nuevo Articulo
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                  <a href="./?r=admin/index"><i class="fa fa-dashboard"></i> Dashboard</a>
                            </li>
                            <li>
                                  <a href="./?r=admin/posts"><i class="fa fa-file"></i> Posts</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-asterisk"></i> Nuevo post
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-8">

                        <form role="form" method="post" action="./?r=post/add" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Titulo</label>
                                <input type="text" name="title" class="form-control" placeholder="Escriba titulo">
                            </div>



                            <div class="form-group">
                                <label>Contenido</label>
                                <textarea class="form-control"  placeholder="Escriba contenido" rows="10" name="content"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Imagen destacada</label>
                                <input type="file" name="image">
                            </div>
                            <div class="form-group">
                                <label>Categorias</label>
                                <?php
                                    $cats = CategoryData::getAll();
                                ?>
                                <?php if(count($cats)>0):?>
                                    <?php foreach($cats as $cat):?>
                                <label >
                                    <input type="checkbox" name="category_id[]" value="<?=$cat->id;?>"> <?=$cat->name;?>
                                </label>
                                <?php endforeach;?>
                                <?php endif;?>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="is_public"> Publicar
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="accept_comments" checked> Aceptar comentarios
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="show_image"> Mostrar imagen destacada
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">Publicar</button>
                            <button type="reset" class="btn btn-default">Reset</button>

                        </form>

                    </div>
                    <div class="col-lg-3">


                    </div>
                </div>
                <!-- /.row -->
<br><br><br><br><br>