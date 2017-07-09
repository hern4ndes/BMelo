<?php include ("header_admin.php");?>
    <div id="page-wrapper" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Mensagens
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-envelope-o"></i>  <a href="index.php">Mensagens</a>
                        </li>
                        <li class="active">
                            <i class="fa fa fa-user"></i> Interessado
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <!-- Main jumbotron for a primary marketing message or call to action -->
            <div class="jumbotron">
                <h2><strong><?php echo $form_interessado;?></strong></h2>
                <p><?php echo nl2br($form_mensagem);?></p>
                <p><strong>E-mail: </strong><?php echo $form_email;?></br>
                    <strong>Telefone: </strong><?php echo $form_telefone;?>7</br>
                    <strong>Data: </strong> <?php echo $form_created;?>
                </p>
            </div>
            <p><a href="<?php echo base_url('mensagem'); ?>" class="btn btn-primary btn-lg" role="button">Voltar &raquo;</a>
            </p>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
<?php include ("footer_admin.php");?>