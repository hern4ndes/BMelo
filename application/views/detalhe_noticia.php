<?php include ("header.php");
$server = $_SERVER['SERVER_NAME'];
$endereco = $_SERVER ['REQUEST_URI'];
?>
                <div id="page-heading">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<h1><?php echo $institucional->nome;?> Posts</h1>
								<span style="color: #fff">Aqui você encontra artigos, notícias e posts da <?php echo $institucional->nome;?></span>
							</div>
						</div>
					</div>
				</div>

				<section class="blog-classic">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="blog-posts">
									<div class="blog-post">
										<img src="<?php echo base_url("imagens/noticia/$form_imagem");?>" alt="">
										<div class="down-content">
											<div class="date">
												<p><span><?php echo $form_created;?></span></p>
											</div>
											<div class="right-cotent">
												<h4><?php echo $form_titulo;?></h4>
												<ul>
													<li>Por: <?php echo $form_autor;?></li>
												</ul>
												

											</div>
											<p style="text-align:justify"><?php echo nl2br($form_texto);?></p>
											</br>
	<div class="fb-like" data-href=<?php echo "http://" . $server . $endereco;?> data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>

										</div>
										
									</div>


								</div>
							</div>

						</div>
					</div>
				</section>
<?php include ("footer.php");?>
