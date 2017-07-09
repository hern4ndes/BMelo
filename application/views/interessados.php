<?php include ("header_admin.php");?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Inscritos/Interessados</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Pessoas interessadas em seus produtos
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover dataTables-list" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>E-mail Inscrito</th>
                                            <th>Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(count($registros) > 0){

                                        foreach($registros as $registro){
                                        ?>

                                            <tr class="odd gradeA">
                                                <td><?php echo $registro->email;?></td>
                                                <td><?php echo $registro->created;?></td>
                                            </tr>
                                            

                                        <?php } 
                                    } ?>

                                    </tbody>
                                </table>

                            </div>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->



        </div>
        <!-- /#page-wrapper -->
<?php include ("footer_admin.php");?>