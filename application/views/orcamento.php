<?php include ("header.php");?>
				<div id="page-heading">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<h1>Solicitação de Orçamento</h1>
								<span>Diga-nos oque você precisa e cuidaremos do resto.</span>
							</div>
						</div>
					</div>
				</div>

				<section class="contact-form">
					<div class="container">
						<div class="row">
							<div class="col-md-8">
								<div class="contact-form">
									<form id="contact_form" action="" method="POST" enctype="multipart/form-data">

	                               <?php if (validation_errors()): ?>

	                                        <div class="alert alert-danger alert-dismissable">
	                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                            <?php echo validation_errors('<p>', '</p>'); ?>
	                                        </div>

                                    <?php endif; ?>


										<?php if($this->session->flashdata('msg')): ?>

										    <div class="alert alert-<?php echo $this->session->flashdata("tipo_msg");?> alert-dismissable">
										        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										        <p><?php echo $this->session->flashdata('msg');?></p>
										    </div>

										<?php endif; ?>


										<div class="row">
											<div class="col-md-12">
												<input type="text" class="name" name="interessado" placeholder="Seu nome" value="" required>
											</div>
											<div class="col-md-12">
												<input type="text" class="email" name="email" placeholder="E-mail" value="" required>
											</div>
                                            <div class="col-md-12">
                                                <input type="text" class="email" name="telefone" placeholder="Telefone" value="" required>
                                            </div>
											<div class="col-md-12">
												<textarea id="message" class="message" name="mensagem" 
												placeholder="Conte-nos oque você precisa, logo entraremos em contato." required><?php echo $produtos;?>
												</textarea>
											</div>
											<div class="col-md-4">
												<div class="accent-button">
													<input type="submit" value="Solicitar Orçamento" class="btn btn-primary">
												</div>
											</div>
										</div>
									</form>		
								</div>
							</div>
							<div class="col-md-4">
								<div class="right-info">
									<h4>Informações de Contato</h4>
									<div class="line-dec"></div>
									<p><?php echo nl2br($institucional->texto_encontre_nos);?></p>
                                    <ul>
                                        <li><i class="fa fa-phone"></i><?php echo $institucional->telefones;?></li>
                                        <li><i class="fa fa-envelope"></i><?php echo $institucional->email;?></li>
                                        <li><i class="fa fa-clock-o"></i><?php echo $institucional->funcionamento;?></li>
                                    </ul>
								</div>
							</div>
						</div>
					</div>
				</section>
                <!-- Google Map Init-->
                <script src="https://maps.googleapis.com/maps/api/js"></script>
<?php include ("footer.php");?>