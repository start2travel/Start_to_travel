<?php
$filename = basename($_SERVER['PHP_SELF']);
if($filename == "index.php"){
	$firsbutton= "ТОП екскурзии";
	$firsbuttonlink= "ekskurzii.php";
	$secondbutton= "Oбекти";
	$secondbuttonlink= "obekti.php";
}
if($filename=="ekskurzii.php"){
	$firsbutton= "Направи си сам";
	$firsbuttonlink= "index.php";
	$secondbutton= "Oбекти ";
	$secondbuttonlink= "obekti.php";
}
if($filename=="obekti.php"){
	$firsbutton= "Направи си сам";
	$firsbuttonlink= "index.php";
	$secondbutton= "ТОП екскурзии";
	$secondbuttonlink= "ekskurzii.php";
}
?>
<div class="headerback">	
	<div align="center" class="header">
		<div class="leftttop">
			<a href="<?php echo $firsbuttonlink;?>"><button class="button"><span><?php echo $firsbutton;?></span></button></a>
			<a href="<?php echo $secondbuttonlink;?>"><button class="button" style="margin-left: 210px;"><span><?php echo $secondbutton;?></a></span></button>
		</div>
		<img src="images/logo.png" >
		
		
		
		<div class="righttop">
			<div class="dropdown" style="float:right;">
				<div class="box"><br><br>
					<a class="loginbutton" href="#popup1"><img src="images/user.png">&nbsp;Вход</a>
				</div>
				<div id="popup1" class="overlay">
					<div class="popup">
						<h2>Here i am</h2>
						<a class="close" href="#">&times;</a>
						<div class="content">
							Thank to pop me out of that button, but now i'm done so you can close this window.
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>