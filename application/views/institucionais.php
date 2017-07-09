<?php include ("header_admin.php");?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Intitucional</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Informações e serem exibidas na guia "Sobre"e "Encontre-nos"
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

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Ações</th>
                                            <th>Nome da Empresa</th>
                                            <th>Titulo Sobre a Empresa</th>
                                            <th>Texto Sobre a empresa</th>
                                            <th>Texto Enconte-nos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                         
                                        <?php if(count($registros) > 0){

                                            foreach($registros as $registro){
                                            ?>

                                            <tr class="odd gradeA">
                                                <td><a href="<?php echo base_url('institucional/atualizar/'.$this->funcoes_gerais->criptografar($registro->id)); ?>" title="Editar"><i class="fa fa-gear"></i></a>
                                                    </td>
                                                <td><?php echo $registro->nome;?></td>
                                                <td><?php echo $registro->titulo;?></td>
                                                <td><?php echo nl2br($registro->texto_sobre);?></td>
                                                <td><?php echo nl2br($registro->texto_encontre_nos);?></td>
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