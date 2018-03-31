<?php 
	require_once("LogicLayer/UserManager.php");
	session_start();
	$kullanici = null;
	
	if(isset($_SESSION['kullanici'])) {
		$kullanici =  $_SESSION['kullanici'];
		//echo $kullanici;
		//echo "asdasd";
	}
	
	if( isset($_POST["kullanici_maili"]) && isset($_POST["sifre"]) ) 
	{ 		
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "sports";
		
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		if ($conn->connect_error) {
			die("Bağlantı hatası: " . $conn->connect_error);
		}
		
		$conn->set_charset("utf8");
		
		$query = "Select maill From user WHERE maill = '".$_POST["kullanici_maili"]."' and password = '".$_POST["sifre"]."'";
		$result = $conn->query($query);
		
		$row = $result->fetch_assoc();
		
		if($row['maill'] == null)
		{
			$mesaj = "Bilgilerinizi kontrol edip tekrar deneyiniz";
		}
		else
		{
			session_start();
			$_SESSION['kullanici'] = $row['maill'];			
			
				 header("location: index.php");	
		    
		}	
	}
	else
	{
		$mesaj = "";
	} 
	
	$errorMeesage = "";
	
	if(isset($_POST["username"]) && isset($_POST["usersurname"])&& isset($_POST["email"])&& isset($_POST["password"])) {
		$name = trim($_POST["username"]);
		$surname = trim($_POST["usersurname"]);
		$email = trim($_POST["email"]);
		$password = trim($_POST["password"]);
		
		$errorMeesage = "";
		$result = UserManager::insertNewUser($name, $surname, $email, $password);
		if(!$result) {
			$errorMeesage = "Yeni kullanıcı kaydı başarısız!";
		}	
		
	}

?>


<!DOCTYPE HTML>
<html>
<head>
<title>SPORT Category</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Green Wheels Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->

</head>
<body>
<!-- top-header -->
<div class="top-header">
	<div class="container">
		<ul class="tp-hd-lft wow fadeInLeft animated" data-wow-delay=".5s">
			<li class="hm"><a href="index.php"><i class="fa fa-home"></i></a></li>				
		</ul>
		<ul class="tp-hd-rgt wow fadeInRight animated" data-wow-delay=".5s"> 		
			<?php 
				if($kullanici == null){
				?>
					<li class="sig"><a href="#" data-toggle="modal" data-target="#myModal" >Sign Up</a></li> 
					<li class="sigi"><a href="#" data-toggle="modal" data-target="#myModal4" >/ Sign In</a></li>
			<?php 
				}
				else{
			?>			
					<li class="sig"><a href="#" data-toggle="modal" data-target="#myModal" ><?php echo "Welcome : ".  $kullanici ?></a></li> 
					<li class="sigi"><a href="#" data-toggle="modal" data-target="#myModal4" >/ Logout</a></li>
			<?php 		
				}
			?>
        </ul>
		<div class="clearfix"></div>
	</div>
</div>
<!--- /top-header ---->
<!--- header ---->
<div class="header">
	<div class="container">
		<div class="logo wow fadeInDown animated" data-wow-delay=".5s">
			<a href="index.php"><span style="color:yellow">SPORT </span> <span style="color:red">EVENTS</span></a>	
		</div>
		<div class="bus wow fadeInUp animated" data-wow-delay=".5s">
            <a href="index.php" class="buses active"><span style="color:DarkSlateGray">HOME</span></a>
            <a href="shop.php"><span style="color:DarkSlateGray">EVENTS</span></a>
        </div>
		
	</div>
</div>
<!--- /header ---->
<!--- footer-btm ---->
<div class="footer-btm wow fadeInLeft animated" data-wow-delay=".5s">
	<div class="container">
	<div class="navigation">
			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="content_menu" id="bs-example-navbar-collapse-1">
					<nav class="navbar navbar-inverse">
						<ul class="nav navbar-nav">
							<li><a href="about.html">About</a></li>
								<li><a href="faq.html">Faq</a></li>
								<li><a href="apps.html">Apps</a></li>
								<li><a href="blog.html">Blog</a></li>
								<li><a href="travels.html">Travels</a></li>
								<li><a href="privacy.html">Privacy Policy</a></li>
								<li><a href="agent.html">Agent Registration</a></li>
								<li><a href="terms.html">Terms of Use</a></li>
								<li><a href="contact.html">Contact Us</a></li>
								<li>Need Help?<a href="#" data-toggle="modal" data-target="#myModal3"> / Write Us </a>  </li>
								<div class="clearfix"></div>
						</ul>
					</nav>
				</div><!-- /.navbar-collapse -->	
			</nav>
		</div>
	</div>
</div>
<!--- /footer-btm ---->
<!--- banner ---->

<div class="banner">
	<div class="sear">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"></h1>
	</div>
</div>

<div>

</div>
<div class="sear">
	<div class="col-md-5 bann-info1 wow fadeInLeft animated" data-wow-delay=".5s">
		<img src="images\\s.jpg" alt="MDN" height="180" width="380">
		<h3>SEARCH SPORT EVENTS</h3>
	</div>
	<div class="col-md-7 bann-info wow fadeInRight animated" data-wow-delay=".5s">
		<h2>What Are You Looking For ? </h2>
		<div class="ban-top">
			<div class="bnr-left">
				<label class="inputLabel">CITY</label>
				<input class="city" type="text" value="Enter a city" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter a city';}" required=>
			</div>
		
			<div class="bnr-left">			
			<label class="inputLabel">TYPE</label>
				<div class="dropdown-button">				
					<select class="dropdown" tabindex="9" data-settings='{"wrapperClass":"flat"}'>
							<option value="0">TYPE</option>	
							<option value="1">Football</option>
							<option value="2">Basketball</option>
							<option value="3">Volleyball</option>
							<option value="4">Tennis</option>
							<div class="clearfix"></div>
					</select>
				</div>
			</div>		
		</div>
		
		<div class="ban-bottom">		
			<div class="bnr-left">
				<label class="inputLabel">VENUE</label>
				<input class="city" type="text" value="Enter a type" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter a venue';}" required=>
			</div>
			<div class="bnr-right">
				<label class="inputLabel">Date of Event</label>
				<input class="date" id="datepicker" type="text" value="dd-mm-yyyy" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'dd-mm-yyyy';}" required=>
			</div>
			
				<div class="clearfix"></div>
				<!---start-date-piker---->
				<link rel="stylesheet" href="css/jquery-ui.css" />
				<script src="js/jquery-ui.js"></script>
					<script>
						$(function() {
						$( "#datepicker,#datepicker1" ).datepicker();
						});
					</script>
			<!---/End-date-piker---->
		</div>
		<div class="sear">
			<form action="bus.html">
				<button class="seabtn">Search</button>
			</form>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<!--- /banner ---->
<!--- rupes ---->
<div class="container">
	<div class="holiday">
		<div class="col-md-3 holiday-left animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp;">
			<img src="images/galatasaray-4-yıldızlı-yeni-logo-4.jpg" class="img-responsive" alt="">
		</div>
		<div class="col-md-6 holiday-mid animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp;">
		<h3><span style="color:red">GALATASARAY </span> - <span style="color:black">BEŞİKTAŞ</span></h3>
		<p>Ligin 32. Haftasında GALATASARAY BEŞİKTAŞ'ı Türk Telekom Arena Ali Sami Yen Spor Kompleksinde ağırlayacak.</p>
		<a href="event-payment.html" class="learn">Learn More</a>
		</div>
		<div class="col-md-3 holiday-left animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp;">
			<img src="images/besiktas-logo.png" class="img-responsive" alt="">
		</div>
			<div class="clearfix"></div>
	</div>
</div>
<!--- /rupes ---->
<!---holiday---->
<div class="container">
	<div class="holiday">
		<div class="col-md-3 holiday-left animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp;">
			<img src="images/tt.png" class="img-responsive" alt="">
		</div>
		<div class="col-md-6 holiday-mid animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp;">
		<h3>Türk Telekom - Torku Konyaspor</h3>
		<p>30 Nisan 2016 16:00 <br> Ankara Spor Salonu, Ankara </p>
		<a href="event-payment.html" class="learn">Learn More</a>
		</div>
		<div class="col-md-3 holiday-left animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp;">
			<img src="images/tks.png" class="img-responsive" alt="">
		</div>		
			<div class="clearfix"></div>
	</div>
</div>
<!---/holiday---->
<!---track---->
<div class="container">
	<div class="holiday">
		<div class="col-md-3 holiday-left animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp;">
			<img src="images/bjk.jpg" class="img-responsive" alt="">
		</div>
		<div class="col-md-6 holiday-mid animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp;">
		<h3> <span style="color:black">Beşiktaş SompoJapan </span> <br> <span style="color:red"> Galatasaray Odeabank </span></h3>
		<p>Türkiye Spor Toto Basketbol Ligi'nde 28. hafta mücadelesinde Beşiktaş Sompo Japan, Sinan Erdem Spor Salonu'nda Galatasaray Odeabank’ı konuk ediyor.</p>
		<a href="event-payment.html" class="learn">Learn More</a>
		</div>
		<div class="col-md-3 holiday-left animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp;">
			<img src="images/gs.jpg" class="img-responsive" alt="">
		</div>
			<div class="clearfix"></div>
	</div>
</div>
<!--- /track ---->
<!--- routes ---->
<div class="container">
	<div class="track">
		<div class="col-md-6 track-right wow fadeInLeft animated" data-wow-delay=".5s">
			<a href="track.html"><img src="images/map1.png" class="img-responsive" alt=""></a>
		</div>
		<div class="col-md-6 track-left wow fadeInRight animated" data-wow-delay=".5s">
			<h3>TRACK MY BUS</h3>
			<p>First of its own kind,bus tracking feature on bus</p>
			<a href="track.html" class="learn">Learn More</a>
		</div>
			<div class="clearfix"></div>
	</div>
</div>
<!--- /routes ---->
<!--- footer-top ---->
<div class="footer-top">
	<div class="container">
		<div class="col-md-6 footer-left wow fadeInLeft animated" data-wow-delay=".5s">
			<h3>Events Type</h3>
				<ul>
					<li><a href="https://en.wikipedia.org/wiki/Football">Football </a></li>
					<li><a href="https://en.wikipedia.org/wiki/Basketball">Basketball</a></li>
					<li><a href="https://en.wikipedia.org/wiki/Volleyball">Volleyball</a></li>
					<li><a href="https://en.wikipedia.org/wiki/Tennis">Tennis</a></li>					
					<div class="clearfix"></div>
				</ul>
		</div>
		<div class="col-md-6 footer-left wow fadeInRight animated" data-wow-delay=".5s">
			<h3>Stadiums</h3>
				<ul>
					<li><a href="https://tr.wikipedia.org/wiki/Abdi_%C4%B0pek%C3%A7i_Arena">Abdi İpekçi Arena</a></li>
					<li><a href="https://tr.wikipedia.org/wiki/Sinan_Erdem_Spor_Salonu">Sinan Erdem Spor Salonu</a></li>
					<li><a href="https://tr.wikipedia.org/wiki/%C3%9Clker_Sports_Arena">Ülker Sports Arena</a></li>					
					<li><a href="https://tr.wikipedia.org/wiki/T%C3%BCrk_Telekom_Arena">Ali Sami Yen Spor Kompleksi Türk Telekom Arena </a></li>
					<li><a href="https://tr.wikipedia.org/wiki/Ankara_Spor_Salonu">Ankara Spor Salonu</a></li>
					<li><a href="https://tr.wikipedia.org/wiki/BJK_Akatlar_Arena">Beşiktaş Akatlar Arena</a></li>
					<li><a href="https://tr.wikipedia.org/wiki/Vodafone_Arena"> Vodafone Arena</a></li>
					<li><a href="https://tr.wikipedia.org/wiki/Fenerbah%C3%A7e_%C5%9E%C3%BCkr%C3%BC_Saraco%C4%9Flu_Stadyumu">Fenerbahçe Şükrü Saracoğlu Stadyumu</a></li>					
					<div class="clearfix"></div>
				</ul>
		</div>
			<div class="col-md-6 footer-left wow fadeInRight animated" data-wow-delay=".5s">
			<h3>Cities</h3>
				<ul>
					<li><a href="https://tr.wikipedia.org/wiki/%C4%B0stanbul">İstanbul</a></li>
					<li><a href="https://tr.wikipedia.org/wiki/Ankara">Ankara</a></li>
					<li><a href="https://tr.wikipedia.org/wiki/%C4%B0zmir">İzmir</a></li>									
					<div class="clearfix"></div>
				</ul>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!--- /footer-top ---->
<!---copy-right ---->
<div class="copy-right">
	<div class="container">
	
		<div class="footer-social-icons wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">
			<ul>
				<li><a class="facebook" href="#"><span>Facebook</span></a></li>
				<li><a class="twitter" href="#"><span>Twitter</span></a></li>
				<li><a class="flickr" href="#"><span>Flickr</span></a></li>
				<li><a class="googleplus" href="#"><span>Google+</span></a></li>
				<li><a class="dribbble" href="#"><span>Dribbble</span></a></li>
			</ul>
		</div>
		<p class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">© 2016 S.B.Y.E.B . All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
	</div>
</div>
		
<!--- /copy-right ---->
<!-- sign -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						</div>
							<section>
								<div class="modal-body modal-spa">
									<div class="login-grids">
										<div class="login">	
											<div class="login-left">												
													<div class="col-md-5 bann-info1 wow fadeInLeft animated" data-wow-delay=".5s">
														<img src="images\\user-icon-6.png" alt="MDN" height="300" width="130">														
													</div>										
											</div>	
											<div class="login-right">
												<form method="POST" action="<?php $_PHP_SELF ?>">
													<h3>Create your account </h3>
													<input type="text" id="adsoyad" value="Name" name="username" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" required />>
													<input type="text" value="Surname" name="usersurname" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Surname';}" required />>
													<input type="text" value="Email" name="email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required />>	
													<input type="text" value ="Password" name="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required />>	
													<input type="submit" value="CREATE ACCOUNT">
													
													<?php 
														if(isset($errorMeesage)) {
															echo "<br>" . "<span style='color: red;'>" . $errorMeesage . "</span>";
														}
													?>
												</form>			
											</div>
												<div class="clearfix"></div>								
										</div>
											<p>By logging in you agree to our <a href="terms.html">Terms and Conditions</a> and <a href="privacy.html">Privacy Policy</a></p>
									</div>
								</div>
							</section>
					</div>
				</div>
			</div>
					
			
<!-- //sign -->
<!-- signin -->
		<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-info">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>						
						</div>
						<div class="modal-body modal-spa">
							<div class="login-grids">
								<div class="login">		
									<div class="login-left">												
													<div class="col-md-5 bann-info1 wow fadeInLeft animated" data-wow-delay=".5s">
														<img src="images\\user-icon-6.png" alt="MDN" height="300" width="130">														
													</div>												
									</div>	
									<div class="login-right">
										<form method="POST" action="<?php $_PHP_SELF ?>">
											<h3>Signin with your account </h3>
											<input type="text" id="em" value="Enter your Email" name="kullanici_maili" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter your Email';}" required="">	
											<input type="Password" value="Password" name="sifre" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">	
											<h4><a href="#">Forgot password</a></h4>
											<div class="single-bottom">
												<input type="checkbox" id="brand" value="">
												<label for="brand"><span></span>Remember Me.</label>
											</div>
											<tr>
												<td colspan="2">
													<?php echo $mesaj; ?>
												</td>
											</tr>
											<input type="submit" value="SIGNIN">											
										</form>				
									</div>
									<div class="clearfix"></div>								
								</div>
								<p>By logging in you agree to our <a href="terms.html">Terms and Conditions</a> and <a href="privacy.html">Privacy Policy</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
<!-- //signin -->

<!-- write us -->
			<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						</div>
							<section>
								<div class="modal-body modal-spa">
									<div class="writ">
										<h4>HOW CAN WE HELP YOU</h4>
											<ul>
												<li class="na-me">
													<input class="name" type="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" required="">
												</li>
												<li class="na-me">
													<input class="Email" type="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
												</li>
												<li class="na-me">
													<input class="number" type="text" value="Mobile Number" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Mobile Number';}" required="">
												</li>
												<li class="na-me">
													<select id="country" onchange="change_country(this.value)" class="frm-field required sect">
														<option value="null">Select Issue</option> 		
														<option value="null">Booking Issues</option>
														<option value="null">Bus Cancellation</option>
														<option value="null">Refund</option>
														<option value="null">Wallet</option>														
													</select>
												</li>
												<li class="na-me">
													<select id="country" onchange="change_country(this.value)" class="frm-field required sect">
														<option value="null">Select Issue</option> 		
														<option value="null">Booking Issues</option>
														<option value="null">Bus Cancellation</option>
														<option value="null">Refund</option>
														<option value="null">Wallet</option>														
													</select>
												</li>
												<li class="descrip">
													<input class="special" type="text" value="Write Description" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Write Description';}" required="">
												</li>
													<div class="clearfix"></div>
											</ul>
											<div class="sub-bn">
												<form>
													<button class="subbtn">Submit</button>
												</form>
											</div>
									</div>
								</div>
							</section>
					</div>
				</div>
			</div>
<!-- //write us -->
</body>
</html>
