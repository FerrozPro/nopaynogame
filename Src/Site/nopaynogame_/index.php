<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
		.checked {
				color: orange;
		}
		</style>
    <title>NoPayNoGame</title>
  </head>
  <header>
  <?php	include 'header.php'; ?>
  </header>
  <body>
    <!-- Page Content -->
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
        <div class='col-md-3'>
        <label for="cod_piattaforma">Piattaforma</label>
        <select id="cod_piattaforma" name='cod_console' class="form-control">
          <option selected></option>
          <?php
            $lista= mysql_query("select * from my_nopaynogame.DOM_CONSOLE");
            
            while($elem=mysql_fetch_row($lista)){
            $cod = $elem[1];
            $cod_value = $elem[0];
            echo"<option value='".$cod_value."'>".$cod."</option>";
            }
          ?>
        </select>
        </div>
        <div class='col-md-3'>
        <label for="cod_genere">Genere</label>
        <select id="cod_genere" name='cod_genere' class="form-control">
          <option selected></option>
          <?php
            $lista= mysql_query("select * from my_nopaynogame.DOM_GENRE");
            
            while($elem=mysql_fetch_row($lista)){
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
          <option selected></option>
          <option  value="0">0 - 15 €</option>
          <option  value="15">15 - 30 €</option>
          <option  value="30">30 - 45 €</option>
          <option  value="45">45 - 60 €</option>
          <option  value="60">60 - 75 €</option>
        </select>
        </div>
      </div>
    </form>

      <!--<div class="row">

       <div id="carouselExampleIndicators" class="carousel slide my-4 d-none d-sm-block" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="http://placehold.it/1200x350" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="http://placehold.it/1200x350" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="http://placehold.it/1200x350" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>-->

        <br><br>
          <h1>Giochi del momento</h1>

          <div class="row">
			<?php 
			
			  $lista_giochi= mysql_query("
			  select * 
			  from my_nopaynogame.GAMES 
			  where flag_sale = 'Y' or flag_news = 'Y' ");
			  
			  while($gioco=mysql_fetch_row($lista_giochi)){
					$cod_gioco = $gioco[0];
					$nome_gioco = $gioco[1];
					$prezzo_gioco = $gioco[2];
					$prezzo_saldo = $gioco[4];
					$novita = $gioco[6];
					$img = $gioco[7];
					$console = mysql_fetch_row(mysql_query("select desc_console from my_nopaynogame.DOM_CONSOLE where cod_console = '$gioco[3]'"));
					
					echo"<div class='col-lg-3 col-md-4 col-sm-6'>";
						echo"<div class='card h-100'>";
							echo"<a href='game.php?game=".$cod_gioco."'><img class='card-img-top img-fluid' src='".$img."' alt=''></a>";
							echo"<div class='card-body'>";
								echo"<h4 class='card-title'>";
								echo"<a href='game.php?game=".$cod_gioco."'>".$nome_gioco."</a>";
								echo"</h4>";

								$stars = mysql_fetch_row(mysql_query("select AVG(stars) from my_nopaynogame.REVIEW where cod_game = '$cod_gioco'"));
								echo'<span class="fa fa-star'; if($stars[0] >= 1 ) { echo' checked'; } echo'"></span>';
								echo'<span class="fa fa-star'; if($stars[0] >= 2 ) { echo' checked'; } echo'"></span>';
								echo'<span class="fa fa-star'; if($stars[0] >= 3 ) { echo' checked'; } echo'"></span>';
								echo'<span class="fa fa-star'; if($stars[0] >= 4 ) { echo' checked'; } echo'"></span>';
								echo'<span class="fa fa-star'; if($stars[0] == 5 ) { echo' checked'; } echo'"></span>';

								if($prezzo_saldo < $prezzo_gioco){
									echo"<h5>€<del>".$prezzo_gioco."</del> -->".$prezzo_saldo."</h5>";
								}else{
									echo"<h5>€".$prezzo_gioco."</h5>";
								}
								echo"<p class='card-text'>".$console[0]."</p>";
							echo"</div>";

							echo"<div class='card-footer'>";
							echo"<form method='POST' action='addtocart.php'>
								<input type='hidden' name='cod_gioco' value=".$cod_gioco." />
								<button type='submit' class='btn btn-block btn-warning'>Aggiungi al Carrello</button>
							</form>";
							echo"</div>";

						echo"</div>";
					echo"</div>";
					}
				
			?>

          </div>
          <!-- /.row -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include 'script.php'; ?>
  </body>
</html>