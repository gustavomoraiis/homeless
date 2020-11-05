
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
				$cod_imovel = isset($_GET['cod_imovel'])?$_GET['cod_imovel']:'';
				if ($cod_imovel !=''){
					$propriedade_cod = array();
					$propriedade_cod = $pdocrud->getPDOModelObj()->executeQuery("select p.* from propriedades p where p.cod_imovel = '".$cod_imovel."'");
					if (count($propriedade_cod)>0) {
						echo "<script>
								window.location.href='propriedade?id=".$cod_imovel."';
							  </script>";
					}
				}

				$pesquisa_cidade = isset($_GET['cidade'])?$_GET['cidade']:'';
				$pesquisa_objetivo = isset($_GET['objetivo'])?$_GET['objetivo']:'';
				$pesquisa_valor = isset($_GET['valor'])?$_GET['valor']:'';
				$pesquisa_minmax = $pesquisa_valor!='' ? explode('-',$pesquisa_valor):'';
				$pesquisa_tipo = isset($_GET['tipo'])?$_GET['tipo']:'';
				// $pesquisa_cod_imovel = isset($_GET['cod_imovel'])?$_GET['cod_imovel']:'';
				$pesquisa_subtipo = isset($_GET['subtipo'])?$_GET['subtipo']:'';
				$pesquisa_bairro = isset($_GET['bairro'])?$_GET['bairro']:'';
				$pesquisa_dormitorios = isset($_GET['dormitorios'])?$_GET['dormitorios']:'';
				$pesquisa_wc = isset($_GET['wc'])?$_GET['wc']:'';
				$pesquisa_vagGaragem = isset($_GET['vagGaragem'])?$_GET['vagGaragem']:'';
				$pesquisa_diferenciais = array();
				
				if (isset($_GET['dif'])){
					foreach ($_GET['dif'] as $value) {
						$pesquisa_diferenciais[] = $value;
					}
				}
				$pesquisa_categorias = array();
				if (isset($_GET['cat'])){
					foreach ($_GET['cat'] as $value) {
						$pesquisa_categorias[] = $value;
					}
				}
				//print_r($pesquisa_diferenciais);
				
				$qtd_por_pag = 6;
				$inicio = 0;
				if (isset($_GET['pag'])) {
					$pag = $_GET['pag'];
					$inicio = ($pag -1 ) * $qtd_por_pag;
				} else {
					$pag = 1;
				}

				$propSql = "select p.*, b.nome as Bnome, c.nome as Cnome, e.nome as Enome, s.nome as Snome 
							from propriedades p, estados e, cidades c, bairros b, subtipos s 
							where e.id_estado = p.end_estado
							and c.id_cidade = p.end_cidade
							and b.id_bairro = p.end_bairro
							and s.id_subtipo = p.subtipo
							and p.status = 'ativa'";
				
				$propSql .= $pesquisa_objetivo == ""   	? "" : " and p.objetivo = '".$pesquisa_objetivo."'";
				$propSql .= $pesquisa_cidade == ""    	? "" : " and p.end_cidade = '".$pesquisa_cidade."'";
				$propSql .= $pesquisa_tipo == ""    	? "" : " and p.tipo = '".$pesquisa_tipo."'";
				// $propSql .= $pesquisa_cod_imovel == ''  ? '' : ' and p.cod_imovel = '.$pesquisa_cod_imovel;
				$propSql .= $pesquisa_subtipo == ""  	? "" : " and p.subtipo = '".$pesquisa_subtipo."'";
				$propSql .= $pesquisa_bairro == ""   	? "" : " and p.end_bairro = '".$pesquisa_bairro."'";
				$propSql .= $pesquisa_dormitorios == "" ? "" : " and p.dormitorios = '".$pesquisa_dormitorios."'";
				$propSql .= $pesquisa_vagGaragem == "" 	? "" : " and p.vagas_garagem = '".$pesquisa_vagGaragem."'";
				$propSql .= $pesquisa_wc == "" 			? "" : " and p.banheiros = '".$pesquisa_wc."'";

				$propSqlSemValor = $propSql;
				
				$propSql .= $pesquisa_minmax == ''  	? '' : ' and p.valor <= '.intval($pesquisa_minmax[1]);
				$propSql .= $pesquisa_minmax == ''    	? '' : ' and p.valor >= '.intval($pesquisa_minmax[0]);

				
				for ($d = 0; $d < count($pesquisa_diferenciais); $d++){
					$andor = $d==0 ? " and (" : " or ";
					$propSql .= $andor."p.diferenciais like '%".$pesquisa_diferenciais[$d]."%'";
					$propSqlSemValor .= $andor."p.diferenciais like '%".$pesquisa_diferenciais[$d]."%'";
				}
				$propSql .= $d>0 ? ")" : "";
				$propSqlSemValor .= $d>0 ? ")" : "";

				for ($c = 0; $c < count($pesquisa_categorias); $c++){
					$andor = $c==0 ? " and (" : " or ";
					$propSql .= $andor."p.nicho like '%".$pesquisa_categorias[$c]."%'";
					$propSqlSemValor .= $andor."p.nicho like '%".$pesquisa_categorias[$c]."%'";
				}
				$propSql .= $c>0 ? ")" : "";
				$propSqlSemValor .= $c>0 ? ")" : "";
			

				$propSql .= " order by p.valor";
				$total = count($pdocrud->getPDOModelObj()->executeQuery($propSql)); 
				$propSql .= ' LIMIT '.$inicio.', '.$qtd_por_pag;
				$propSqlSemValor .= " order by p.valor";
				// echo $propSql;
				
				$propriedades =  $pdocrud->getPDOModelObj()->executeQuery($propSql);
				$propriedadesSemValor =  $pdocrud->getPDOModelObj()->executeQuery($propSqlSemValor);
				
				if ($total>0){
					$resposta = $total==1 ? '1 imóvel encontrado!' : $total.' imóveis encontrados!';
					$propriedadeMaisBarata = $propriedadesSemValor[0]["valor"];
					$propriedadeMaisCara = end($propriedadesSemValor)["valor"];
					$diferenca = $propriedadeMaisCara-$propriedadeMaisBarata;
					$intervaloValor = ceil($diferenca/5);
					$mapProps = array();
				}else{
					$resposta = 'Ainda não temos nenhum imóvel com essas características!';
					$propriedadeMaisBarata = 0;
					$propriedadeMaisCara = 1000;
				}
				
				
			?>
			<!-- ============================ All Property ================================== -->
			<section>
			
				<div class="container">
					<div class="row">
						
						<div class="col-lg-8 col-md-12 list-layout">
							<div class="row">
							
								<div class="col-lg-12 col-md-12">
									<div class="filter-fl">
							<?php
								echo '
										<h4>Total de propriedades encontradas: <span class="theme-cl">'.$total.'</span></h4>
									
									</div>
								</div>
								
								';
					
								
					foreach ($propriedades as $propriedade){

						$foto_pro = $pdocrud -> getPDOModelObj() -> executeQuery('select * from fotos_propriedade where id_propriedade = "'. $propriedade["id_propriedade"].'" LIMIT 1');
						
						
						
						$foto_pro = count($foto_pro)==0?array('foto'=>'img/semfoto.png'):$foto_pro[0];	
						$valor_propriedade1 = $propriedade["valor"]=='' ? "Sob Consulta" : numero_real($propriedade["valor"]);
						$nomeprop = $propriedade["nome"]=='' ? $propriedade["Snome"] . ', ' . $propriedade["Bnome"] : $propriedade["nome"];
						$vl = $propriedade['objetivo']=='venda'?'Venda':'Locação';
							echo'
								<!-- Single Property Start -->
								<div class="col-lg-12 col-md-12">
									<div class="property-listing property-1">
											
										<div class="listing-img-wrapper">
											<a href="propriedade.php?id='.$propriedade["cod_imovel"].'">
												<img src="'. $foto_pro["foto"] .'" class="img-fluid mx-auto" alt="" />
											</a>
											
												<span class="property-type">'.$vl.'</span>
											
										</div>
										
										<div class="listing-content">
										
											<div class="listing-detail-wrapper">
												<div class="listing-short-detail">
													<h4 class="listing-name"><a href="propriedade.php?id='.$propriedade["cod_imovel"].'">'. $nomeprop.'</a></h4>
													<span class="listing-location"><i class="ti-location-pin"></i>'. $propriedade["end_logradouro"] .' <br> '. $propriedade["Cnome"] .' - '. $propriedade["Enome"] .'</span>
												</div>
											</div>
										
											<div class="listing-features-info">
												<ul>
													<li><strong>Dormitórios:</strong>'. $propriedade["dormitorios"] .'</li>
													<li><strong>Banheiros:</strong>'. $propriedade["banheiros"] .'</li>
													<li><strong>Área Útil:</strong>'. $propriedade["area_construida"] .' m²</li>
												</ul>
											</div>
										
											<div class="listing-footer-wrapper">
												<div class="listing-price">
													<h4 class="list-pr">R$ '. $valor_propriedade1 .'</h4>
												</div>
												<div class="listing-detail-btn">
													<a href="propriedade.php?id='.$propriedade["cod_imovel"].'" class="more-btn">Mostrar Detalhes</a>
												</div>
											</div>
											
										</div>
										
									</div>
								</div>
								<!-- Single Property End -->';

								// $novo = array();
								// $novo['link']='propriedade?id='.$propriedade['cod_imovel'];
								// $novo['img']=$foto_pro['foto'];
								// $novo['preco']=numero_real($propriedade['valor']);
								// $novo['vl']=$vl;
								// $novo['nome']=$nomeprop;
								// $novo['quartos']=$propriedade['dormitorios'];
								// $novo['wcs']=$propriedade['banheiros'];
								// $novo['lat']=$propriedade['latitude'];
								// $novo['long']=$propriedade['longitude'];
								// $mapProps[] = $novo;
						}
						//print_r($mapProps);
					
					?>

								
							</div>
							
							<!-- Pagination -->
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<ul class="pagination p-center">
										<?php 
										$url_string = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
										$url_partes = parse_url($url_string);
										if (isset($url_partes['query'])) {
											parse_str($url_partes['query'], $parametros_get);	# code...
										}
																		
										$qtd_pag = ceil($total / $qtd_por_pag);
										for ($i=1; $i <= $qtd_pag; $i++) { 
											$ativo = $i==$pag ? 'active':'';
											$parametros_get['pag'] = $i;
											$url_partes['query'] = http_build_query($parametros_get);
											$url_string = $i==$pag ? '#' : $url_partes['scheme'] . '://' . $url_partes['host'] . $url_partes['path'] . '?' . $url_partes['query'];
											echo '<li class="'.$ativo.'"><a href="'.$url_string.'">'. $i . '</a></li>';
											
										}  
										?>
									</ul>
								</div>
							</div>
					
						</div>
						
						<!-- property Sidebar -->
						<div class="col-lg-4 col-md-12 col-sm-12">
							<div class="page-sidebar">
								
								<!-- Find New Property -->
								<div class="sidebar-widgets">
									
									<h4>Encontre Sua Propriedade</h4>
									
									
									<div class="form-widget">
										<div class="form-result"></div>
										<form id="form-att" method="get" action="propriedades.php">
											<div class="form-process"></div>

											<div class="form-group">
												<div class="input-with-icon">
													<select id="cities" name="cidade" class="form-control">
														<option value="">&nbsp;</option>
														<?php 
															$cidades =  $pdocrud->getPDOModelObj()->select("cidades");
															foreach ($cidades as $i => $cidade){
																$sel = $cidade['id_cidade']==$pesquisa_cidade?'selected':'';
																echo'<option value="'.$cidade['id_cidade'].'" '.$sel.'>'.$cidade['nome'].'</option>';
															}
														?>
													</select>
													<i class="ti-briefcase"></i>
												</div>
											</div>
											
											<div class="form-group">
												<div class="input-with-icon">
													<select id="vendaLOCA" name="objetivo" class="form-control">
														<option value="">&nbsp;</option>
														<option value="locacao"<?php echo $pesquisa_objetivo=='locacao'?'selected':''; ?>>Locação</option>
														<option value="venda"<?php echo $pesquisa_objetivo=='venda'?'selected':''; ?>>Venda</option>									
													</select>
													<i class="ti-briefcase"></i>
												</div>
											</div>

											<div class="form-group">
												<div class="input-with-icon">
													<select id="ptypes" name="tipo" class="form-control">
														<option value="">&nbsp;</option>
														<?php 
															$tipos =  $pdocrud->getPDOModelObj()->select("tipos");
															foreach ($tipos as $i => $tipo){
																$sel = $tipo['id_tipo']==$pesquisa_tipo?'selected':'';
																echo'<option value="'.$tipo['id_tipo'].'" '.$sel.'>'.$tipo['nome'].'</option>';
															}
														?>										
													</select>
													<i class="ti-briefcase"></i>
												</div>
											</div>

											<div class="form-group">
												<div class="input-with-icon">
													<select id="subtipo" name="subtipo" class="form-control">
														<option value="">&nbsp;</option>
														<?php 
															$subtipos =  $pdocrud->getPDOModelObj()->select("subtipos");
															foreach ($subtipos as $i => $subtipo){
																$sel = $subtipo['id_subtipo']==$pesquisa_subtipo?'selected':'';
																echo'<option value="'.$subtipo['id_subtipo'].'" '.$sel.'>'.$subtipo['nome'].'</option>';
															}
														?>										
													</select>
													<i class="ti-briefcase"></i>
												</div>
											</div>

											<div class="form-group">
												<div class="input-with-icon">
													<select id="bedrooms" name="dormitorios" class="form-control">
														<option value="">&nbsp;</option>
														<?php
															for ($i=1; $i <= 5 ; $i++) { 
																$sel = $i==$pesquisa_dormitorios?'selected':'';
																$s = $i>1?'Quartos':'Quarto';
																$s = $i==5?'ou mais':$s;
																echo '<option value="'.$i.'" '.$sel.'>'.$i.' '.$s.'</option>';
															}
														?>
													</select>
													<i class="fas fa-bed"></i>
												</div>
											</div>
											
											<div class="form-group">
												<div class="input-with-icon">
													<select id="bathrooms" name="wc" class="form-control">
														<option value="">&nbsp;</option>
														<?php
															for ($i=1; $i <= 5 ; $i++) { 
																$sel = $i==$pesquisa_wc?'selected':'';
																$s = $i>1?'Banheiros':'Banheiro';
																$s = $i==5?'ou mais':$s;
																echo '<option value="'.$i.'" '.$sel.'>'.$i.' '.$s.'</option>';
															}
														?>
													</select>
													<i class="fas fa-bath"></i>
												</div>
											</div>
											


											<div class="ameneties-features">
												<div class="form-group" id="module">
													<a role="button" class="" data-toggle="collapse" href="#advance-search" aria-expanded="true" aria-controls="advance-search"></a>
												</div>
												<div class="collapse" id="advance-search" aria-expanded="false" role="banner">
													<ul class="no-ul-list">
													<?php 
															$diferenciais =  $pdocrud->getPDOModelObj()->executeQuery("select * from diferenciais limit 9");
															foreach ($diferenciais as $i => $diferencial){
																
																$check =  in_array($diferencial['id_diferencial'], $pesquisa_diferenciais)?'checked':'';
																echo'
																	<li>
																		<input id="d-'.$diferencial['id_diferencial'].'" value="'.$diferencial['id_diferencial'].'" class="checkbox-custom" name="dif[]" type="checkbox" '.$check.'>
																		<label for="d-'.$diferencial['id_diferencial'].'" class="checkbox-custom-label">'.$diferencial['nome'].'</label>
																	</li>
																';
															
															}
														?>
													</ul>
												</div>
											
												<!-- <button class="btn btn-theme full-width">Buscar</button> -->
												<button type="submit" id="btnBuscarProp" class="btn btn-theme full-width"><b>Buscar</b></button>
											</div>
										</form>
									</div>
							
								</div>
							</div>
							<!-- Sidebar End -->
						
						</div>
					</div>
				</div>	
			</section>
			<!-- ============================ All Property ================================== -->
			
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

		<?php include ('includes/script.php'); ?>

	</body>
</html>