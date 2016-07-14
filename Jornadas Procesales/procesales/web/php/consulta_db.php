
<!DOCTYPE html>
<html>
<head>
<title>JORNADAS PROCESALES “COGEP: REALIDAD PROCESAL ECUATORIANA" 15 Y 16 DE JUNIO DE 2016</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Tycoon Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->

</head>

<body>
<!-- banner -->
<div class="banner1">
	<div class="header">
		<div class="container">
			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="logo">
						<h3><a class="navbar-brand" href="index.html">Jornadas PROCESALES</a></h3>
						<h3><a class="navbar-brand" href="index.html">“COGEP: Realidad</a></h3>
						<h3><a class="navbar-brand" href="index.html">procesal ecuatoriana"</a></h3>
						<h4><a class="navbar-brand" href="index.html">15 y 16 de Junio de 2016</a></h4>
					</div>
				</div>



				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
					<nav class="link-effect-4" id="link-effect-4">
						<ul class="nav navbar-nav">
							<li ><a href="index.html" data-hover="Inicio">Inicio</a></li>
							<li><a href="panelistas.html" data-hover="Panelistas">Panelistas</a></li>
							<li><a href="gallery.html" data-hover="Galería">Galería</a></li>
							<li><a href="mail.html" data-hover="Contáctanos">Contáctanos</a></li>
							<li class="active"><a href="pregunta.html" data-hover="Preguntas Panelistas">Preguntas Panelistas</a></li>
						</ul>
					</nav>
				</div>
				<!-- /.navbar-collapse -->
			</nav>
		</div>
	</div>
</div>
<!-- //banner -->

<!-- banner-bottom -->

<!-- mail-us -->
<div class="testimonials">
	<div class="container">
		<h3><span></span>Acceso Panelistas</h3>



            <?php
            /**
             * Created by PhpStorm.
             * User: EYSCORP
             * Date: 20/5/2016
             * Time: 15:02
             */



             $host    = "mysql.smartfreehosting.net";
             $user    = "u766223154_andr";
             $pass    = "andys2a";
             $db_name = "u766223154_preg";

             //create connection
             $connection = mysqli_connect($host, $user, $pass, $db_name);

             //test if connection occured
             if(mysqli_connect_errno()){
                 die("connection failed: "
                     . mysqli_connect_error()
                     . " (" . mysqli_connect_errno()
                     . ")");
             }

             //get results from database
             $result = mysqli_query($connection,"SELECT * FROM preguntas_panelistas");
             $all_property = array();  //declare an array for saving property

             //showing property
             echo ' <div class="bs-docs-example">
                    <table class="table">
                    <thead>
                     <tr>';  //initialize table tag
             while ($property = mysqli_fetch_field($result)) {
                 echo '<td>' . $property->name . '</td>';  //get field name for header
                 array_push($all_property, $property->name);  //save those to array
             }
             echo '</tr></thead>'; //end tr tag

             //showing all data
             while ($row = mysqli_fetch_array($result)) {
                 echo "<tbody><tr>";
                 foreach ($all_property as $item) {
                     echo '<td>' . $row[$item] . '</td>'; //get items using property value
                 }
                 echo '</tr></tbody>';
             }
             echo "</table> </div>";
             ?>

			<div class="contact-bottom-grids">



				<div class="col-md-4 contact-bottom-grid">
					<div class="dot">
						<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
					</div>
					<h4>Pontificia Universidad Católica del Ecuador
						Avenida 12 de Octubre 1076, Vicente Ramón Roca.<span>Quito-Ecuador</span></h4>
				</div>
				<div class="col-md-4 contact-bottom-grid">
					<div class="dot">
						<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
					</div>
					<a href="mailto:info@example.com">amena172@puce.edu.ec</a>
				</div>
				<div class="col-md-4 contact-bottom-grid">
					<div class="dot">
						<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
					</div>
					<h4> 0992904616</h4>
					<h4> 0998842450</h4>
					<h4> 0987404272</h4>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //mail-us -->
<!-- footer -->
<div class="footer">
	<div class="container">
		<div class="col-md-3 footer-left">
			<h3><a class="navbar-brand" href="index.html">Jornadas</a></h3>
			<h3><a class="navbar-brand" href="index.html">Procesales</a></h3>
			<h4><a class="navbar-brand" href="index.html">15 y 16 de Junio de 2016</a></h4>
		</div>
		<div class="col-md-6 footer-left">
			<ul class="foot-nav">
				<li><a href="index.html">Inicio</a></li>
				<li><a href="panelistas.html">Panelistas</a></li>
				<li><a href="gallery.html">Galería</a></li>
				<li><a href="mail.html">Contáctanos</a></li>
				<li><a href="pregunta.html">Preguntas Panelistas</a></li>
			</ul>
			<div class="footer-line">

			</div>
			<ul class="footbo">
				<li><a href="mail.html"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Mostrar en mapa y contacto</a></li>

			</ul>
		</div>
		<div class="col-md-3 footer-left">
			<ul class="social-icons">
				<li><a href="https://www.facebook.com/events/1632606457059022/" class="icon-button facebook"><i class="icon-facebook"></i><span></span></a></li>
				<li><a href="#" class="icon-button instagram"><i class="icon-instagram"></i><span></span></a></li>
				<li><a href="#" class="icon-button twitter"><i class="icon-twitter"></i><span></span></a></li>
				<li><a href="#" class="icon-button g-plus"><i class="icon-g-plus"></i><span></span></a></li>
			</ul>
			<ul class="footer-number">
				<li>Números de contacto:</li>
				<li>0992904616</li>
				<li>0998842450</li>
				<li>0987404272</li>
			</ul>
		</div>
		<div class="clearfix"> </div>
		<p>© 2016 Tycoon. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
	</div>
</div>
<!-- //footer -->
<!-- for bootstrap working -->
	<script src="js/bootstrap.js"></script>
<!-- //for bootstrap working -->
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear'
				};
			*/

			$().UItoTop({ easingType: 'easeOutQuart' });

			});
	</script>
<!-- //here ends scrolling icon -->
</body>
</html>


