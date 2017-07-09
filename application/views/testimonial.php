<?php include ("header_admin.php");?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Testimonial</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Declaração a ser exibida na seção "Testimonial"
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form" action="" method="POST" enctype="multipart/form-data">
                                    <?php if (validation_errors()): ?>

                                        <div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <?php echo validation_errors('<p>', '</p>'); ?>
                                        </div>

                                    <?php endif; ?>


                                    <input type="hidden" name="id" value="<?php echo $form_id;?>">

                                    <div class="form-group">
                                        <label>Pessoa</label>
                                        <input class="form-control" name="pessoa" value="<?php echo $form_pessoa;?>" required>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Miniatura da Pessoa</label>
                                            <p class="help-block">(Sugestão: Formato JPG e Dimensões:66 x 66 pixels)</p>
                                            <input type="file" name="foto" value="<?php echo $form_foto;?>" <?php if(!isset($form_id)){?>
                                                        required
                                                        <?php } ?>>
                                        </div>

                                        <ul class="thumbnails">
                                            <li class="span4">
                                                <a href="#" class="thumbnail inner-border">
                                                    <span></span>
                                                    <img src="<?php if(!isset($form_id)){?>
                                                        http://placehold.it/66x66
                                                        <?php }else{ 
                                                            echo base_url("imagens/testimonial/$form_foto");
                                                        } ?>
                                                        " alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>



                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Testemunho</label>
                                            <textarea class="form-control" rows="3" name="testemunho" required>
                                                <?php echo $form_testemunho;?>
                                            </textarea>
                                        </div>
                                    <div class="form-group">
                                        <label>Função</label>
                                        <input class="form-control" type="text" name="funcao" value="<?php echo $form_funcao;?>" required>
                                    </div>
                                    <button type="submit" class="btn btn-default">Salvar</button>
                                        </div>
                                </form>
                            </div>

                            <!-- /.col-lg-12 (nested) -->
                        </div>
                        <!-- /.row (nested) -->
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