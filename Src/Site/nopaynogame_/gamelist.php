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
						echo"<h1>Catalogo Completo</h1></div><div class='row'>";
						break;
					case 'genere':
						$lista_giochi = mysql_query("select g.* from my_nopaynogame.GAMES g, my_nopaynogame.GAME_GENRE gg where gg.cod_genre = '$id' and g.cod_game = gg.cod_game");
						$nome_genere = mysql_fetch_row(mysql_query("select desc_genre from my_nopaynogame.DOM_GENRE where cod_genre = '$id'"));
						echo"<h1>Genere ".$nome_genere[0]."</h1></div><div class='row'>";
						break;
					case 'console':
						$lista_giochi = mysql_query("select * from my_nopaynogame.GAMES where cod_console = '$id'");
						$nome_console = mysql_fetch_row(mysql_query("select desc_console from my_nopaynogame.DOM_CONSOLE where cod_console = '$id'"));
						echo"<h1>Piattaforma ".$nome_console[0]."</h1></div><div class='row'>";						
						break;
					case 'search':
						$cod_c = $_POST['cod_console'];
						$cod_g = $_POST['cod_genere'];
						$cod_s = $_POST['cod_saldo'];
						$cod_n = $_POST['cod_novita'];
						$cod_t = $_POST['cod_testo'];

						$lista_giochi = mysql_query("
						select distinct g.* 
						from my_nopaynogame.GAMES g, my_nopaynogame.GAME_GENRE gg 
						where 
							g.cod_game = gg.cod_game 
							and g.title like '%".$cod_t."%'
							and g.flag_news like '%".$cod_n."%'
							and g.flag_sale like '%".$cod_s."%'
							and gg.cod_genre like '%".$cod_g."%'
							and g.cod_console like '%".$cod_c."%'
						");

						echo"<h1>Risultati Ricerca</h1></div><div class='row'>";						
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
					echo"<a href='game.php?game=".$cod_gioco."'><img class='card-img-top img-fluid' src='".$img."' alt=''></a>";
					echo"<div class='card-body'>";
					  echo"<h4 class='card-title'>";
						echo"<a href='game.php?game=".$cod_gioco."'>".$nome_gioco."</a>";
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
					  echo"<form method='POST' action='addtocart.php'>
							<input type='hidden' name='cod_gioco' value=".$cod_gioco." />
							<button type='submit' class='btn btn-warning'>Aggiungi al Carrello</button>
						</form>";
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