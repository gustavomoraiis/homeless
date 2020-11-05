<?php require_once 'admin/script/pdocrud.php';?>
<?php include ('includes/head.php'); ?>
	
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
				$cod_imovel = $_GET['id'];
				$propriedade = $pdocrud->getPDOModelObj()->executeQuery("select p.*, e.nome as Enome, c.nome as Cnome, b.nome as Bnome from 
																		 propriedades p, estados e, cidades c, bairros b where 
																		 e.id_estado = p.end_estado
																		 and c.id_cidade = p.end_cidade
																		 and b.id_bairro = p.end_bairro
																		 and p.cod_imovel = '".$cod_imovel."'")[0];
				$fotos_pro = $pdocrud -> getPDOModelObj() -> executeQuery('select * from fotos_propriedade where id_propriedade = "'. $propriedade["id_propriedade"].'"');
				$fotos_pro = count($fotos_pro)==0?array(array('foto'=>'img/semfoto.png')):$fotos_pro;
				//$difPropriedade = array();
				$difPropriedade = $propriedade['diferenciais'];
				if ($difPropriedade!=''){
				  $diferenciais = $pdocrud -> getPDOModelObj() -> executeQuery('select * from diferenciais where id_diferencial in ('.$difPropriedade.')');
				}else{
					$diferenciais=array();
					array_push($diferenciais, array("nome"=>''));
				}
				
				
			?>

			
			<!-- ============================ Property Detail Start ================================== -->
			<section class="gray">
				<div class="container">
					<div class="row">
						
					<?php $valor_propriedade = $propriedade["valor"]=='' ? "Sob Consulta" : numero_real($propriedade["valor"]); ?>
					<?php
						if($propriedade["objetivo"]=="locacao"){
							$objetivoProp = "Locação";
						}else if($propriedade["objetivo"]=="venda"){
							$objetivoProp = "Venda";
						}
					?>
					<!-- property main detail -->
						<div class="col-lg-8 col-md-12 col-sm-12">
							
							<div class="slide-property-first mb-4">
								<div class="pr-price-into row">
									<div class="col-lg-4 col-md-12 col-sm-12"> <h2>R$ <?php echo $valor_propriedade; ?> </h2></div>
									<div class="col-lg-8 col-md-12 col-sm-12 div-objetivo no-padding"><span class="prt-type rent"><?php echo $objetivoProp; ?></span> </div> 
									<div class="col-lg-12 col-md-12 col-sm-12 div-end">
										<span><i class="lni-map-marker"></i> <?php echo ''.$propriedade["end_logradouro"].', '.$propriedade["end_numero"].' | '.$propriedade["Bnome"].' | '.$propriedade["Cnome"].' - '.$propriedade["Enome"].' | COD: '.$propriedade["cod_imovel"].' '; ?></span>
									</div>
								</div>
							</div>
								
							<div class="property3-slide single-advance-property mb-4">
								<div class="slider-for">
							
							<?php
							$fotos =  $pdocrud->getPDOModelObj()->executeQuery('select * from fotos_propriedade where id_propriedade = "'.$_GET['id'].'"');
							foreach ($fotos_pro as $i => $foto_pro){
							echo'
								
									<a href="'. $foto_pro["foto"] .'" class="item-slick"><img src="'. $foto_pro["foto"] .'" alt="Alt"></a>
									';
								}
								echo '</div>';	

							echo '<div class="slider-nav">';
								foreach ($fotos_pro as $i => $foto_pro){
									echo'
									<div class="item-slick"><img src="'. $foto_pro["foto"] .'" alt="Alt"></div>
									';
								}
							?>

								</div>
						
							</div>

					

							
							<!-- Single Block Wrap -->
							<div class="block-wrap">
								
								
									<h4 class="block-title">Descrição</h4>
								
								<p><?php echo $propriedade["observacoes"]; ?></p>
								<div class="block-body">
								<?php echo $propriedade["inf_internas"]; ?></li>
								</div>
								<div class="block-body">
									<ul class="dw-proprty-info">
										
										<li><strong>Quartos</strong><?php echo $propriedade["dormitorios"]; ?></li>
										<li><strong>Suítes</strong><?php echo $propriedade["suites"]; ?></li>
										<li><strong>Banheiros</strong><?php echo $propriedade["banheiros"]; ?></li>
										<li><strong>Garagem</strong><?php echo $propriedade["vagas_garagem"]; ?></li>
										<li><strong>Área Últil</strong><?php echo $propriedade["area_construida"]; ?> m²</li>
										<li><strong>Área Total</strong><?php echo $propriedade["area_total"]; ?> m²</li>
									</ul>
								</div>
								
							</div>
							
										
						
							
							
							
									<?php
										$lista1_dif = $difPropriedade != '' ? 
										'
											<!-- Single Block Wrap -->
										<div class="block-wrap">
												<h4 class="block-title">Mais Detalhes</h4>
											<div class="block-body">
												<ul class="avl-features third">
										' 
										: '';
										$lista2_dif = $difPropriedade != '' ? 
										'
												</ul>
											</div>
												
										</div>
									
										' 
										: '';

											echo''.$lista1_dif.'';

												foreach ($diferenciais as $dife){
													echo'
														<li class="li-dif">'. $dife["nome"] .'</li>
													';
												}

											echo''.$lista2_dif.'';
										?>
							
							
							<?php
										
										if ($propriedade['link'] != ""){
										parse_str(parse_url($propriedade['link'])['query'], $queryArray);
										$link = $queryArray['v'];
										}
										$img = $propriedade['link'] != ""?'<div class="block-wrap"><h4 class="block-title">Vídeo</h4><iframe width="690" height="300" src="https://www.youtube.com/embed/'.$link.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>'
											:'';

										echo'
											'.$img.'
										';  
								?>

							<!-- Single Block Wrap -->
							<div class="block-wrap">
								
								
									<h4 class="block-title">Localização</h4>
								
								
								<div class="block-body">
									<div class="map-container">
										<div id="singleMap" data-latitude="<?php echo $propriedade["latitude"]; ?>" data-longitude="<?php echo $propriedade["longitude"]; ?>" data-mapTitle="Our Location"></div>
									</div>

								</div>
								
							</div>
							
							
							
						</div>
						
						<!-- property Sidebar -->
						<div class="col-lg-4 col-md-12 col-sm-12">
							<div class="page-sidebar">
								
								
								
								<!-- Agent Detail -->
								<div class="agent-widget">
									<div class="agent-title">
										
										<div class="agent-details">
											<h4><a href="#">QUERO MAIS INFORMAÇÕES</a></h4>
										<div class="mg-top">
											<span><i class="lni-phone-handset"></i><?php echo $institucional["telefone"] ?></span>
										</div>
											<span><i class="lni-whatsapp "></i><?php echo $institucional["wpp2"] ?></span>
										</div>
										<div class="clearfix"></div>
									</div>

									<div class="form-group">
										<input type="text" class="form-control" placeholder="Nome">
									</div>
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Telefone para Contato">
									</div>
									<div class="form-group">
										<textarea class="form-control">Estou interessado(a) nesta propriedade.</textarea>
									</div>
									<button class="btn btn-theme full-width">Enviar Mensagem</button>
								</div>
								
							
								
								
								<!-- Featured Property -->
								<div class="sidebar-widgets">
									
									<h4>Outras Propriedades</h4>
									
									<div class="sidebar-property-slide">
										


									
									<?php
								
								$propriedades1 =  $pdocrud->getPDOModelObj()->executeQuery("select p.*, e.nome as Enome, c.nome as Cnome, b.nome, s.nome as Snome, t.nome as Tnome from 
																							propriedades p, estados e, cidades c, bairros b, tipos t, subtipos s where 
																							e.id_estado = p.end_estado
																							and c.id_cidade = p.end_cidade
																							and b.id_bairro = p.end_bairro
																							and t.id_tipo = p.tipo
																							and s.id_subtipo = p.subtipo
																							and p.status = 'ativa' 
																							and p.objetivo = '".$propriedade['objetivo']."'
																							and p.tipo = '".$propriedade['tipo']."'
																							and p.id_propriedade <> '".$propriedade['id_propriedade']."'
																							ORDER BY RAND() LIMIT 8");

								foreach ($propriedades1 as $propriedade1){

										$fotos_pro1 = $pdocrud -> getPDOModelObj() -> executeQuery('select * from fotos_propriedade where id_propriedade = "'. $propriedade1["id_propriedade"].'" limit 1');
										$fotos_pro1 = count($fotos_pro1)==0?array('foto'=>'img/semfoto.png'):$fotos_pro1[0];
										$valor_propriedade1 = $propriedade1["valor"]=='' ? "Sob Consulta" : numero_real($propriedade1["valor"]);
										if($propriedade1["objetivo"]=="locacao"){
											$objetivoProp1 = "Locação";
										}else if($propriedade1["objetivo"]=="venda"){
											$objetivoProp1 = "Venda";
										}

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
															<div><a href="propriedade.php?id='.$propriedade1["cod_imovel"].'"><img src="'. $fotos_pro1["foto"] .'" class="img-fluid mx-auto" alt="" /></a></div>
														</div>
													</div>
													<div class="listing-price-with-compare">
														<h4 class="list-pr">R$ '. $valor_propriedade1 .'</h4>
													</div>
													
												</div>
												
												<div class="listing-detail-wrapper pb-0">
													<div class="listing-short-detail">
														<span class="home-type theme-cl">'.$propriedade1["Tnome"].'</span>
														<h4 class="listing-name"><a href="propriedade.php?id='.$propriedade1["cod_imovel"].'">'. $cartaoNome .'</a></h4>
														<span class="property-locations"><i class="ti-location-pin"></i>'. $propriedade1["end_logradouro"] .', '. $propriedade1["end_numero"] .'</span>
													</div>
												</div>
												
												<div class="price-features-wrapper simple">
													<div class="slide-property-info mb-4">
														<ul>
															<li>Dormitórios: '.$propriedade1["dormitorios"].'</li>
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
			<!-- ============================ Property Detail End ================================== -->
			
			<!-- ============================ Call To Action ================================== -->
			<section class="theme-bg call-to-act-wrap">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							
							<!-- <div class="call-to-act">
								<div class="call-to-act-head">
									<h3>Want to Become a Real Estate Agent?</h3>
									<span>We'll help you to grow your career and growth.</span>
								</div>
								<a href="#" class="btn btn-call-to-act">SignUp Today</a>
							</div> -->
							
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

		<?php
			$propriedades =  $pdocrud->getPDOModelObj()->executeQuery('select * from propriedades where status = "ativa" order by valor desc');
			$pesquisa_max="0";
			$pesquisa_min="0";
			$propriedadeMaisBarata = "0";
			$propriedadeMaisCara = "1000000";
		?>

		<?php include ('includes/script.php'); ?>

	</body>
</html>