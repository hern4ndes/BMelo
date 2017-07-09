<?php include ("header.php");
$server = $_SERVER['SERVER_NAME'];
$endereco = $_SERVER ['REQUEST_URI'];
?>
                <div id="page-heading">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<h1><?php echo $categoria->descricao;?></h1>
								<span style="color: #fff">Conheça nossos produtos e serviços e veja qual se encaixa melhor à sua necessidade.</span>
							</div>
						</div>
					</div>
				</div>

				<section class="single-project">
					<div class="container">

                        <?php if(count($registros) > 0){

                            foreach($registros as $registro){
                        ?>

    						<div class="row">
    							<div class="col-md-5">
    								<div class="left-info">
    									<h4><?php echo $registro->nome;?></h4>
    									<p><?php echo nl2br($registro->detalhes);?></p>
    									<ul>
    										<li><?php echo nl2br($registro->especificacoes);?></li>

    									</ul>
                                        <form role="form" action="<?php echo base_url('orcamento/addProduto'); ?>" method="POST" enctype="multipart/form-data" target="_blank">
                                            <input type="hidden" name="produto" value="<?php echo $registro->nome;?>"/>        
                    						<button onclick="" class="btn btn-primary" title="Adicionar ao Orçamento" type="submit">+ Adicionar ao Orçamento  </button> 
                                            <a href="<?php echo base_url('orcamento');?>" class="btn btn-primary" title="Finalizar Orçamento">Finalizar Orçamento</a>
                                            
                                        </form>

                                        </br></br>

                                        <h5>Não encontrou oque procurava? </h5></br>
                                        <p>Clique <a href="<?php echo base_url('orcamento');?>">aqui</a> e nos descreva oque você precisa.</p></br>
                                        <div class="fb-like" data-href=<?php echo "http://" . $server . $endereco;?> data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div></br></br>


		

    								</div>
    							</div>
    							<div class="col-md-7">
    								<div class="right-content">
    									<div class="project-owl">
                                            <?php if(isset($registro->imagem_1)){ ?>
        									    <div class="item">
        									    	<img src="<?php echo base_url("imagens/produto/". $registro->imagem_1);?>" alt="" />
        									    </div>
                                            <?php } ?>
                                            
                                            <?php if(isset($registro->imagem_2)){ ?>
        									    <div class="item">
        									    	<img src="<?php echo base_url("imagens/produto/". $registro->imagem_2);?>" alt="" />
        									    </div>
                                            <?php } ?>
    									</div>

    								</div>
    							</div>
    						</div>


                        <?php }
                        } ?>

					</div>
				</section>
<?php include ("footer.php");?>