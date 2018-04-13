<!doctype html>
<html lang="en">
  
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>NoPayNoGame</title>
  </head>
  
  <header>
  <?php	include 'header.php'; ?>
  </header>
  <body>
  
  
      <!-- Page Content -->
    <div class="container">

      <div class="row">

          

			<?php 
				
			  $tipo_ricerca = $_GET["tipo_ricerca"];
			  $id = $_GET["id"];
			  
			  switch ($tipo_ricerca) {
					case 'catalogo':
						$lista_giochi = mysql_query("select * from my_nopaynogame.GAMES");
						break;
					case 'genere':
						$lista_giochi = mysql_query("select g.* from my_nopaynogame.GAMES g, my_nopaynogame.GAME_GENRE gg where gg.cod_genre = '$id' and g.cod_game = gg.cod_game");
						break;
					case 'console':
						$lista_giochi = mysql_query("select * from my_nopaynogame.GAMES where cod_console = '$id'");
						break;
				}

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
					echo"<a href='game.php'><img class='card-img-top img-fluid' src='".$img."' alt=''></a>";
					echo"<div class='card-body'>";
					  echo"<h4 class='card-title'>";
						echo"<a href='game.php'>".$nome_gioco."</a>";
					  echo"</h4>";
					  if($prezzo_saldo < $prezzo_gioco){
						  echo"<h5>€<del>".$prezzo_gioco."</del> -->".$prezzo_saldo."</h5>";
						}else{
						  echo"<h5>€".$prezzo_gioco."</h5>";
						}
					  echo"<p class='card-text'>".$console[0]."</p>";
					echo"</div>";
					echo"<div class='card-footer'>";
					  echo"<small class='text-muted'>&#9733; &#9733; &#9733; &#9733; &#9734;</small>";
					  echo"<p><a href='#' class='btn btn-warning' role='button'>Aggiungi al Carrello</a></p>";
					echo"</div>";
				  echo"</div>";
				echo"</div>";
			  }
				
			?>

          

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include 'script.php'; ?>
  </body>

</html>