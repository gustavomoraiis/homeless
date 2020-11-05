<?php require_once 'admin/script/pdocrud.php';?>
<?php include ('includes/head.php'); ?>

<?php 
	// $pesquisa_cidade = isset($_GET['cidade'])?$_GET['cidade']:'';
	// $propSql = "select p.*, b.nome as Bnome, c.nome as Cnome, e.nome as Enome, s.nome as Snome 
	// from propriedades p, estados e, cidades c, bairros b, subtipos s 
	// where e.id_estado = p.end_estado
	// and c.id_cidade = p.end_cidade";
	// $propSql .= $pesquisa_cidade == ''    	? '' : ' and p.cidade = '.$pesquisa_cidade; 
	// $propSqlSemValor = $propSql;
?>

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

			<?php include ('includes/header.php'); ?>

			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
			<?php 
				$pesquisa_objetivo = isset($_GET['objetivo'])?$_GET['objetivo']:'';
				$pesquisa_tipo = isset($_GET['tipo'])?$_GET['tipo']:'';
				$pesquisa_cod_imovel = isset($_GET['cod_imovel'])?$_GET['cod_imovel']:'';

				$propSql = "select p.*, b.nome as Bnome, c.nome as Cnome, e.nome as Enome, s.nome as Snome 
							from propriedades p, estados e, cidades c, bairros b, subtipos s 
							where e.id_estado = p.end_estado
							and c.id_cidade = p.end_cidade
							and b.id_bairro = p.end_bairro
							and s.id_subtipo = p.subtipo
							and p.status = 'ativa'";
				
				
				$propSql .= $pesquisa_objetivo == ''   	? '' : ' and p.objetivo = '.$pesquisa_objetivo;
				$propSql .= $pesquisa_tipo == ''    	? '' : ' and p.tipo = '.$pesquisa_tipo;
				$propSql .= $pesquisa_cod_imovel == ''    	? '' : ' and p.cod_imovel = '.$pesquisa_cod_imovel;
				

			?>
			<!-- ============================ Hero Banner  Start================================== -->
			<div class="image-cover hero-banner" style="background:url(<?php echo $institucional["banner_inicio"] ?>) no-repeat;">
				<div class="container">
					<div class="hero-search-wrap">
						<div class="hero-search">
							<h1>Encontre Seu Imóvel</h1>
						</div>
						<div class="hero-search-content">
							<div class="form-result"></div>
							<form class="" id="form-att" action="propriedades.php" method="get">
								<div class="form-process"></div>
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="form-group">
												<div class="input-with-icon">
													<select id="alugaVEND" name="objetivo" class="form-control" >
														<option value="">&nbsp;</option>
														<option value="locacao" <?php echo $pesquisa_objetivo=='locacao'?'selected':''; ?>>Alugar</option>
														<option value="venda" <?php echo $pesquisa_objetivo=='venda'?'selected':''; ?>>Comprar</option>	
													</select>
													<i class="ti-briefcase"></i>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="form-group">
												<div class="input-with-icon">
													<select id="ptypes" name="tipo" class="form-control">
														<option value="">&nbsp;</option>
														<?php 
														$tipos =  $pdocrud->getPDOModelObj()->executeQuery("select * from tipos");
														foreach ($tipos as $i => $tipo){
															echo'<option value="'.$tipo['id_tipo'].'">'.$tipo['nome'].'</option>';
														}
														?>
													</select>
													<i class="ti-briefcase"></i>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="form-group">
												<div class="input-with-icon">
													<select id="cod_imovel" name="cod_imovel" class="form-control">
														<option value="">&nbsp;</option>
														<?php 
														$cod_propriedades =  $pdocrud->getPDOModelObj()->executeQuery("select * from propriedades");
														foreach ($cod_propriedades as $i => $cod_prop){
															echo'<option value="'.$cod_prop['cod_imovel'].'">'.$cod_prop['cod_imovel'].'</option>';
														}
														?>
													</select>
													<i class="ti-briefcase"></i>
												</div>
											</div>
										</div>
									</div>


									<div class="hero-search-action">
										<button type="submit" id="btnBuscarInd" class="btn search-btn"><b>Buscar</b></button>
									</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================ Hero Banner End ================================== -->
						
			<section>
				<div class="container">
				
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="sec-heading2 center">
								<div class="sec-left">
									<h3>Propriedades para Comprar</h3>
									<p>Encontre a propriedade perfeita para você.</p>
								</div>
								<div class="sec-right">
									<a href="propriedades.php?objetivo=venda">Ver Todas<i class="ti-angle-double-right ml-2"></i></a>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="property-slide">
								
							<?php
	
	$propriedades1 =  $pdocrud->getPDOModelObj()->executeQuery("select p.*, e.nome as Enome, c.nome as Cnome, b.nome, s.nome as Snome from 
																propriedades p, estados e, cidades c, bairros b, subtipos s where 
																e.id_estado = p.end_estado
																and c.id_cidade = p.end_cidade
																and b.id_bairro = p.end_bairro
																and s.id_subtipo = p.subtipo
																and p.objetivo = 'venda' 
																and p.status = 'ativa' ORDER BY RAND() LIMIT 6");

	foreach ($propriedades1 as $propriedade1){

			$foto_pro1 = $pdocrud -> getPDOModelObj() -> executeQuery('select * from fotos_propriedade where id_propriedade = "'. $propriedade1["id_propriedade"].'" LIMIT 1');
			$foto_pro1 = count($foto_pro1)==0?array('foto'=>'img/semfoto.png'):$foto_pro1[0];
			$valor_propriedade1 = $propriedade1["valor"]=='' ? "Sob Consulta" : numero_real($propriedade1["valor"]);
			$objetivoProp1 = "Venda";
			// $subtipos1 = $pdocrud -> getPDOModelObj() -> executeQuery('select * from subtipos where id_subtipo = "'.$propriedade1["subtipo"].'"')[0];
			$cartaoNome = $propriedade1["nome"]=="" ? $propriedade1["Snome"].", ".$propriedade1["Bnome"] : $propriedade1["nome"];
			echo'<!-- Single Property -->
								<div class="single-items">
									<div class="property-listing property-2 modern">
								
										<div class="listing-img-wrapper">
											<div class="modern-pro-wrap">
												<span class="property-type">'. $objetivoProp1 .'</span>
											</div>
											<div class="list-img-slide">
												<div class="click">
													<div><a href="propriedade.php?id='.$propriedade1["cod_imovel"].'">
													<img src="'. $foto_pro1["foto"] .'" class="img-fluid mx-auto" alt="" /></a></div>	
												</div>
											</div>
											<div class="listing-price-with-compare">
												<h4 class="list-pr">R$ '. $valor_propriedade1 .'</h4>
											</div>
											
										</div>
										
										<div class="listing-detail-wrapper pb-0">
											<div class="listing-short-detail">
												<span class="home-type theme-cl">'. $propriedade1["Snome"] .'</span>
												<h4 class="listing-name"><a href="propriedade.php?id='.$propriedade1["cod_imovel"].'">'. $cartaoNome .'</a></h4>
												<span class="property-locations"><i class="ti-location-pin"></i>'. $propriedade1["end_logradouro"] .', '. $propriedade1["end_numero"] .','. $propriedade1["Cnome"] .'</span>
											</div>
										</div>
										
										<div class="price-features-wrapper simple">
											<div class="slide-property-info mb-4">
												<ul>
													<li>Quartos: '. $propriedade1["dormitorios"] .'</li>
													<li>Banheiros: '. $propriedade1["banheiros"] .'</li>
													<li>Últil: '. $propriedade1["area_construida"] .' m2</li>
												</ul>
											</div>
										</div>
																				
									</div>
								</div>
								';
								}
							?>
								
								
							</div>
						</div>
					</div>
					
				</div>
			</section>
			<!-- ============================ Slide Property End ================================== -->
			
			<!-- ============================ Slide Location Start ================================== -->
			<section class="pt-0">
				<div class="container">
				
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="sec-heading2 center">
								<div class="sec-left">
									<h3>Encontre Propriedades Nestas Cidades</h3>
									<p>Find new & featured property for you.</p>
								</div>
								<!-- <div class="sec-right">
									<a href="half-map.html">View All<i class="ti-angle-double-right ml-2"></i></a>
								</div> -->
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="location-slide">
				<?php
					$cidades = $pdocrud -> getPDOModelObj() -> executeQuery('SELECT count(p.end_cidade) as qtd_prop, c.id_cidade, c.nome, c.foto FROM propriedades p inner JOIN cidades c on c.id_cidade = p.end_cidade group by p.end_cidade');
					foreach ($cidades as $cidade){
						
					echo'
								<!-- Single location -->
								<div class="single-items">
									<a href="propriedades.php?cidade='.$cidade["id_cidade"].'" class="img-wrap">					
											<div class="img-wrap-content visible">
												<h4>'.$cidade["nome"].'</h4>
												<span>'.$cidade["qtd_prop"].' Propriedades</span>
											</div>
										<div class="img-wrap-background" style="background-image: url('.$cidade["foto"].');"></div>
									</a>
								</div>
								';
								}
							?>
								
								
							</div>
						</div>
					</div>
					
				</div>
			</section>
			<!-- ============================ Slide Location End ================================== -->
			
			<!-- ============================ Browse Place (PROPRIEDADE DESTAQUE) ================================== -->
			
			<?php
	
	$propriedades1 =  $pdocrud->getPDOModelObj()->executeQuery("select p.*, b.nome, c.nome as Cnome, s.nome as Snome, i.propriedade_destaque from 
																propriedades p, estados e, cidades c, bairros b, subtipos s, institucional i where 
																p.id_propriedade = i.propriedade_destaque
																and p.status = 'ativa'  LIMIT 1");

	foreach ($propriedades1 as $propriedade1){
		$valor_propriedade1 = $propriedade1["valor"]=='' ? "Sob Consulta" : numero_real($propriedade1["valor"]);
			$foto_pro1 = $pdocrud -> getPDOModelObj() -> executeQuery('select * from fotos_propriedade where id_propriedade = "'. $propriedade1["id_propriedade"].'" LIMIT 1');
			$foto_pro1 = count($foto_pro1)==0?array('foto'=>'img/semfoto.png'):$foto_pro1[0];
			
			
			echo'

			<section class="image-cover" style="background:url('. $foto_pro1["foto"] .') no-repeat;" data-overlay="3">
				<div class="ht-50"></div>
				<div class="container">
					<div class="row">
						<div class="col-lg-7 col-md-10">
							<div class="home-slider-container">
								<!-- Slide Title -->
								<div class="home-slider-desc">
									<div class="modern-pro-wrap">
										<span class="property-type">'. $propriedade1["objetivo"] .'</span>
										
									</div>
									<div class="home-slider-title">
										<h3><a href="single-property-page-1.html">'. $propriedade1["nome"] .'</a></h3>
										<span><i class="lni-map-marker"></i>'. $propriedade1["end_logradouro"] .', '. $propriedade1["end_numero"] .', '. $propriedade1["Cnome"] .'</span>
									</div>
									
									<div class="slide-property-info">
										<ul>
											<li>Quartos: '. $propriedade1["dormitorios"] .'</li>
											<li>Banheiros: '. $propriedade1["banheiros"] .'</li>
											<li>Últil: '. $propriedade1["area_construida"] .' m2</li>
										</ul>
									</div>
									
									<div class="listing-price-with-compare">
										<h4 class="list-pr theme-cl">R$ '. $valor_propriedade1 .'</h4>
									</div>

									<a href="propriedade.php?id='.$propriedade1["cod_imovel"].'" class="read-more">Mais Detalhes <i class="fa fa-angle-right"></i></a>

								</div>
								';
							}
						?>
								<!-- Slide Title / End -->
							</div>
						</div>
					</div>
				</div>
				<div class="ht-50"></div>
			</section>
	
		
			<!-- ============================ Browse Place (PROPRIEDADE DESTAQUE) End ================================== -->
			<?php
				$propriedades1 =  $pdocrud->getPDOModelObj()->executeQuery("select p.*, e.nome as Enome, c.nome as Cnome, b.nome, s.nome as Snome from 
																			propriedades p, estados e, cidades c, bairros b, subtipos s where 
																			e.id_estado = p.end_estado
																			and c.id_cidade = p.end_cidade
																			and b.id_bairro = p.end_bairro
																			and s.id_subtipo = p.subtipo
																			and p.objetivo = 'locacao' 
																			and p.status = 'ativa' ORDER BY RAND() LIMIT 6");
				$total_alugar = COUNT($propriedades1);
				$parte1 = $total_alugar != '0' ? 
				'
				<section>
					<div class="container">
					
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="sec-heading2 center">
									<div class="sec-left">
										<h3>Propriedades para Alugar</h3>
										<p>Encontre a propriedade perfeita para você.</p>
									</div>
									<div class="sec-right">

										<a href="propriedades.php?objetivo=locacao">Ver Todas<i class="ti-angle-double-right ml-2"></i></a>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="property-slide">
				'
				: '';

				$parte2 = $total_alugar != '0' ? 
				'
								</div>
							</div>
						</div>
						
					</div>
				</section>
				' 
				: '';
			?>
			
			
								
						<?php

							echo ''.$parte1.'';

							foreach ($propriedades1 as $propriedade1){

							$foto_pro1 = $pdocrud -> getPDOModelObj() -> executeQuery('select * from fotos_propriedade where id_propriedade = "'. $propriedade1["id_propriedade"].'" LIMIT 1');
							$foto_pro1 = count($foto_pro1)==0?array('foto'=>'img/semfoto.png'):$foto_pro1[0];
							$objetivoProp1 = "Locação";
							$valor_propriedade1 = $propriedade1["valor"]=='' ? "Sob Consulta" : numero_real($propriedade1["valor"]);
							// $subtipos1 = $pdocrud -> getPDOModelObj() -> executeQuery('select * from subtipos where id_subtipo = "'.$propriedade1["subtipo"].'"')[0];
							$cartaoNome = $propriedade1["nome"]=="" ? $propriedade1["Snome"].", ".$propriedade1["Bnome"] : $propriedade1["nome"];
							echo'
							<!-- Single Property -->
								<div class="single-items">
									<div class="property-listing property-2 modern">
								
										<div class="listing-img-wrapper">
											<div class="modern-pro-wrap">
												<span class="property-type">'. $objetivoProp1 .'</span>
											</div>
											<div class="list-img-slide">
												<div class="click">
													<div><a href="propriedade.php?id='.$propriedade1["cod_imovel"].'">
													<img src="'. $foto_pro1["foto"] .'" class="img-fluid mx-auto" alt="" /></a></div>	
												</div>
											</div>
											<div class="listing-price-with-compare">
												<h4 class="list-pr">R$ '. $valor_propriedade1 .'</h4>
											</div>
											
										</div>
										
										<div class="listing-detail-wrapper pb-0">
											<div class="listing-short-detail">
												<span class="home-type theme-cl">'. $propriedade1["Snome"] .'</span>
												<h4 class="listing-name"><a href="propriedade.php?id='.$propriedade1["cod_imovel"].'">'. $cartaoNome .'</a></h4>
												<span class="property-locations"><i class="ti-location-pin"></i>'. $propriedade1["end_logradouro"] .', '. $propriedade1["end_numero"] .','. $propriedade1["Cnome"] .'</span>
											</div>
										</div>
										
										<div class="price-features-wrapper simple">
											<div class="slide-property-info mb-4">
												<ul>
													<li>Quartos: '. $propriedade1["dormitorios"] .'</li>
													<li>Banheiros: '. $propriedade1["banheiros"] .'</li>
													<li>Últil: '. $propriedade1["area_construida"] .' m2</li>
												</ul>
											</div>
										</div>
																				
									</div>
								</div>
								';
								}

								echo ''.$parte2.'';
						?>
								

			<!-- ============================ Slide Property End ================================== -->

			<!-- ============================ Testimonials ================================== -->
			<section class="gray-bg">
				<div class="container">
					<div class="row align-items-center">
					
						<div class="col-lg-5 col-md-5">
						
							<div class="sec-heading">
								<h2>Depoimentos</h2>
								<p>Acreditamos que uma trajetória de sucesso se faz através de clientes satisfeitos. Confira porque escolher a LT Imóveis.</p>
								<!-- <a href="#" class="btn btn-theme-2 mt-3">See More Reviews</a> -->
							</div>
							
						</div>
						
						<div class="col-lg-7 col-md-7">
							<div class="testi-slide item-slide">
								
								<!-- Single Testimonial -->
								<?php	
							$matriz =  $pdocrud->getPDOModelObj()->select("depoimentos");
                            foreach ($matriz as $vetor){      
                            echo'
								<div class="single-items">
									<div class="testimonial-wrap">
									
                   
										<div class="client-thumb-box">
											<div class="client-thumb-content">
												<div class="client-info">
													<h5 class="mb-0">'.$vetor['nome'].'</h5>
													<span class="small-font">'.$vetor['denominacao'].'</span>
												</div>
											</div>
										</div>
										
										<p>'.$vetor['depoimento'].'</p>
								
									</div>
								</div>  
						
								';
							}
							?>
								
							</div>
						</div>
						
					</div>
				</div>
			</section>
			<!-- ============================ Testimonials End ================================== -->

						<!-- ============================ Step How To Use Start ================================== -->
						<section class="gray"  id="contato">
							<div class="container">
								
								<div class="row">
									<div class="col text-center">
										<div class="sec-heading center">
											<h2>Venha Tomar um Café</h2>
											<p>Nosso negócio é encontrar o imóvel que encante os nossos clientes.</p>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-lg-4 col-md-4">
										<div class="middle-icon-features">
											<div class="middle-icon-features-item">
												<div class="icon-largos"><i class="ti-map-alt text-danger"></i></div>
												<div class="middle-icon-features-content">
													<h4>Endereço</h4>
													<p><?php echo $institucional["endereco"] ?> <br> 
													<?php echo $institucional["localizacao"] ?></p>
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-lg-4 col-md-4">
										<div class="middle-icon-features">
											<div class="middle-icon-features-item">
												<div class="icon-largos"><i class="lni-phone text-success"></i></div>
												<div class="middle-icon-features-content">
													<h4>Telefone</h4>
													<p><?php echo $institucional["telefone"] ?></p>
													<p><?php echo $institucional["wpp2"] ?></p>
													<!-- <p><?php echo $institucional["wpp3"] ?></p> -->
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-lg-4 col-md-4">
										<div class="middle-icon-features">
											<div class="middle-icon-features-item">
												<div class="icon-largos"><i class="ti-email text-warning"></i></div>
												<div class="middle-icon-features-content">
													<h4>E-mail</h4>
													<p><?php echo $institucional["email"] ?></p>
												</div>
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</section>
						<div class="clearfix"></div>
						<!-- ============================ Step How To Use End ================================== -->


			<!-- ============================ Call To Action ================================== -->
			<section class="theme-bg call-to-act-wrap">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							
							<div class="call-to-act">
								<div class="call-to-act-head">
									<h3>Gostou de Algum Imóvel?</h3>
									<span>Então mande uma mensagem para marcarmos uma visita.</span>
								</div>
								<a target="_blank" href="https://wa.me/55<?php echo $institucional["whatsapp"] ?>?text=Ol%C3%A1" class="btn btn-call-to-act">Mandar Mensagem WhatsApp</a>
							</div>
							
						</div>
					</div>
				</div>
			</section>
			<!-- ============================ Call To Action End ================================== -->
			
			<?php include ('includes/footer.php'); ?>
				
				
			
			
			<a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>
			

		</div>
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->

		<?php include ('includes/script.php'); ?>

	</body>
</html>