<?php include ("header_admin.php");?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Notícia</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Postagem
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
                                        <label>Título da Notícia</label>
                                        <input class="form-control" name="titulo" value="<?php echo $form_titulo;?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Autor</label>
                                        <input class="form-control" name="autor" value="<?php echo $form_autor;?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Texto</label>
                                        <textarea class="form-control" rows="3" name="texto" required><?php echo $form_texto;?></textarea>
                                    </div>
                                     <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Imagem da Notícia</label>
                                            <p class="help-block">(Sugestão: Formato JPG e Dimensões:1600 x 1059 pixels)</p>
                                            <input type="file" name="imagem" value="<?php echo $form_imagem;?>" >
                                        </div>

                                        <ul class="thumbnails">
                                            <li class="span4">
                                                <a href="#" class="thumbnail inner-border">
                                                    <span></span>
                                                    <img src="
                                                    <?php if(!isset($form_imagem)){?>
                                                            ../assets/images/1600x1059.jpg
                                                        <?php }else{ 
                                                            echo base_url("imagens/noticia/$form_imagem");
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