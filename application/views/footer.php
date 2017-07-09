				<footer>
					<div class="container">
						<div class="row">
							<div class="col-md-3 col-sm-6 col-xs-12">
								<div class="about-us">
									<img src="<?php echo base_url('assets/images/logo-2.png');?>" alt="<?php echo $institucional->titulo;?>">
									<p><?php echo nl2br($institucional->texto_rodape);?></p>
								</div>
							</div>
							<div class="col-md-3 col-sm-6 col-xs-12">
								<div class="company-pages">
									<h2>Site</h2>
									<ul class="first-list">
										<li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-angle-double-right"></i>Home</a></li>
										<li><a href="<?php echo base_url('sobre'); ?>"><i class="fa fa-angle-double-right"></i>Sobre nós</a></li>
                                        <li><a href="<?php echo base_url('orcamento'); ?>"><i class="fa fa-angle-double-right"></i>Solicitar Orçamento</a></li>
                                        <li><a href="<?php echo base_url('encontre'); ?>"><i class="fa fa-angle-double-right"></i>Encontre-nos</a></li>
									</ul>

								</div>
							</div>
							<div class="col-md-3 col-sm-6 col-xs-12">
								
							</div>
							<div class="col-md-3 col-sm-6 col-xs-12">
								<form role="form" action="<?php echo base_url('interessado/cadastrar'); ?>" method="POST" enctype="multipart/form-data" target="_blank">
                                	<div class="subscribe-us">
										<h2>Quer receber informativos?</h2>
										<input type="text" class="email" name="email" placeholder="" value="" required>
										<div class="accent-button">
											<button type="submit" class="btn btn-primary">Quero receber</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</footer>

				<div id="sub-footer">
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<p><?php echo $institucional->nome;?> &copy; <?php echo mdate('%Y');?>. Todos os direitos reservados</p>
                            </div>
                        </div>
                    </div>
                </div>

		</div>

		<nav class="sidebar-menu slide-from-left">
			<div class="nano">
				<div class="content">
					<nav class="responsive-menu">
						<ul>
							<li><a href="<?php echo base_url('home'); ?>">Home</a></li>
							<li><a href="<?php echo base_url('sobre'); ?>">Sobre nós</a></li>
                            <li class="menu-item-has-children"><a href="#">Produtos</a>
                                <ul class="sub-menu">
                                    <?php echo $this->funcoes_gerais->getMenuCategorias();?>
                                </ul>
                            </li>
							<li><a href="<?php echo base_url('orcamento'); ?>">Solicitar Orçamento</a></li>
							<li><a href="<?php echo base_url('encontre'); ?>">Encontre-nos</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</nav>

	</div>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
 	 var js, fjs = d.getElementsByTagName(s)[0];
  	if (d.getElementById(id)) return;
  	js = d.createElement(s); js.id = id;
  	js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.5";
  	fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.11.1.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
	<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
    <script src="<?php echo base_url('assets/rs-plugin/js/jquery.themepunch.tools.min.js');?>"></script>
    <script src="<?php echo base_url('assets/rs-plugin/js/jquery.themepunch.revolution.min.js');?>"></script>

	<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/custom.js');?>"></script>

</body>
</html>