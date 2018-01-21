<?php

echo '<nav id="user-menu">
            <ul>';
			if ($_SESSION['korisnik']['tip_id'] == 2){
				echo '<li><a href="kategorije_prekrsaja.php">Kategorije prekršaja</a></li>
					  <li><a href="motorna_vozila.php">Motorna vozila</a></li>
					  <li><a href="prekrsaji.php">Prekršaji</a></li>';
			}
			elseif ($_SESSION['korisnik']['tip_id'] == 1){
				echo '<li><a href="kategorije_prekrsaja.php">Kategorije prekršaja</a></li>
					  <li><a href="motorna_vozila.php">Motorna vozila</a></li>
					  <li><a href="prekrsaji.php">Prekršaji</a></li>
					  <li><a href="moje_kategorije.php">Moje kategorije</a></li>
					  <li><a href="unos_prekrsaja.php">Unos prekršaja</a></li>';
			}
			else {
				echo '<li><a href="kategorije_prekrsaja.php">Kategorije prekršaja</a></li>
					  <li><a href="motorna_vozila.php">Motorna vozila</a></li>
					  <li><a href="prekrsaji.php">Prekršaji</a></li>
					  <li><a href="moje_kategorije.php">Moje kategorije</a></li>
					  <li><a href="unos_prekrsaja.php">Unos prekršaja</a></li>
					  <li><a href="korisnici.php">Korisnici</a></li>
					  <li><a href="kategorije.php">Kategorije</a></li>
					  <li><a href="prekrsaji_po_razdoblju.php">Prekršaji razdoblja</a></li>
					  <li><a href="top_korisnici.php">Top 20</a></li>';
			}
 
      echo '</ul>
        </nav>';

?>