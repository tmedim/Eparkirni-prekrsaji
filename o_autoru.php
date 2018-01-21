<?php

session_start();

echo '<!DOCTYPE html>
		  <html>
			  <head>
				  <title>O autoru | E-prekršaji</title>
				  <meta charset="utf-8">
				  <link rel="stylesheet" type="text/css" href="css/style.css">
			  </head>
			  <body>
				 <header>';
				 
				 include_once "includes/navigation_main.php";	
				 
		   echo '</header>';
		   
		   echo '<div id="main-body">
					<h2>O autoru</h2>
					<div id="o-autoru">
						<div class="img-container">
							<img src="img/profile.jpg">
						</div>
						<p><b>Ime:</b> Tihomir</p>
						<p><b>Prezime:</b> Međimorac</p>
						<p><b>E-mail:</b> medimorac@gmail.hr</p>
						           
					</div>
				</div>';
			
			echo '<footer>';
					include_once "includes/footer.php";
			echo '</footer>
			</body>
		</html>';

?>