<?php include ("header.php");?>

                <?php if($this->session->flashdata('msg')): ?>

                    <div class="alert alert-<?php echo $this->session->flashdata("tipo_msg");?> alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p><?php echo $this->session->flashdata('msg');?></p>
                    </div>

                <?php endif; ?>
                <div class="slider">
                    <div class="fullwidthbanner-container">
                        <div class="fullwidthbanner">
                            <ul>

                                 <?php if(count($sliders) > 0){

                                    foreach($sliders as $registro){
                                    ?>

                                    <li class="first-slide" data-transition="fade" data-slotamount="10" data-masterspeed="300">
                                        <img src="<?php echo base_url("imagens/slider/".$registro->imagem); ?>" data-fullwidthcentering="on" alt="slide">
                                        <div class="tp-caption first-line lft tp-resizeme start" data-x="left" data-hoffset="0" data-y="180" data-speed="1000" data-start="200" data-easing="Power4.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0" data-endelementdelay="0"><?php echo $registro->texto_destaque; ?></div>
                                        <div class="tp-caption first-line lft tp-resizeme start" data-x="left" data-hoffset="0" data-y="340" data-speed="1000" data-start="200" data-easing="Power4.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0" data-endelementdelay="0"><div class="line-dec"></div></div>
                                        <div class="tp-caption second-line lfb tp-resizeme start" data-x="left" data-hoffset="0" data-y="380" data-speed="1000" data-start="800" data-easing="Power4.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0" data-endelementdelay="0"><?php echo $registro->subtitulo; ?></div>
                                        <div class="tp-caption first-banner-button sfb tp-resizeme start container border-button" data-x="left" data-hoffset="0" data-y="450" data-speed="1000" data-start="2200" data-easing="Power4.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0" data-endelementdelay="0"><a href="<?php echo $registro->link_botao; ?>"><?php echo $registro->texto_botao; ?></a></div>
                                    </li>
                                    

                                <?php }

                                } ?>
                            </ul>
                        </div>
                    </div>
				</div>

				<div id="cta-1">
					<div class="container">
						<div class="row">
							<div class="col-md-12 col-md-offset-1">
								<div class="cta-content">
									<h6><?php echo trim($institucional->texto_slide);?></h6>
									<div class="buttons">
										<div class="border-button learn">
											<a href="<?php echo base_url('orcamento'); ?>">Contate-nos</a>
										</div>
										<div class="border-button buy">
											<a href="<?php echo base_url('encontre'); ?>">Enconte-nos</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
                        <section class="testimonials">
                            <div class="container">
                                <div class="row">
                                    <div class="section-heading col-md-12 text-center">
                                        <h2><?php echo $institucional->titulo_texto_index;?></h2>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="single-content">
                                        <div class="single-text">
                                            <p>
                                                <em>
                                                    <?php echo nl2br($institucional->texto_index);?>    
                                                </em>
                                            <br><br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="recent-projects full-width">
                            <div class="container">
                                <div class="row">
                                    <div class="section-heading">
                                        <h2 style="color: #637a83">Nossos Produtos</h2>
                                        <div class="line-dec"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="group">
                                        <span class="btn filter active" data-filter="all">Todos</span>
                                        <?php if(count($categorias) > 0){

                                            foreach($categorias as $key => $registro){
                                            ?>

                                            <span class="btn filter" data-filter=".category-<?php echo $registro->id;?>"><?php echo $registro->descricao;?></span>

                                        <?php }

                                        } ?>    

                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="projects">
                                    <div class="row">
                                        
                                        <?php if(count($produtos) > 0){

                                            foreach($produtos as $key => $registro){

                                            ?>

                                            <div class="mix category-<?php echo $registro->categoria_id?> col-md-3 col-sm-6 col-xs-12">
                                                <div class="thumb-holder">
                                                    <a href="<?php echo base_url('detalhe_produto/visulizar/'.$this->funcoes_gerais->criptografar($registro->id)); ?>"><img src="<?php echo base_url("imagens/produto/".$registro->imagem_galeria);?>" alt="<?php echo $institucional->titulo;?>"></a>
                                                    <div class="thumb-content">
                                                        <div class="thumb-link">
                                                            <a href="<?php echo base_url('detalhe_produto/visulizar/'.$this->funcoes_gerais->criptografar($registro->id)); ?>"><i class="fa fa-plus"></i></a>
                                                        </div>
                                                        <div class="thumb-text">
                                                            <a href="<?php echo base_url('detalhe_produto/visulizar/'.$this->funcoes_gerais->criptografar($registro->id)); ?>"><h4><?php echo $registro->nome;?></h4></a>
                                                            <span><i class="fa fa-folder-o"></i><?php echo $this->categoria->getById($registro->categoria_id)->row()->descricao;?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }

                                        } ?> 
                                        
                                    </div>
                                </div>
                            </div>
                        </section>
				</div>
				<section class="testimonials">
					<div class="container">
						<div class="row">
							<div class="section-heading col-md-12 text-center">
								<h2>Testimonial</h2>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8 col-md-offset-2">
								<div class="testimonials-slider">
									<ul class="slides">

                                        <?php if(count($testimoniais) > 0){

                                            foreach($testimoniais as $key => $registro){

                                            ?>

                                            <li data-thumb="<?php echo base_url("imagens/testimonial/".$registro->foto);?>">
                                              <div class="item">
                                                    <i class="fa fa-quote-left"></i>
                                                    <p><?php echo nl2br($registro->testemunho);?></p>
                                                    <h4><?php echo $registro->pessoa;?></h4>
                                                    <span><?php echo $registro->funcao;?></span>
                                                </div>
                                            </li>
                                            
                                        <?php }

                                        } ?> 

									</ul>
								</div>
							</div>
						</div>
					</div>
				</section>

				<section class="latest-news">
					<div class="container">
						<div class="row">
							<div class="section-heading col-md-12">
								<h2>Últimas notícias</h2>
								<div class="line-dec"></div>
							</div>
						</div>
						<div class="row">

                            <?php if(count($noticias) > 0){

                                foreach($noticias as $key => $registro){

                                ?>
                                    
                                <div class="col-md-4">
                                    <div class="latest-item">
                                        <img src="<?php echo base_url("imagens/noticia/".$registro->imagem);?>" alt="<?php echo $institucional->titulo;?>">
                                        <div class="down-content">
                                            <a href="<?php echo base_url('detalhe_noticia/visualizar/'.$this->funcoes_gerais->criptografar($registro->id)); ?>"><h4><?php echo $registro->titulo;?></h4></a>
                                            <p><?php echo nl2br(substr($registro->texto,0,150));?> ...</p>
                                            <div class="post-info">
                                                <ul>
                                                    <li><em>Por: </em><?php echo $registro->autor;?></li>
                                                    <li><a href="<?php echo base_url('detalhe_noticia/visualizar/'.$this->funcoes_gerais->criptografar($registro->id)); ?>">Ler na íntegra</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            <?php }

                            } ?> 
						</div>
					</div>
				</section>
<?php include ("footer.php");?>