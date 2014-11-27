<!DOCTYPE html>
<html>
<head>
	<title>TakaApp</title>

	{{ HTML::style('/assets/css/bootstrap.min.css'); }}
	{{ HTML::style('/assets/css/main.css'); }}

	

	<!-- JavaScript -->
		<script type="text/javascript" src="assets/js/jquery-1.9.0.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.cslider.js"></script>
		<script type="text/javascript" src="assets/js/jquery.mousewheel-3.0.6.pack.js"></script>
		<script type="text/javascript" src="assets/js/move-top.js"></script>


	<!-- Start Scroll Script -->
		 	<!---strat-slider---->
	    <link rel="stylesheet" type="text/css" href="assets/css/slider.css" />
		<script type="text/javascript" src="assets/js/modernizr.custom.28468.js"></script>
		<script type="text/javascript" src="assets/js/jquery.cslider.js"></script>
			<script type="text/javascript">
				$(function() {
				
					$('#da-slider').cslider({
						autoplay	: true,
						bgincrement	: 450
					});
				
				});
			</script>
		<!---//strat-slider---->
		 <!-- scroll -->
		 <script type="text/javascript">
			$(document).ready(function() {
			
				var defaults = {
		  			containerID: 'toTop', // fading element id
					containerHoverID: 'toTopHover', // fading element hover id
					scrollSpeed: 2000,
					easingType: 'linear' 
		 		};
				
				
				$().UItoTop({ easingType: 'easeOutQuart' });
				
			});
			
		</script>
		 <!-- //scroll -->
	<!-- End Scroll Script -->
</head>

<body>
	<!-- Start Header -->
	<!--<header>
			<div class="pages">
			<ul class="menu">		
				<li class="active"><a  href="#home">Home</a></li>
				<li><a href="#about" class="scroll">About</a></li>
				<li><a href="#team" class="scroll">The Team</a></li>
				<li class="last"><a href="#contact"  class="scroll">Contact</a></li>
			</ul>	
			</div>
			 <script type="text/javascript" src="js/responsive.menu.js"></script>
	</header>
	<!-- End Header -->
	<!-- Start Wrapper -->
	<div id="wrapper">

	<!-- Start Home Section -->
	<div id="home">

			<div class="pages">
			<ul class="menu">		
				<li class="active"><a  href="#home">Home</a></li>
<!-- 				<li><a href="#about" class="scroll">About</a></li> -->
				<li><a href="#team" class="scroll">The Team</a></li>
				<li class="last"><a href="#contact"  class="scroll">Contact</a></li>
			</ul>	
			</div>
			<div id="About">

			<h1>TakaApp</h1>
			
			<p id="About_Taka">
				TakaApp is an application that will link garbage collectors and recyclers<br>
				by creating a platform where they can trade. It will operate as an SMS service.<br>
				This proves to be viable because:
				
			</p>
	</div>
	<!-- End Home Section -->

	<!-- Start About Section -->
	<div id="about">
	</div>
	<!-- start team section -->
		<div id="team">
			<h1>The Team</h1>
			<img src="uploads/sharondrawing.png" width="200" height="200" id="theTeam">
			<img src="uploads/ole_02_02.png" width="200" height="200" id="theTeam">
			<img src="uploads/20141022_172502-1-1_01.png" width="200" height="200" id="theTeam">
			<img src="uploads/20141022_162631_02.png" width="200" height="200" id="theTeam">
			<img src="uploads/chrisco.jpg" width="200" height="200" id="theTeam"><br clear="all">

			<p class="myProfile">Sharon Wangari<br>Designer</p>
			<p class="myProfile1">Miriam Njeri<br>Mobile Developer</p>
			<p class="myProfile2">Olive Chao<br>Mobile Developer</p>
			<p class="myProfile3">Brenda Akinyi<br>Designer</p>
			<p class="myProfile4">Christine Nyambura<br>Web Developer</p>
			<br clear="all">

			<p class="motto">
				Work Smart<br>
				Play Hard<br>
				Build Something Awesome<br>
				Change the world.
			</p>

			<!-- <img src="assets/images/tahj-mowry-3.jpg" width="200" height="200" id="theTeam">
			<p class="myProfile">
				She doesn't need me<br>
				She's gonna leave me<br>
			</p> -->
		</div>

 	<!-- End Team section -->


	<!-- Start Contact Section -->

		<div id="contact">
			<div class="contact_text">
				<p>
				<h1><span class="just_me">Talk to us.</span><br>
				 <span class="feedback">We value your feedback</h1></span>
			</div>

			<div class="form_holder">
				<form>
					<input type="text" placeholder="name"><br>
					<input type="text" placeholder="email"><br>
					<input type="text" placeholder="occupation">
				</form>
			</div>

			<textarea placeholder="Message">

			</textarea>
			<br clear="all">
			<div class="submit_two"><a href="index.html">Submit</a></div>
			<br clear="all">

		</div>
		<!-- End Wrapper -->
		</div>

	<!-- End Contact Section -->
		<script type="text/javascript" src="js/move-top.js"></script>
		<script type="text/javascript" src="js/easing.js"></script>
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
			});
		});
		</script>
		<a href="/login">LOGIN HERE TO GIVE US YOUR COMMENT</a>

		<a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>


</body>
</html>
