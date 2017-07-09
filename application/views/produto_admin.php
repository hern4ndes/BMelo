<?php include ("header_admin.php");?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Cadastro de Produto</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Produto
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
                                        <label>Nome do Produto</label>
                                        <input class="form-control" name="nome" value="<?php echo $form_nome;?>" required>
                                        <p class="help-block">Examplo: Corrimão de parede.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Categoria do Produto</label>
                                        <?php
                                        $dados_select = array('primary_key' => 'id',
                                            'nome' => 'descricao',
                                            'tabela' => 'categoria',
                                            'condicao' => ' where status = true order by descricao',
                                            'nome_input' => 'categoria_id',
                                            'id' => 'categoria_id',
                                            'class' => 'form-control',
                                            'onchange' => null,
                                            'disabled' => null,
                                            'required' => true,
                                            'value' => $form_categoria_id);

                                        $this->funcoes_gerais->geraSelect($dados_select, "Informe uma categoria");

                                        ?>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Produto Imagem Galeria</label>
                                            <p class="help-block">(Sugestão: Formato JPG e Dimensões:270 x 270 pixels)</p>
                                            <input type="file" name="imagem_galeria" value="<?php echo $form_imagem_galeria;?>" <?php if(!isset($form_id)){?>
                                                        required
                                                        <?php }?>>
                                        </div>

                                        <ul class="thumbnails">
                                            <li class="span4">
                                                <a href="#" class="thumbnail inner-border">
                                                    <span></span>
                                                    <img src="
                                                       <?php if(!isset($form_id)){?>
                                                            http://placehold.it/270x270
                                                        <?php }else{ 
                                                            echo base_url("imagens/produto/$form_imagem_galeria");
                                                        } ?>
                                                    " alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-lg-4">

                                        <div class="form-group">
                                            <label>Produto Imagem #1</label>
                                            <p class="help-block">(Sugestão: Formato JPG e Dimensões:670 x 400 pixels)</p>
                                            <input type="file" name="imagem_1" value="<?php echo $form_imagem_1;?>" <?php if(!isset($form_id)){?>
                                                        required
                                                        <?php }?>>
                                        </div>

                                        <ul class="thumbnails">
                                            <li class="span4">
                                                <a href="#" class="thumbnail inner-border">
                                                    <span></span>
                                                    <img src="
                                                       <?php if(!isset($form_id)){?>
                                                            http://placehold.it/670x400
                                                        <?php }else{ 
                                                            echo base_url("imagens/produto/$form_imagem_1");
                                                        } ?>
                                                    " alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Produto Imagem #2</label>
                                            <p class="help-block">(Sugestão: Formato JPG e Dimensões:670 x 400 pixels)</p>
                                            <input type="file" name="imagem_2" value="<?php echo $form_imagem_2;?>" <?php if(!isset($form_id)){?>
                                                        required
                                                        <?php }?>>
                                        </div>

                                        <ul class="thumbnails">
                                            <li class="span4">
                                                <a href="#" class="thumbnail inner-border">
                                                    <span></span>
                                                    <img src="
                                                       <?php if(!isset($form_id)){?>
                                                            http://placehold.it/670x400
                                                        <?php }else{ 
                                                            echo base_url("imagens/produto/$form_imagem_2");
                                                        } ?>
                                                    " alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Detalhes descritivos do produto</label>
                                        <textarea class="form-control" rows="3" name="detalhes"><?php echo $form_detalhes;?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Especificações técnicas</label>
                                        <textarea class="form-control" rows="3" name="especificacoes"><?php echo $form_especificacoes;?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label> <input type="checkbox" name="novidade" value="1" <?php if($form_novidade) echo 'checked';?>/> É novidade? </label>
                                    </div>
                                    <button type="submit" class="btn btn-default">Salvar</button>
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