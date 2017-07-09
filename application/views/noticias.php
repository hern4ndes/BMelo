<?php include ("header_admin.php");?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Notícias</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Notícias a serem exibidas na seção "Últimas Notícias"
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
                                            <th>Titulo notícia</th>
                                            <th>Notícia</th>
                                            <th>Author</th>
                                            <th>Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php if(count($registros) > 0){

                                            foreach($registros as $registro){
                                            ?>

                                            <tr class="odd gradeA">
                                                <td><a href="<?php echo base_url('noticia/atualizar/'.$this->funcoes_gerais->criptografar($registro->id)); ?>" title="Editar"><i class="fa fa-fw fa-edit"></i></a>
                                                    <a href="<?php echo base_url('noticia/remover/'.$this->funcoes_gerais->criptografar($registro->id)); ?>" title="Excluir"><i class="fa fa-fw fa-times"></i></a></td>
                                                <td><?php echo $registro->titulo;?></td>
                                                <td><?php echo nl2br(substr($registro->texto,0,150));?> ...</td>
                                                <td><?php echo $registro->autor;?></td>
                                                <td><?php echo $registro->created;?></td>
                                            </tr>
                                            

                                        <?php }
                                        } ?>
                                    </tbody>
                                </table>

                                <a href="<?php echo base_url('noticia/cadastrar'); ?>" class="pull-right btn btn-primary btn-lg">Criar Notícia</a>
                                        
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