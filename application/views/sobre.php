<?php include ("header.php");?>
<div id="page-heading">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<h1>Sobre a <?php echo $institucional->nome;?></h1>
								<span style="color: #fff">Indústria e Comércio</span>
							</div>
						</div>
					</div>
				</div>

				<section class="expert-field">
					<div class="container">
						<div class="row">
							<div class="col-md-5">
								<div class="left-image">
									<?if(isset($institucional->imagem_sobre_nos)){?>
										<img src="<?php echo base_url("imagens/institucional/".$institucional->imagem_sobre_nos); ?>" alt="">
									<?php } ?>
								</div>
							</div>
							<div class="col-md-7">
								<div class="expert-content">
									<h4><?php echo $institucional->titulo;?></h4>
									<div class="line-dec"></div>
									<p><?php echo nl2br($institucional->texto_sobre);?></p>

								</div>
							</div>
						</div>
					</div>
				</section>
<?php include ("footer.php");?>