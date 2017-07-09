<?php include ("header_admin.php");?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Cadastro de Slider</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Slider
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
                                        <label>Texto Destaque</label>
                                        <input class="form-control" name="texto_destaque" value="<?php echo $form_texto_destaque;?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Subtitulo</label>
                                        <input class="form-control" name="subtitulo" value="<?php echo $form_subtitulo;?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Texto Botão</label>
                                        <input class="form-control" name="texto_botao" value="<?php echo $form_texto_botao;?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Link Botão</label>
                                        <input class="form-control" placeholder="http://exemplo.com" name="link_botao" value="<?php echo $form_link_botao;?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Imagem Slider </label>
                                        <p class="help-block">(Sugestão: Formato JPG e Dimensões:1600 x 615 pixels)</p>
                                        <input type="file" name="imagem" value="<?php echo $form_imagem;?>" <?php if(!isset($form_id)){?>
                                                        required
                                                        <?php }?>>
                                    </div>
                                    <div class="col-lg-6">
                                    <ul class="thumbnails">
                                        <li class="span4">
                                            <a href="#" class="thumbnail inner-border">
                                                <span></span>
                                                <img src="
                                                        <?php if(!isset($form_id)){?>
                                                            http://placehold.it/1600x615
                                                        <?php }else{ 
                                                            echo base_url("imagens/slider/$form_imagem");
                                                        } ?>
                                                        " alt="">
                                            </a>
                                        </li>
                                    </ul>
                                        </div>
                                    <div class="col-lg-12">
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