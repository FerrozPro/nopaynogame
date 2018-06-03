<!doctype html>
<html lang="en">
  <?php	include 'header.php'; ?>
  <body>
    <div class="container">
    <h1>Ricerca</h1>
    
    <form method='POST' action='gamelist.php?tipo_ricerca=search'>
      <div class="row">
        <div class='col-md-9'>
        <input type="text" name="cod_testo" class="form-control" placeholder="Cerca...">
        </div>
        <div class='col-md-3'>
        <button type="submit" class="btn btn-block btn-primary">Cerca</button>
        </div>
      </div>
      <div class="row">

        <div class='col-md-2'>
        <label for="cod_piattaforma">Piattaforma</label>
        <select id="cod_piattaforma" name='cod_console' class="form-control">
          <option selected></option>
          <?php
          $lista = ($conn->query("SELECT * from my_nopaynogame.DOM_CONSOLE"));
          foreach($lista as $elem) {
            $cod = $elem[1];
            $cod_value = $elem[0];
            echo"<option value='".$cod_value."'>".$cod."</option>";
            }
          ?>
        </select>
        </div>

        <div class='col-md-2'>
        <label for="cod_genere">Genere</label>
        <select id="cod_genere" name='cod_genere' class="form-control">
          <option selected></option>
          <?php
          $lista = ($conn->query("SELECT * from my_nopaynogame.DOM_GENRE"));
          foreach($lista as $elem) {
            $cod = $elem[1];
            $cod_value = $elem[0];
            echo"<option  value='".$cod_value."'>".$cod."</option>";
            }
          ?>
        </select>
        </div>

        <div class='col-md-2'>
        <label for="cod_saldo">Saldo</label>
        <select id="cod_saldo" name='cod_saldo' class="form-control">
          <option selected></option>
          <option  value="Y">SI</option>
          <option  value="N">NO</option>
        </select>
        </div>

        <div class='col-md-2'>
        <label for="cod_novita">Novità</label>
        <select id="cod_novita" name='cod_novita' class="form-control">
          <option selected></option>
          <option  value="Y">SI</option>
          <option  value="N">NO</option>
        </select>
        </div>

        <div class='col-md-2'>
        <label for="cod_prezzo">Prezzo</label>
        <select id="cod_prezzo" name='cod_prezzo' class="form-control">
          <option value="-1" selected></option>
          <option  value="0">0 - 15 €</option>
          <option  value="15">15 - 30 €</option>
          <option  value="30">30 - 45 €</option>
          <option  value="45">45 - 60 €</option>
          <option  value="60">60 - 75 €</option>
        </select>
        </div>

        <div class='col-md-2'>
        <label for="cod_review">Rating</label>
        <select id="cod_review" name='cod_review' class="form-control">
          <option value="-1" selected></option>
          <option  value="0">0+ stelle</option>
          <option  value="1">1+ stelle</option>
          <option  value="2">2+ stelle</option>
          <option  value="3">3+ stelle</option>
          <option  value="4">4+ stelle</option>
        </select>
        </div>

      </div>
    </form>
        <br><br>
          <h1>Giochi del momento</h1>

          <div class="row">
			<?php 
      
      $lista_giochi = ($conn->query("SELECT * from my_nopaynogame.GAMES where flag_sale = 'Y' or flag_news = 'Y' "));
        foreach($lista_giochi as $gioco) {
					$cod_gioco = $gioco[0];
					$nome_gioco = $gioco[1];
					$prezzo_gioco = $gioco[2];
					$prezzo_saldo = $gioco[4];
					$novita = $gioco[6];
          $img = $gioco[7];
          $query = ($conn->query("SELECT desc_console from my_nopaynogame.DOM_CONSOLE where cod_console = '$gioco[3]'"));
          foreach($query as $riga) {
					  $console = $riga['desc_console'];
          }
					echo"<div class='col-lg-3 col-md-4 col-sm-6'>";
						echo"<div class='card h-100'>";
							echo"<a href='game.php??cp=game&game=".$cod_gioco."'><img class='card-img-top img-fluid' src='".$img."' alt=''></a>";
							echo"<div class='card-body'>";
								echo"<h4 class='card-title'>";
								echo"<a href='game.php?cp=game&game=".$cod_gioco."'>".$nome_gioco."</a>";
								echo"</h4>";
                $query = ($conn->query("SELECT AVG(stars) from my_nopaynogame.REVIEW where cod_game = '$cod_gioco'"));
                foreach($query as $riga) {
                  $stars = $riga[0];
                }
								echo'<span class="fa fa-star'; if($stars[0] >= 1 ) { echo' checked'; } echo'"></span>';
								echo'<span class="fa fa-star'; if($stars[0] >= 2 ) { echo' checked'; } echo'"></span>';
								echo'<span class="fa fa-star'; if($stars[0] >= 3 ) { echo' checked'; } echo'"></span>';
								echo'<span class="fa fa-star'; if($stars[0] >= 4 ) { echo' checked'; } echo'"></span>';
								echo'<span class="fa fa-star'; if($stars[0] == 5 ) { echo' checked'; } echo'"></span>';

								if($prezzo_saldo < $prezzo_gioco){
                  echo"<h5>€<del>".$prezzo_gioco."</del> <i class='fa fa-chevron-right'></i> €".$prezzo_saldo."</h5>";
                  echo'<span class="badge badge-pill badge-danger">SALDO</span>';
								}else{
									echo"<h5>€".$prezzo_gioco."</h5>";
                }

								if($novita == 'Y'){
                  echo'<span class="badge badge-pill badge-success">NUOVO!</span>';
								}
                
								echo"<p class='card-text'>".$console."</p>";
							echo"</div>";

							echo"<div class='card-footer'>";
							echo"<form method='POST' action='addtocart.php'>
                <input type='hidden' name='cod_gioco' value=".$cod_gioco." />";
                $query = ($conn->query("SELECT SUM(quantity) from my_nopaynogame.GAME_WAREHOUSE where cod_game = '$cod_gioco'"));
                foreach($query as $riga) {
                  $quantita = $riga[0];
                }
                echo"<button type='submit' class='btn btn-block ";
                if($quantita == 0){
                  echo"btn-danger' disabled>Non Disponibile</button>";
                }else{
                  echo"btn-warning'>Aggiungi al Carrello</button>";
                } echo"
							</form>";
							echo"</div>";

						echo"</div>";
					echo"</div>";
					}
				
			?>
          </div>
      </div>
    </div>
    <?php include 'script.php'; ?>
  </body>
</html>