<?php
$today_visits = Viewer::countAllFromToday();
$today_posts = PostData::countAllFromToday();
$pending_comments = CommentData::countPendings();

?>
<section class="content">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="">
                            Zard <small>Vision general</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-eye fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $today_visits;?></div>
                                        <div>Visitas de Hoy</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $today_posts;?></div>
                                        <div>Articulos de Hoy</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $pending_comments;?></div>
                                        <div>Comentarios Nuevos</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-envelope-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">0</div>
                                        <div>Mensajes Nuevos</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class=""><i class="fa fa-bar-chart-o fa-fw"></i> Visitas (Ultimos 30 dias)</h3>
                            </div>
                            <div class="box-body">

<div id="graph" class="animate" data-animate="fadeInUp" ></div>

<script>

<?php 
echo "var c=0;";
echo "var dates=Array();";
echo "var data=Array();";
echo "var total=Array();";
for($i=0;$i<30;$i++){
  echo "dates[c]=\"".date("Y-m-d",time()-60*60*24*$i)."\";";
  echo "data[c]=\"".Viewer::countAllFromDay(date("Y-m-d",time()-60*60*24*$i))."\";";
  echo "total[c]={x: dates[c],y: data[c]};";
  echo "c++;";
}
?>
// Use Morris.Area instead of Morris.Line
Morris.Area({
  element: 'graph',
  data: total,
  xkey: 'x',
  ykeys: ['y',],
  labels: ['Y']
}).on('click', function(i, row){
  console.log(i, row);
});
</script>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

</section>