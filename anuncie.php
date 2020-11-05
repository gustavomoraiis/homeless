
<!DOCTYPE html>
<html lang="pt-br">
	<head>
			<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-167596891-1"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-167596891-1');
		</script>

		

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="description" content="">
  		<meta name="keywords" content="">
  		<meta name="author" content="http://www.datacampo.com.br/">
		<link rel="shortcut icon" type="image/png" href="img/favicon3.png" />
        
       

        <title>LT Imóveis </title>
		
        <!-- All Plugins Css -->
        <link rel="stylesheet" href="css/plugins.css">
		<link rel="stylesheet" href="css/nav.css" />
		<link rel="stylesheet" href="css/slick-theme.less" />
		
        <!-- Custom CSS -->
        <link href="css/styles.css" rel="stylesheet">
		
		<!-- Custom Color Option -->
		<link href="css/colors.css" rel="stylesheet">
		<?php
			function numero_real($valor){
				return  number_format($valor, 2, ',','.');
			};
		?>


    </head>
	
    <body class="green-skin">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div id="preloader"><div class="preloader"><span></span><span></span></div></div>
		
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
		
            <!-- ============================================================== -->
            <!-- Top header  -->
            <!-- ============================================================== -->

			<!-- Start Navigation -->
			<div class="top-header">
				<div class="container">
					<div class="row">
					
						<div class="col-lg-6 col-md-6">
							<div class="cn-info">
								<ul>
									<li><i class="lni-phone-handset"></i>4444444444444444444</li>
									<li><a target="_blank" href="https://wa.me/554444?text=Ol%C3%A1"><i class="lni-whatsapp"></i>444444</a></li>
									<li><a href="mailto:sadasdasd"><i class="ti-email"></i>dasdasdasd</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<ul class="top-social">
								<li><a href="<?php echo $institucional["facebook"] ?>"><i class="lni-facebook"></i></a></li>
								<!-- <li><a href="#"><i class="lni-linkedin"></i></a></li> -->
								<li><a href="<?php echo $institucional["instagram"] ?>"><i class="lni-instagram"></i></a></li>
								<li><a href="<?php echo $institucional["youtube"] ?>"><i class="lni-youtube"></i></a></li>
							</ul>
						</div>
						
					</div>
				</div>
			</div>

			

			<div class="header header-light nav-right-side">
				<nav class="headnavbar">
					<div class="nav-header">
						<a href="index.php" class="brand"><img src="logo" alt="" /></a>
						<button class="toggle-bar"><span class="ti-align-justify"></span></button>	
					</div>								
					<ul class="menu">
						
						<li class=""><a href="propriedades.php?objetivo=venda">Comprar</a></li>
						
						<li class=""><a href="anuncie.php">Anuncie Seu Imóvel</a></li>
						
						<li class=""><a href="index.php#contato">Fale Conosco</a></li>	
					</ul>
						
					
					
				</nav>
			</div>
			<!-- End Navigation -->
			<div class="clearfix"></div>

			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
			

			
			<!-- ============================ Submit Property Start ================================== -->
			<section>
			
				<div class="container">
					<div class="row">
						<!-- Submit Form -->
						<div class="col-lg-12 col-md-12">
						
							<div class="submit-page">
								
								<!-- Basic Information -->
								<div class="form-submit">	
									<h2>Anuncie Seu Imóvel</h2>
									<h5>Preencha as informações abaixo e nós entraremos em contato.</h5>
									<br>
									<div class="submit-section">
										<div class="form-row">
										
										
											
										</div>
									</div>
								</div>

								<!-- Contact Information -->
						<form id="quote-request" action="form/quote-request.php" method="post" class="input-glass registration-form form-quote">
								<div class="form-submit">	
									<h3>Informações para Contato</h3>
									<div class="submit-section">
										<div class="form-row">
										
											<div class="form-group col-md-4">
												<label>Nome</label>
												<input type="text" name="quote-request-name" class="form-control required">
											</div>
											
											<div class="form-group col-md-4">
												<label>E-mail</label>
												<input type="text" name="quote-request-email" class="form-control required">
											</div>
											
											<div class="form-group col-md-4">
												<label>Telefone</label>
												<input type="text" name="quote-request-phone" class="form-control required">
											</div>
											
										</div>
									</div>
								</div>

								<!-- Location -->
								<div class="form-submit">	
									<h3>Informações Imóvel</h3>
									<div class="submit-section">
										<div class="form-row">
										
											<div class="form-group col-md-6">
												<label>Objetivo</label>
												<select id="status"  name="quote-request-objetivo" class="form-control required">
													<option value="">&nbsp;</option>
													<option value="locacao">Alugar</option>
													<option value="compra">Comprar</option>
												</select>
											</div>
											
											<div class="form-group col-md-6">
												<label>Tipo da Propriedade</label>
												<select id="ptypes"  name="quote-request-tipo" class="form-control required">
													<option value="">&nbsp;</option>
													<option value="locacao">Alugar</option>
													<option value="compra">Comprar</option>
												</select>
											</div>
											
											<div class="form-group col-md-6">
												<label>Endereço</label>
												<input type="text" name="quote-request-endereco" class="form-control required">
											</div>
											
											<div class="form-group col-md-6">
												<label>Cidade</label>
												<input type="text" name="quote-request-cidade" class="form-control required">
											</div>
											
											<div class="form-group col-md-6">
												<label>Estado</label>
												<input type="text" name="quote-request-estado" class="form-control required">
											</div>
											
											<!-- <div class="form-group col-md-6">
												<label>CEP</label>
												<input type="text" class="form-control">
											</div> -->
											
										</div>
									</div>
								</div>

								<div class="form-group col-lg-12 col-md-12">
									<input type="text" class="hidden" name="form-anti-honeypot" value="">
									<input class="hidden" placeholder="E-mail" name="quote-request-email2" id="email" type="text" value="gelatinacfal@gmail.com">
									<button type="submit" class="btn btn-theme">Enviar</button>	
								</div>
								<div class="form-results"></div>
						</form>
								
								
											
							</div>
						</div>
						
					</div>
				</div>
						
			</section>
			<!-- ============================ Submit Property End ================================== -->
			
			<!-- ============================ Footer Start ================================== -->
<footer class="dark-footer skin-dark-footer">
				<div>
					<div class="container">
						<div class="row">
							
							<div class="col-lg-3 col-md-3">
								<div class="footer-widget">
									<img src="img/logo-light.png" class="img-footer" alt="" />
									<div class="footer-add">
									</div>
									
								</div>
							</div>		
							
							<div class="col-lg-4 col-md-3">
								<div class="footer-widget">
									<h4 class="widget-title">Contato</h4>
									<ul class="footer-menu">
										<li><p>rua</p></li>
										<li><p>asdasd</p></li>
										<li><p>4444444</p></li>
										<li><p>749498</p></li>
										<!-- <li><p><?php echo $institucional["wpp3"] ?></p></li> -->
										<li><p><a href="mailto:dasdasda?Subject=Tenho%20interesse" target="_top">homelessprjeto@gmail.com</a></p></li>
									</ul>
								</div>
							</div>

							<div class="col-lg-2 col-md-3">
								<div class="footer-widget">
									<h4 class="widget-title">Mapa do Site</h4>
									<ul class="footer-menu">
										<li><a href="propriedades.php">Alugar</a></li>
										<li><a href="propriedades.php">Comprar</a></li>
										<li><a href="anuncie.php">Anuncie</a></li>
										<li><a href="index.php#contato">Contato</a></li>
									
									</ul>
								</div>
							</div>
							
							<div class="col-lg-3 col-md-3">
								<div class="footer-widget">
									<h4 class="widget-title">Redes Sociais</h4>
									<a href="<?php echo $institucional["facebook"] ?>" target="_blank" class="other-store-link">
										<div class="other-store-app">
											<div class="os-app-icon">
												<i class="lni-facebook theme-cl"></i>
											</div>
											<div class="os-app-caps">
												Facebook
												<span>Siga-nos</span>
											</div>
										</div>
									</a>
									<a href="<?php echo $institucional["instagram"] ?>" target="_blank" class="other-store-link">
										<div class="other-store-app">
											<div class="os-app-icon">
												<i class="lni-instagram theme-cl"></i>
											</div>
											<div class="os-app-caps">
												Instagram
												<span>Siga-nos</span>
											</div>
										</div>
									</a>
									<a href="<?php echo $institucional["youtube"] ?>" target="_blank" class="other-store-link">
										<div class="other-store-app">
											<div class="os-app-icon">
												<i class="lni-youtube theme-cl"></i>
											</div>
											<div class="os-app-caps">
												You Tube
												<span>Siga-nos</span>
											</div>
										</div>
									</a>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				
				<div class="footer-bottom">
					<div class="container">
						<div class="row align-items-center">
							
							<div class="col-lg-6 col-md-6">
								<p class="mb-0">© LT Imóveis Todos Direitos Reservados</p>
							</div>
							
							<div class="col-lg-6 col-md-6 text-right">
								<p class="mb-0">Desenvolvido por <a target="_blank" href="http://www.datacampo.com.br/">DataCampo</a></p>
							</div>
							
						</div>
					</div>
				</div>
			</footer>
			<!-- ============================ Footer End ================================== -->
			

			
			<a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>
			

		</div>
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->

		<?php include ('includes/script.php'); ?>
		
		<script src="js/custom2.js"></script>
		
	</body>
</html>