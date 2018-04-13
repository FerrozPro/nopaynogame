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

          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
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
          </div>

          <div class="row">

			<?php 
			
			  $lista_giochi_home = mysql_query("
			  select * 
			  from my_nopaynogame.GAMES 
			  where flag_sale = 'Y' or flag_news = 'Y' ");
			  
			  while($gioco=mysql_fetch_row($lista_giochi_home)){
				$cod_gioco = $gioco[0];
				$nome_gioco = $gioco[1];
				$prezzo_gioco = $gioco[2];
				$prezzo_saldo = $gioco[4];
				$novità = $gioco[6];
				$img = $gioco[7];
				$console = mysql_fetch_row(mysql_query("select desc_console from my_nopaynogame.DOM_CONSOLE where cod_console = '$gioco[3]'"));
				
				
				echo"<div class='col-lg-3 col-md-4 mb-4'>";
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
      <!-- /.row -->

    </div>
    <!-- /.container -->
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>

</html>