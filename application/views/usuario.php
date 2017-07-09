<?php include ("header_admin.php");?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Cadastro de Usuário</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Usuário
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

                                    <input type="hidden" name="matricula" value="<?php echo $form_matricula;?>">
                                    <input type="hidden" name="acessos" value="<?php echo $form_acessos;?>">
                                    
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input class="form-control" name="nome" value="<?php echo $form_nome;?>" required>
                                        <p class="help-block">Examplo: Antonio José Silva.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input class="form-control" placeholder="E-mail" name="email" value="<?php echo $form_email;?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Senha</label>
                                        <input class="form-control" type="password" placeholder="Senha" name="senha" value="" required>
                                        <label></label>
                                        <input class="form-control" type="password" placeholder="Repetir Senha" name="re_senha" value="" required>
                                    </div>
                                    <button type="submit" class="btn btn-default">Salvar</button>
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