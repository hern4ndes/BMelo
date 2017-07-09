<!DOCTYPE html>
<!--[if IE 9]>
<html class="ie ie9" lang="pt-BR">
<![endif]-->
<html lang="pt-BR">
<head>
    <meta name="author" content=" B. Melo Filho - Industria e Comércio">
    <meta charset="UTF-8">
    <meta name="KEYWORDS" content="Macas, Coifas, Expurgos, Pias, Bancadas, Corrimãos, Lavabos, Mictórios, Aço Inox, Teresina, Piauí, Rua Lizandro Nogueira, Bernardo Melo Filho, B. Melo Filho">
    <meta name="ROBOT" content="Index,Follow">
    <meta name="RATING" content="general">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title><?php echo $institucional->nome;?> - <?php echo $form_titulo;?><?php echo $registro->nome;?></title>
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="<?php echo base_url('favicon.ico');?>" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url('favicon.ico');?>" type="image/x-icon">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/animate.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/flexslider.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/simple-line-icons.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/icon-font.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/flat-icon.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/innovation.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/rs-plugin/css/settings.css');?>">
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="sidebar-menu-container" id="sidebar-menu-container">
		<div class="sidebar-menu-push">
			<div class="sidebar-menu-overlay"></div>
			<div class="sidebar-menu-inner">
				<div id="sub-header">
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<div class="left-info">
									<ul>
										<li><i class="fa fa-phone"></i><?php echo $institucional->telefones;?></li>
										<li><i class="fa fa-envelope-o"></i><?php echo $institucional->email;?></li>
										<li><i class="fa fa-clock-o"></i><?php echo $institucional->funcionamento;?></li>
									</ul>
								</div>
							</div>
							<div class="col-md-6">
								<div class="social-icons">
									<ul>
										<?php if(isset($institucional->link_facebook)){?>
											<li><a href="<?php echo $institucional->link_facebook;?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
										<?php } ?>
										<?php if(isset($institucional->link_twitter)){?>
											<li><a href="<?php echo $institucional->link_twitter;?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
										<?php } ?>
										<?php if(isset($institucional->link_instagram)){?>
											<li><a href="<?php echo $institucional->link_instagram;?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
										<?php } ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
                <header class="site-header">
                    <div id="main-header" class="main-header header-sticky">
                        <div class="inner-header container clearfix">
                            <div class="logo">
                                <a href="<?php echo base_url('home');?>"><img src="<?php echo base_url('assets/images/logo.png');?>" alt="<?php echo $institucional->titulo;?>"></a>
                            </div>
                            <div class="header-right-toggle pull-right hidden-md hidden-lg">
                                <a href="javascript:void(0)" class="side-menu-button"><i class="fa fa-bars"></i></a>
                            </div>
                            <nav class="main-navigation text-right hidden-xs hidden-sm">
                                <ul>
                                    <li><a href="<?php echo base_url('home'); ?>">Home</a>
                                    <li><a href="<?php echo base_url('sobre'); ?>">Sobre nós</a></li>
                                    </li>
                                    <li><a href="#" class="has-submenu">Produtos</a>
                                        <ul class="sub-menu">
                                            <?php echo $this->funcoes_gerais->getMenuCategorias();?>
                                        </ul>
                                    </li>
                                    <li><a href="<?php echo base_url('detalhe_produto/novidades'); ?>">Novidades</a></li>
                                    <li><a href="<?php echo base_url('orcamento'); ?>">Solicitar Orçamento</a></li>
                                    <li><a href="<?php echo base_url('encontre'); ?>">Encontre-nos</a></li>
                                    <li>


                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </header>

				