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

  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Prezzo</th>
      <th scope="col">Piattaforma</th>
      <th scope="col">Genere</th>
      <th scope="col">Novità</th>
      <th scope="col">Acquista</th>
    </tr>
  </thead>
  
  <tbody>
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
        //$console = $gioco[3];
        $novità = $gioco[6];
		$img = $gioco[7];
        $console = mysql_fetch_row(mysql_query("select desc_console from my_nopaynogame.DOM_CONSOLE where cod_console = '$gioco[3]'"));
        //echo"<a>".$nome_gioco."</a>";
        echo"<tr>";
        echo"<th><img src='".$img."'/></th>";
        echo"<td>".$nome_gioco."</td>";
        if($prezzo_saldo < $prezzo_gioco){
          echo"<td><del>".$prezzo_gioco."</del> -->".$prezzo_saldo."</td>";
        }else{
          echo"<td>".$prezzo_gioco."</td>";
        }
        echo"<td>".$console[0]."</td>";
        echo"<td></td>";
        if($novità == 'Y'){
          echo"<td>NOVITA!!!</td>";
        }else{
          echo"<td></td>";
        }
        echo"<td><button type='button' class='btn btn-warning'>Aggiungi al Carrello</button></td>";
        echo"</tr>";
      }
    ?>
  </tbody>
</table>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>

</html>