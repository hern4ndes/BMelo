<?php include ("header_admin.php");?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dados da Empresa</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Empresa
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
                                        <label>Nome Empresa</label>
                                        <input class="form-control" name="nome" value="<?php echo $form_nome;?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Titulo Sobre a Empresa</label>
                                        <input class="form-control" name="titulo" value="<?php echo $form_titulo;?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Texto Sobre a Empresa</label>
                                        <textarea class="form-control" rows="3" name="texto_sobre" required><?php echo $form_texto_sobre;?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Texto do Econtre-nos</label>
                                        <textarea class="form-control" rows="3" name="texto_encontre_nos" required><?php echo $form_texto_encontre_nos;?></textarea>
                                    </div>
                                    <div class="col-lg-4">
                                         <div class="form-group">
                                        <label>Telefones</label>
                                        <input class="form-control" name="telefones" value="<?php echo $form_telefones;?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                         <div class="form-group">
                                        <label>E-mail</label>
                                        <input class="form-control" name="email" value="<?php echo $form_email;?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                         <div class="form-group">
                                        <label>Dias/Horário Funcionamento</label>
                                        <input class="form-control" name="funcionamento" value="<?php echo $form_funcionamento;?>">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label>Link Facebook</label>
                                        <input class="form-control" placeholder="http://facebook.com/" name="link_facebook" value="<?php echo $form_link_facebook;?>">
                                    </div>
                                     <div class="form-group">
                                        <label>Link Instagram</label>
                                        <input class="form-control" placeholder="http://instagram.com/" name="link_instagram" value="<?php echo $form_link_instagram;?>">
                                    </div>
                                     <div class="form-group">
                                        <label>Link Twitter</label>
                                        <input class="form-control" placeholder="http://twitter.com/" name="link_twitter" value="<?php echo $form_link_twitter;?>">
                                    </div>
                                     <div class="form-group">
                                        <label>Texto na Barra do Slider</label>
                                        <input class="form-control" name="texto_slide" value="<?php echo $form_texto_slide;?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Titulo no Texto da página principal</label>
                                        <input class="form-control" name="titulo_texto_index" value="<?php echo $form_titulo_texto_index;?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Texto da página principal</label>
                                        <textarea class="form-control" rows="3" name="texto_index" required><?php echo $form_texto_index;?></textarea>
                                    </div>


                                    <div class="form-group">
                                        <label>Texto Rodapé</label>
                                        <textarea class="form-control" rows="3" name="texto_rodape"><?php echo $form_texto_rodape;?></textarea>
                                    </div>
                                     <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Imagem - Sobre nós</label>
                                            <p class="help-block">(Sugestão: Formato JPG e Dimensões:470 x 310 pixels)</p>
                                            <input type="file" name="imagem_sobre_nos" value="<?php echo $form_imagem_sobre_nos;?>">
                                        </div>

                                        <ul class="thumbnails">
                                            <li class="span4">
                                                <a href="#" class="thumbnail inner-border">
                                                    <span></span>
                                                    <img src="
                                                        <?php if(!isset($form_imagem_sobre_nos)){?>
                                                            http://placehold.it/470x310
                                                        <?php }else{ 
                                                            echo base_url("imagens/institucional/$form_imagem_sobre_nos");
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