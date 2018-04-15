<?php
  session_start();
  include_once 'connection.php';

  $adduser = $_POST['adduser'];
  $addgame = $_POST['addgame'];

  if(isset($adduser)){
  /*QUERY PER NUOVO UTENTE*/
	  $name = $_POST['inputName'];
	  $surname = $_POST['inputSurname'];
	  $username = $_POST['inputUsername'];
	  $address = $_POST['inputAddress'];
	  $role = $_POST['inputRuolo'];
	  $phone = $_POST['inputPhone'];
	  $email = $_POST['inputEmail'];
    $password = MD5($_POST['inputPassword']);
  
	  $query = $conn -> prepare("INSERT INTO USERS(name, surname, address, phone, username, password, cod_role, email)
		VALUES('$name','$surname','$address','$phone','$username','$password','$role','$email')");
    $query -> execute();
    
  }elseif(isset($addgame)){
  /*QUERY PER NUOVO GIOCO*/
    $title = $_POST['inputTitle'];
    $price = $_POST['inputPrice'];
    $price_on_sale = $_POST['inputPriceSale'];
    if($price_on_sale < $price){
      $flag_sale = 'Y';
    }else{
      $flag_sale = 'N';
    }
    $flag_news = $_POST['inputNovita'];
    $image = $_POST['inputImmagine'];
    if($image == NULL){
      $image = 'img/default.jpg';
    }
    $description = $_POST['inputDesc'];
    $spec_req = $_POST['inputReq'];
    $trailer = $_POST['inputTrailer'];
    $cod_console = $_POST['inputConsole'];
    
    $query = $conn -> prepare("INSERT INTO GAMES(title, price, cod_console, price_on_sale, flag_sale, flag_news, image, description, spec_req, trailer)
    VALUES('$title','$price','$cod_console','$price_on_sale','$flag_sale','$flag_news','$image','$description','$spec_req','$trailer')");
    $query -> execute();

    $cod_game_query= ("SELECT cod_game FROM GAMES ORDER BY cod_game DESC LIMIT 1");
    $ris = ($conn->query($cod_game_query));  
        foreach($ris as $riga){
          $cod_game_result=$riga['cod_game'];
    }

    $generi = isset($_POST['inputGeneri']) ? $_POST['inputGeneri'] : array();
    foreach($generi as $co_genere) {
      $query = $conn -> prepare("INSERT INTO GAME_GENRE(cod_game, cod_genre)
      VALUES('$cod_game_result', '$co_genere')");
      $query -> execute();
    }

    $magazzini = isset($_POST['inputMagazzini']) ? $_POST['inputMagazzini'] : array();
    $quantita = isset($_POST['inputQuantita']) ? $_POST['inputQuantita'] : array();
    $i = 0;
    foreach($magazzini as $cod_magazzino) {
      $quantita_magazzino = $quantita[$i];
      $query = $conn -> prepare("INSERT INTO GAME_WAREHOUSE(cod_game, cod_warehouse, quantity)
      VALUES('$cod_game_result','$cod_magazzino', '$quantita_magazzino')");
      $query -> execute();
      $i = $i + 1;
    }

  }
?>

<!doctype html>
<html lang="en">
  <head>
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
    <div class="container">
      <h1>Amministrazione</h1>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="magazzino-tab" data-toggle="tab" href="#magazzino" role="tab" aria-controls="magazzino" aria-selected="true">Magazzino</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="new-magazzino-tab" data-toggle="tab" href="#new-magazzino" role="tab" aria-controls="new-magazzino" aria-selected="false">Aggiungi Nuovo Gioco</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="ordini-tab" data-toggle="tab" href="#ordini" role="tab" aria-controls="ordini" aria-selected="false">Gestione Ordini</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profili-tab" data-toggle="tab" href="#profili" role="tab" aria-controls="profili" aria-selected="false">Gestione Profili</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="new-profili-tab" data-toggle="tab" href="#new-profili" role="tab" aria-controls="new-profili" aria-selected="false">Aggiungi Profilo</a>
          </li>
        </ul>
        
        <div class="tab-content" id="myTabContent">
          <!-- Inizio magazzino -->
          <div class="tab-pane fade show active" id="magazzino" role="tabpanel" aria-labelledby="magazzino-tab">
          <table class="table table-sm">
              <thead>
                <tr>
                  <th scope="col">Codice</th>
                  <th scope="col">Titolo</th>
                  <th scope="col">Prezzo</th>
                  <th scope="col">Console</th>
                  <th scope="col">Prezzo Saldo</th>
                  <th scope="col">Flag Saldo</th>
                  <th scope="col">Flag News</th>
                  <th scope="col">Immagine</th>
                  <th scope="col">Descrizione</th>
                  <th scope="col">Requisiti</th>
                  <th scope="col">Trailer</th>
                  <th scope="col">Data</th>
                  <th scope="col">Quantità Totale</th>
                  <th scope="col">Generi</th>
                  <th scope="col">Modifca</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $lista_giochi = mysql_query("select g.*, SUM(gw.quantity) from my_nopaynogame.GAMES g LEFT JOIN my_nopaynogame.GAME_WAREHOUSE gw ON g.cod_game = gw.cod_game group by g.cod_game");
                  while($gioco=mysql_fetch_row($lista_giochi)){
                    $cod_game = $gioco[0];
                    $title = $gioco[1];
                    $price = $gioco[2];
                    $cod_console = $gioco[3];
                    $price_on_sale = $gioco[4];
                    $flag_sale = $gioco[5];
                    $flag_news = $gioco[6];
                    $image = $gioco[7];
                    $description = $gioco[8];
                    $spec_req = $gioco[9];
                    $trailer = $gioco[10];
                    $insertion_date = $gioco[11];
                    $quantity = $gioco[12];
                    $console = mysql_fetch_row(mysql_query("select desc_console from my_nopaynogame.DOM_CONSOLE where cod_console = '$cod_console'"));
                    $lista_generi = mysql_query("select dg.* from my_nopaynogame.GAME_GENRE gg, my_nopaynogame.DOM_GENRE dg where dg.cod_genre = gg.cod_genre and gg.cod_game = '$cod_game'");
                  
                    echo'<tr';
                    if($quantity == 0 || $quantity == NULL){
                      echo' class="table-danger"';
                    }elseif($quantity < 6){
                      echo' class="table-warning"';
                    }
                    
                    echo'>';
                    echo'<th scope="row">'.$cod_game.'</th>';
                    echo'<td>'.$title.'</td>';
                    echo'<td>'.$price.'</td>';
                    echo'<td>'.$console[0].'</td>';
                    echo'<td>'.$price_on_sale.'</td>';
                    echo'<td>'.$flag_sale.'</td>';
                    echo'<td>'.$flag_news.'</td>';
                    echo'<td>'.$image.'</td>';
                    echo'<td>'.$description.'</td>';
                    echo'<td>'.$spec_req.'</td>';
                    echo'<td>'.$trailer.'</td>';
                    echo'<td>'.$insertion_date.'</td>';
                    echo'<td>'.$quantity.'</td>';
                  
                    echo'<td>';
                    while($genere=mysql_fetch_row($lista_generi)){
                      echo $genere[1].' ';
                    }
                    echo'</td>';

                    echo'
                    <td>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Modifica
                      </button>';

                    echo'
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modifca Gioco</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">';
                          echo"<form method='POST' action='modifica_game.php'>";
                          echo'<ul class="list-group">';
                          
                          echo'<div class="row">';
                            //generi
                            $lista_generi_attivi = mysql_query("select dg.* from my_nopaynogame.GAME_GENRE gg, my_nopaynogame.DOM_GENRE dg where dg.cod_genre = gg.cod_genre and gg.cod_game = '$cod_game'");
                            $lista_generi = mysql_query("select dg.* from my_nopaynogame.DOM_GENRE dg");
                            while($genere=mysql_fetch_row($lista_generi)){
                              $cod_genre = $genere[0];
                              $desc_genre = $genere[1];
                              echo'<div class="col-md-3">';
                              echo'<li class="list-group-item"><label class="form-check-label">
                              <input type="checkbox" class="form-check-input" name="'.$cod_genre.'" value="'.$cod_genre.'" ';
                              while($genere_attivo=mysql_fetch_row($lista_generi_attivi)){
                                $cod_genre_active = $genere_attivo[0];
                                if($cod_genre == $cod_genre_active){
                                  echo'checked="checked"';
                                }
                              }
                                  echo'>
                                  '.$desc_genre.'
                                  </label></li>';
                                  echo'</div>';
                              }

                            echo'<div class="col-md-3"><li class="list-group-item">
                              <label for="title">Titolo</label>
                              <input type="text" name="title" class="form-control" placeholder="'.$title.'">
                            </li></div>';
                            echo'<div class="col-md-3"><li class="list-group-item">
                              <label for="price">Prezzo</label>
                              <input type="text" name="price" class="form-control" placeholder="'.$price.'">
                            </li></div>';
                            echo'<div class="col-md-3"><li class="list-group-item">
                              <label for="price_on_sale">Prezzo Saldo</label>
                              <input type="text" name="price_on_sale" class="form-control" placeholder="'.$price_on_sale.'">
                            </li></div>';
                            echo'<div class="col-md-3"><li class="list-group-item">
                              <label for="flag_news">Novità</label>
                              <select id="flag_news" name="flag_news" class="form-control">
                                <option selected></option>
                                <option  value="Y">SI</option>
                                <option  value="N">NO</option>
                              </select>
                            </li></div>';
                            echo'<div class="col-md-3"><li class="list-group-item">
                              <label for="description">Descrizione</label>
                              <input type="text" name="description" class="form-control" placeholder="'.$description.'">
                            </li></div>';
                            echo'<div class="col-md-3"><li class="list-group-item">
                              <label for="spec_req">Requisiti Minimi</label>
                              <input type="text" name="spec_req" class="form-control" placeholder="'.$spec_req.'">
                            </li></div>';
                            echo'<div class="col-md-3"><li class="list-group-item">
                              <label for="trailer">Trailer</label>
                              <input type="text" name="trailer" class="form-control" placeholder="'.$trailer.'">
                            </li></div>';
                            echo'<div class="col-md-3"><li class="list-group-item">
                              <label for="image">Immagine</label>
                              <input type="text" name="image" class="form-control" placeholder="'.$image.'">
                            </li></div>';
                            //quantità
                            
                            $lista_warehouse = mysql_query("select w.*, gw.quantity from my_nopaynogame.WAREHOUSE w LEFT JOIN my_nopaynogame.GAME_WAREHOUSE gw ON w.cod_warehouse = gw.cod_warehouse where gw.cod_game = '$cod_game'");
                            while($warehouse=mysql_fetch_row($lista_warehouse)){
                              $cod_warehouse = $warehouse[0];
                              $indirizzo = $warehouse[1];
                              $quantity = $warehouse[3];
                              echo'<div class="col-md-3"><li class="list-group-item">';
                              echo'<label for="quantity_'.$cod_warehouse.'">Mag: '.$cod_warehouse.' '.$indirizzo.'</label>
                              <input type="text" name="quantity_'.$cod_warehouse.'" class="form-control" placeholder="'.$quantity.'">';
                              echo'</li></div>';
                            }
                            
                            echo'</row>';
                            echo'</ul>';
                            echo"</form>";
                          echo'</div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                            <button type="submit" class="btn btn-primary">Salva</button>
                        </div>
                      </div>
                    </div>';
                    //finem modal
                  echo'
                  </div>
                  </td>';
                  echo'</tr>';

                }
              
              ?>
            </tbody>
          </table>
          </div>

          <!-- Inizio nuovo gioco -->
          <div class="tab-pane fade" id="new-magazzino" role="tabpanel" aria-labelledby="new-magazzino-tab">
          <form method='post'>
              <!--Righe Gioco-->
						  <div class="form-row">
                <div class="form-group col-md-2">
                  <label for="inputTitle">Titolo</label>
                  <input type="text" class="form-control" name="inputTitle" placeholder="Titolo">
                </div>
                <div class="form-group col-md-2">
                  <label for="inputPrice">Prezzo</label>
                  <input type="text" class="form-control" name="inputPrice" placeholder="xx.xx">
                </div>
                <div class="form-group col-md-2">
                  <label for="inputPriceSale">Prezzo in Saldo</label>
                  <input type="text" class="form-control" name="inputPriceSale" placeholder="xx.xx">
                </div>
                <div class="form-group col-md-2">
                  <label for="inputNovita">Novità</label>
                  <select id="inputNovita" name='inputNovita' class="form-control">
                    <option value="Y" selected></option>
                    <option  value="Y">SI</option>
                    <option  value="N">NO</option>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label for="inputConsole">Console</label>
                  <select id="inputConsole" name='inputConsole' class="form-control">
                    <option selected></option>
                    <?php
                      $lista= mysql_query("select * from my_nopaynogame.DOM_CONSOLE");
                      while($elem = mysql_fetch_row($lista)){
                      $cod = $elem[1];
                      $cod_value = $elem[0];
                      echo"<option value='".$cod_value."'>".$cod."</option>";
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label for="inputImmagine">Immagine</label>
                  <input type="text" class="form-control" name="inputImmagine" placeholder="img/file.jpg">
                </div>
						  </div>

						  <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="inputDesc">Descrizione</label>
                  <textarea type="text" class="form-control" name="inputDesc" placeholder="Descrizione..." rows="3"></textarea>
                </div>
                <div class="form-group col-md-4">
                  <label for="inputReq">Requisiti Minimi</label>
                  <textarea type="text" class="form-control" name="inputReq" placeholder="Requisiti minimi..." rows="3"></textarea>
                </div>
                <div class="form-group col-md-4">
                  <label for="inputTrailer">Trailer</label>
                  <input type="text" class="form-control" name="inputTrailer" placeholder="www.youtube.com/....">
                </div>
						  </div>

              <!--Riga Generi-->
						  <div class="form-row">
                <div class="form-group col-md-12">
                <?php
                    $lista= mysql_query("select * from my_nopaynogame.DOM_GENRE");
                    while($elem = mysql_fetch_row($lista)){
                    $nome_genere = $elem[1];
                    $codice_genere = $elem[0];
                    echo'<div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="inputGeneri[]" value="'.$codice_genere.'">
                      <label class="form-check-label">'.$nome_genere.'</label>
                    </div>';
                    }
                  ?>
						    </div>
						  </div>

              <!--Riga Magazzini-->
						  <div class="form-row">
                <?php
                    $lista= mysql_query("select * from my_nopaynogame.WAREHOUSE");
                    while($elem = mysql_fetch_row($lista)){
                    $cod_magazzino = $elem[0];
                    $indi_maga = $elem[1];
                    echo'
                    <div class="form-group col-md-3">
                      <label for="magazzini[]">'.$cod_magazzino.' '.$indi_maga.'</label>
                      <input class="form-control" type="number" name="inputQuantita[]" value="0">
                      <input class="form-control" type="hidden" name="inputMagazzini[]" value="'.$cod_magazzino.'">
                    </div>
                    ';
                    }
                  ?>
						  </div>

						  <button type="submit" name='addgame' class="btn btn-primary">Aggiungi</button>
						</form>
          </div>
          <!-- Fine nuovo gioco -->

          <!-- Inizio gestione ordini -->
          <div class="tab-pane fade" id="ordini" role="tabpanel" aria-labelledby="ordini-tab">
          </div>
          <!-- Fine gestione ordini -->

          <!-- Inizio gestione profilo -->
          <div class="tab-pane fade" id="profili" role="tabpanel" aria-labelledby="profili-tab">
          </div>
          <!-- Fine gestione profilo -->

          <!-- Inizio nuovo profilo -->
          <div class="tab-pane fade" id="new-profili" role="tabpanel" aria-labelledby="new-profili-tab">
						<form method='post'>
						  <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="inputName">Nome</label>
                  <input type="text" class="form-control" name="inputName" placeholder="Nome">
                </div>
                <div class="form-group col-md-3">
                  <label for="inputSurname">Cognome</label>
                  <input type="text" class="form-control" name="inputSurname" placeholder="Cognome">
                </div>
                <div class="form-group col-md-3">
                  <label for="inputEmail">Email</label>
                  <input type="email" class="form-control" name="inputEmail" placeholder="Email">
                </div>
                <div class="form-group col-md-3">
                  <label for="inputPassword4">Password</label>
                  <input type="password" class="form-control" name="inputPassword" placeholder="Password">
                </div>
						  </div>

						  <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="inputUsername">Username</label>
                  <input type="text" class="form-control" name="inputUsername" placeholder="Username">
                </div>
                <div class="form-group col-md-3">
                  <label for="inputAddress">Indirizzo</label>
                  <input type="text" class="form-control" name="inputAddress" placeholder="via XXX">
                </div>
                <div class="form-group col-md-3">
                  <label for="inputPhone">Phone</label>
                  <input type="text" class="form-control" name="inputPhone" placeholder="1234567890">
                </div>
                

                <div class="form-group col-md-3">
                  <label for="inputRuolo">Ruolo</label>
                  <select id="inputRuolo" name='inputRuolo' class="form-control">
                    <option value="RL1" selected></option>
                    <?php    
                    $lista= mysql_query("select * from my_nopaynogame.DOM_ROLE");
                    while($elem=mysql_fetch_row($lista)){
                    $cod = $elem[1];
                    $cod_value = $elem[0];
                    echo"<option  value='".$cod_value."'>".$cod."</option>";
                    }
                    ?>
                  </select>
                </div>
                
						  </div>

						  <button type="submit" name='adduser' class="btn btn-primary">Aggiungi</button>
						</form>
				  </div>
          <!-- fine nuovo profilo -->
      </div>
    </div>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include 'script.php'; ?>
  </body>

</html>