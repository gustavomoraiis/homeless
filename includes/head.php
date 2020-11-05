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
		<meta name="description" content="<?php echo $institucional["metadescricao"] ?>">
  		<meta name="keywords" content="<?php echo $institucional["palavra_chave"] ?>">
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