<!-- Start Navigation -->
			<div class="top-header">
				<div class="container">
					<div class="row">
					
						<div class="col-lg-6 col-md-6">
							<div class="cn-info">
								<ul>
									<li><i class="lni-phone-handset"></i><?php echo $institucional["telefone"] ?></li>
									<li><a target="_blank" href="https://wa.me/55<?php echo $institucional["whatsapp"]; ?>?text=Ol%C3%A1"><i class="lni-whatsapp"></i><?php echo $institucional["whatsapp"]; ?></a></li>
									<li><a href="mailto:<?php echo $institucional["email"] ?>"><i class="ti-email"></i><?php echo $institucional["email"] ?></a></li>
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

			<?php
				$propriedade_alugar_menu =  $pdocrud->getPDOModelObj()->executeQuery("select * from propriedades p where p.objetivo = 'locacao' and p.status = 'ativa'");
				$total_alugar_menu = COUNT($propriedade_alugar_menu);

				$menu_alugar = $total_alugar_menu != '0' ? '<li class=""><a href="propriedades.php?objetivo=locacao">Alugar</a></li>' : '';
			?>

			<div class="header header-light nav-right-side">
				<nav class="headnavbar">
					<div class="nav-header">
						<a href="index.php" class="brand"><img src="<?php echo $institucional["logo_menu"] ?>" alt="" /></a>
						<button class="toggle-bar"><span class="ti-align-justify"></span></button>	
					</div>								
					<ul class="menu">
						
						<?php echo''.$menu_alugar.''; ?>

						<li class=""><a href="propriedades.php?objetivo=venda">Comprar</a></li>
						
						<li class=""><a href="anuncie.php">Anuncie Seu Imóvel</a></li>
						
						<li class=""><a href="index.php#contato">Fale Conosco</a></li>	
					</ul>
						
					
					
				</nav>
			</div>
			<!-- End Navigation -->
			<div class="clearfix"></div>