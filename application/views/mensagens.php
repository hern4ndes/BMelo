<?php include ("header_admin.php");?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Mensagens</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Solicitações de Orçamentos via Site
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">

                                <?php if($this->session->flashdata('msg')): ?>

                                    <div class="alert alert-<?php echo $this->session->flashdata("tipo_msg");?> alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p><?php echo $this->session->flashdata('msg');?></p>
                                    </div>

                                <?php endif; ?>


                                <table class="table table-striped table-bordered table-hover dataTables-list" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>Ações</th>
                                        <th>Interessado</th>
                                        <th>Email</th>
                                        <th>Mensagem</th>
                                        <th>Data</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php if(count($registros) > 0){

                                        foreach($registros as $registro){
                                        ?>

                                        <tr class="odd gradeA">
                                            <td><a href="<?php echo base_url('mensagem/visualizar/'.$this->funcoes_gerais->criptografar($registro->id)); ?>" title="Visualizar"><i class="fa fa-fw fa-eye"></i></a>
                                                <a href="<?php echo base_url('mensagem/remover/'.$this->funcoes_gerais->criptografar($registro->id)); ?>" title="Excluir"><i class="fa fa-fw fa-times"></i></a></td>
                                            <td><?php echo $registro->interessado;?></td>
                                            <td><?php echo $registro->email;?></td>
                                            <td class="center"><?php echo nl2br(substr($registro->mensagem,0,150));?> ... </td>
                                            <td class="center"><?php echo $registro->created;?></td>
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