<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>NoPayNoGame</title>
  </head>
  
  <header>
  <?php	include 'header.php'; ?>
  </header>
  

  <body>
    <div class="container">
      <h1>Amministrazione</h1>
      
<!-- INZIO PHP -->
  <?php
  session_start();
  include_once 'connection.php';

  if($_SESSION['role']=="RL1"|| !isset($_SESSION['role'])){
    header('Location: sign.php?cp=sign&msg=forbidden');
  }

  $adduser = $_POST['adduser'];
  $addgame = $_POST['addgame'];
  $save_user = $_POST['save_user'];
  $updategame = $_POST['updategame'];
  $deletegame = $_POST['deletegame'];
  $deleteordine = $_POST['deleteordine'];

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

  }elseif(isset($save_user)){
    /*QUERY PER MODIFCA USER*/ 
    $save_user = $_POST['user'];
    $save_role = $_POST['role'];
    $save_active = $_POST['active'];
    $save_deleted = $_POST['deleted'];

    $query = $conn -> prepare("UPDATE USERS SET cod_role = '$save_role', flag_deleted = '$save_deleted', flag_active = '$save_active' WHERE id_user = '$save_user'");
    $query -> execute();
  }elseif(isset($updategame)){
    /*QUERY PER UPDATE GIOCO*/ 
    $modCodGame = $_POST['modCodGame'];
    $modTitle = $_POST['modTitle'];
    $modPrice = $_POST['modPrice'];
    $modPriceSale = $_POST['modPriceSale'];
    if($modPriceSale < $modPrice){
      $modSale = 'Y';
    }else{
      $modSale = 'N';
    }
    $modNovita = $_POST['modNovita'];
    $modConsole = $_POST['modConsole'];
    $modImmagine = $_POST['modImmagine'];
    $modDesc = $_POST['modDesc'];
    $modReq = $_POST['modReq'];
    $modTrailer = $_POST['modTrailer'];

    $modGeneri = isset($_POST['modGeneri']) ? $_POST['modGeneri'] : array();
    $modMagazzini = isset($_POST['modMagazzini']) ? $_POST['modMagazzini'] : array();
    $modQuantita = isset($_POST['modQuantita']) ? $_POST['modQuantita'] : array();

    $query = $conn -> prepare("UPDATE GAMES 
    SET 
    title = '$modTitle', 
    price = '$modPrice', 
    cod_console = '$modConsole', 
    price_on_sale = '$modPriceSale', 
    flag_sale = '$modSale', 
    flag_news = '$modNovita', 
    image = '$modImmagine', 
    description = '$modDesc', 
    spec_req = '$modReq', 
    trailer = '$modTrailer'
    WHERE cod_game = '$modCodGame'");
    $query -> execute();

    $query = $conn -> prepare("DELETE FROM GAME_GENRE WHERE cod_game = '$modCodGame'");
    $query -> execute();

    foreach($modGeneri as $co_genere) {
      $query = $conn -> prepare("INSERT INTO GAME_GENRE(cod_game, cod_genre)
      VALUES('$modCodGame', '$co_genere')");
      $query -> execute();
    }

    $i = 0;
    foreach($modMagazzini as $cod_magazzino) {
      $quantita_magazzino = $modQuantita[$i];
      $i = $i + 1;
      $query = $conn -> prepare("UPDATE GAME_WAREHOUSE 
      SET 
      quantity = '$quantita_magazzino'
      WHERE cod_game = '$modCodGame' and cod_warehouse = '$cod_magazzino'");
      $query -> execute();

    }
  }elseif(isset($deletegame)){
    /*QUERY PER ELIMINA GIOCO*/ 
    $modCodGame = $_POST['modCodGame'];
    try {
      $conn -> beginTransaction();
	  
      $conn -> exec("DELETE FROM GAME_GENRE WHERE cod_game = '$modCodGame'");
      $conn -> exec("DELETE FROM GAME_WAREHOUSE WHERE cod_game = '$modCodGame'");
      $conn -> exec("DELETE FROM GAMES WHERE cod_game = '$modCodGame'");
      $conn -> commit();

    }catch (Exception $e){
      $conn -> rollBack();
	  echo'
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>ATTENZIONE!</strong> Non è possibile cancellare il gioco poichè è presente in uno o più ordini.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    
  }elseif(isset($deleteordine)){
    /*QUERY PER ELIMINA ORDINE*/ 
    $del_ordine = $_POST['del_ordine'];
    $id_user = $_POST['id_user_order'];

    $order_games= ("SELECT cod_game,quantity,game_price FROM GAME_ORDER WHERE id_order = '$del_ordine'");
    $ris = ($conn->query($order_games));  
    foreach($ris as $riga){
      $cod_game_result = $riga['cod_game'];
      $quantity_result = $riga['quantity'];
      $game_price_result = $riga['game_price'];
      $warehouse = 'WH1';
      
      $quantity_warehouse= ("SELECT quantity FROM GAME_WAREHOUSE WHERE cod_game = '$cod_game_result'");
      $risultato = ($conn->query($quantity_warehouse));  
      foreach($risultato as $rigas) {
        $safequantity = $rigas['quantity'];
      }

      $query = $conn -> prepare("UPDATE GAME_WAREHOUSE 
      SET 
      quantity = '$safequantity'+'$quantity_result'
      WHERE cod_game = '$cod_game_result' and cod_warehouse = '$warehouse'");
      $query -> execute();
      
      $quantity_warehouse= ("SELECT wallet FROM USERS WHERE id_user = '$id_user'");
      $risultato = ($conn->query($quantity_warehouse));  
      foreach($risultato as $rigas) {
        $wallet = $rigas['quantity'];
      }

      $query = $conn -> prepare("UPDATE USERS 
      SET 
      wallet = '$wallet'+'$quantity_result'*'$game_price_result'
      WHERE id_user = '$id_user'");
      $query -> execute();
    }


    $query = $conn -> prepare("DELETE FROM GAME_ORDER WHERE id_order = '$del_ordine'");
    $query -> execute();
    
    $query = $conn -> prepare("DELETE FROM ORDERS WHERE id_order = '$del_ordine'");
    $query -> execute();
  }
?>

<!-- FINE PHP -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <?php
          if($_SESSION['role']=="RL4" || $_SESSION['role']=="RL3" || $_SESSION['role']=="RL2"){
            echo'
            <li class="nav-item">
              <a class="nav-link active" id="magazzino-tab" data-toggle="tab" href="#magazzino" role="tab" aria-controls="magazzino" aria-selected="true">Magazzino</a>
            </li>
            ';
          }
          if($_SESSION['role']=="RL4" || $_SESSION['role']=="RL3" || $_SESSION['role']=="RL2"){
            echo'
            <li class="nav-item">
              <a class="nav-link" id="new-magazzino-tab" data-toggle="tab" href="#new-magazzino" role="tab" aria-controls="new-magazzino" aria-selected="false">Aggiungi Nuovo Gioco</a>
            </li>
            ';
          }
          if($_SESSION['role']=="RL4" || $_SESSION['role']=="RL3"){
            echo'
            <li class="nav-item">
              <a class="nav-link" id="ordini-tab" data-toggle="tab" href="#ordini" role="tab" aria-controls="ordini" aria-selected="false">Gestione Ordini</a>
            </li>
            ';
          }
          if($_SESSION['role']=="RL4"){
            echo'
            <li class="nav-item">
              <a class="nav-link" id="profili-tab" data-toggle="tab" href="#profili" role="tab" aria-controls="profili" aria-selected="false">Gestione Profili</a>
            </li>
            ';
          }
          if($_SESSION['role']=="RL4"){
            echo'
            <li class="nav-item">
              <a class="nav-link" id="new-profili-tab" data-toggle="tab" href="#new-profili" role="tab" aria-controls="new-profili" aria-selected="false">Aggiungi Profilo</a>
            </li>
            ';
          }
        ?>
        </ul>
        
        <div class="tab-content" id="myTabContent">
          <!-- Inizio magazzino -->
          <div class="tab-pane fade show active" id="magazzino" role="tabpanel" aria-labelledby="magazzino-tab">
            <div id="accordion">
            <?php 
              $i = 0;
              $lista_giochi = mysql_query("select g.*, SUM(gw.quantity) from my_nopaynogame.GAMES g LEFT JOIN my_nopaynogame.GAME_WAREHOUSE gw ON g.cod_game = gw.cod_game group by g.cod_game order by g.title");
              while($gioco=mysql_fetch_row($lista_giochi)){
                $cod_game = $gioco[0];
                $title = $gioco[1];
                $price = $gioco[2];
                $cod_console = $gioco[3];
                $nome_console = mysql_fetch_row(mysql_query("select desc_console from my_nopaynogame.DOM_CONSOLE where cod_console = '$cod_console'"));
                $price_on_sale = $gioco[4];
                $flag_sale = $gioco[5];
                $flag_news = $gioco[6];
                $image = $gioco[7];
                $description = $gioco[8];
                $spec_req = $gioco[9];
                $trailer = $gioco[10];
                $insertion_date = $gioco[11];
                $quantita_totale = $gioco[12];
            
                echo'
                <div class="card '; 
                if($quantita_totale == 0){
                  echo'border-danger';
                }elseif($quantita_totale <= 10){
                  echo'border-warning';
                } 
                echo'">
                  <div class="card-header" id="heading'.$cod_game.'">
                    <h5 class="mb-0">
                      <button class="btn" data-toggle="collapse" data-target="#collapse'.$cod_game.'" aria-expanded="true" aria-controls="collapse'.$cod_game.'">';
                      if($quantita_totale == 0){
                        echo'<i class="fa fa-times" style="color:red"></i>';
                      }elseif($quantita_totale <= 10){
                        echo'<i class="fa fa-exclamation-triangle" style="color:yellow"></i>';
                      } 
                      

                      echo' <i class="fa fa-chevron-right"></i> '.$title.' - '.$nome_console[0].' - Copie attuali : '.$quantita_totale.'
                      </button>
                    </h5>
                  </div>
                ';
                echo'
                  <div id="collapse'.$cod_game.'" class="collapse '; 
                  //if($i == 0){echo'show';} 
                  echo'" aria-labelledby="heading'.$cod_game.'" data-parent="#accordion">
                    <div class="card-body">
                      <form method="post">
                        <!--Righe Gioco-->
                        <div class="form-row">
                          <div class="form-group col-md-2">
                            <label for="modTitle">Titolo</label>
                            <input type="text" class="form-control" name="modTitle" value="'.$title.'" >
                            <input type="hidden" class="form-control" name="modCodGame" value="'.$cod_game.'">
                          </div>
                          <div class="form-group col-md-2">
                            <label for="modPrice">Prezzo</label>
                            <input type="text" class="form-control" name="modPrice" value="'.$price.'">
                          </div>
                          <div class="form-group col-md-2">
                            <label for="modPriceSale">Prezzo in Saldo</label>
                            <input type="text" class="form-control" name="modPriceSale" value="'.$price_on_sale.'">
                          </div>
                          <div class="form-group col-md-2">
                            <label for="modNovita">Novità</label>
                            <select id="modNovita" name="modNovita" class="form-control">
                              <option value="'.$flag_news.'" selected>'.$flag_news.'</option>
                              <option  value="Y">SI</option>
                              <option  value="N">NO</option>
                            </select>
                          </div>
                          <div class="form-group col-md-2">
                            <label for="modConsole">Console</label>
                            <select id="modConsole" name="modConsole" class="form-control">
                              <option value="'.$cod_console.'" selected>'.$nome_console[0].'</option>';
                              
                                $lista= mysql_query("select * from my_nopaynogame.DOM_CONSOLE");
                                while($elem = mysql_fetch_row($lista)){
                                $cod = $elem[1];
                                $cod_value = $elem[0];
                                echo"<option value='".$cod_value."'>".$cod."</option>";
                                }

                            echo'  
                            </select>
                          </div>
                          <div class="form-group col-md-2">
                            <label for="modImmagine">Immagine</label>
                            <input type="text" class="form-control" name="modImmagine" value="'.$image.'">
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group col-md-4">
                            <label for="modDesc">Descrizione</label>
                            <textarea type="text" class="form-control" name="modDesc" rows="3">'.$description.'</textarea>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="modReq">Requisiti Minimi</label>
                            <textarea type="text" class="form-control" name="modReq"  rows="3">'.$spec_req.'</textarea>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="modTrailer">Trailer</label>
                            <input type="text" class="form-control" name="modTrailer" value="'.$trailer.'">
                          </div>
                        </div>

                        <!--Riga Generi-->
                        <div class="form-row">
                          <div class="form-group col-md-12">';
                                                        
                              $lista= mysql_query("select * from my_nopaynogame.DOM_GENRE");
                              while($elem = mysql_fetch_row($lista)){
                                $nome_genere = $elem[1];
                                $codice_genere = $elem[0];
                                $lista_generi = mysql_query("select dg.* from my_nopaynogame.GAME_GENRE gg, my_nopaynogame.DOM_GENRE dg where dg.cod_genre = gg.cod_genre and gg.cod_game = '$cod_game'");
                                echo'<div class="form-check form-check-inline">
                                  <input class="form-check-input" type="checkbox" name="modGeneri[]" value="'.$codice_genere.'" '; 
                                  while($gen = mysql_fetch_row($lista_generi)){
                                    $cc = $gen[0];
                                    if($codice_genere == $cc){
                                      echo'checked';
                                      break;
                                    }  
                                  }
                                  echo'>
                                    <label class="form-check-label">'.$nome_genere.'</label>
                                  </div>';
                              } 
							  
                          echo'
                          </div>
                        </div>

                        <!--Riga Magazzini-->
                        <div class="form-row">';
                          
                          $lista= mysql_query("select * from my_nopaynogame.WAREHOUSE");
                          while($elem = mysql_fetch_row($lista)){
                            $cod_magazzino = $elem[0];
                            $indi_maga = $elem[1];
                            $quantita_per_magazzino = mysql_fetch_row(mysql_query("select quantity from my_nopaynogame.GAME_WAREHOUSE where cod_game = '$cod_game' and cod_warehouse = '$cod_magazzino'"));
                            echo'
                            <div class="form-group col-md-3">
                              <label for="magazzini[]">'.$cod_magazzino.' '.$indi_maga.'</label>
                              <input class="form-control" type="number" name="modQuantita[]" value="'.$quantita_per_magazzino[0].'">
                              <input class="form-control" type="hidden" name="modMagazzini[]" value="'.$cod_magazzino.'">
                            </div>
                            ';
                          }
                        echo'   
                        </div>
                        <button type="submit" name="updategame" class="btn btn-primary">Aggiorna Gioco</button>
                        <button type="submit" name="deletegame" class="btn btn-danger">Cancella Gioco</button>
                      </form>
                    </div>
                  </div>
                </div>
                ';
                $i = $i +1;
              }
            ?>
            </div>  
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
          <table class="table table-sm">
              <thead>
                <tr>
                  <th scope="col">Nr. Ordine</th>
                  <th scope="col">Username</th>
                  <th scope="col">Pagamento</th>
                  <th scope="col">Data</th>
                  <th scope="col">Nr. Artitoli</th>
                  <th scope="col">Totale</th>
                  <th scope="col">Dettagli</th>
                  <th scope="col">Elimina</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $lista= mysql_query("select *, SUM(go.game_price * go.quantity), SUM(go.quantity) from my_nopaynogame.ORDERS o, my_nopaynogame.GAME_ORDER go where o.id_order = go.id_order group by o.id_order");
                  while($elem = mysql_fetch_row($lista)){
                    $id_order = $elem[0];
                    $id_user = $elem[1];
                    $username= mysql_fetch_row(mysql_query("select username from my_nopaynogame.USERS where id_user = '$id_user'"));
                    $id_pagamento = $elem[2];
                    $pagamento = mysql_fetch_row(mysql_query("select desc_payment from my_nopaynogame.DOM_PAYMENT where cod_payment = '$id_pagamento'"));
                    $data = $elem[3];
                    $totale = $elem[9];
                    $quantita = $elem[10];
                    echo'
                    <tr><form method="post">
                    <th scope="row">'.$id_order.'</th>
                    <td>'.$username[0].'</td>
                    <td>'.$pagamento[0].'</td>
                    <td>'.$data.'</td>
                    <td>'.$quantita.'</td>
                    <td>'.$totale.'</td>
                    <td>
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal'.$id_order.'">
                      Vedi Dettagli
                    </button>
                    <!-- The Modal -->
                    <div class="modal fade" id="myModal'.$id_order.'">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Dettagli Ordine Nr. '.$id_order.'</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>

                          <!-- Modal body -->
                          <div class="modal-body">
                            <div class="row">
                              <div class="col"><p><b>Username:</b> '.$username[0].'</p></div>
                              <div class="col"><p><b>Pagamento:</b> '.$pagamento[0].'</p></div>
                              <div class="col"><p><b>Data:</b> '.$data.'</p></div>
                            </div>
                            <div class="row">
                              <div class="col">
                              <table class="table">
                                  <thead>
                                    <tr>
                                      <th scope="col">Nome Gioco</th>
                                      <th scope="col">Console</th>
                                      <th scope="col">Quantità</th>
                                      <th scope="col">Prezzo</th>
                                    </tr>
                                  </thead>
                                  <tbody>';
                              $lista_giochi_ordine= mysql_query("select * from my_nopaynogame.GAME_ORDER where id_order ='$id_order'");
                              while($game = mysql_fetch_row($lista_giochi_ordine)){
                                $cod_game = $game[2];
                                $nome_game = mysql_fetch_row(mysql_query("select title from my_nopaynogame.GAMES where cod_game = '$cod_game'"));
                                $console = mysql_fetch_row(mysql_query("select c.desc_console from my_nopaynogame.GAMES g, my_nopaynogame.DOM_CONSOLE c where g.cod_game = '$cod_game' and g.cod_console = c.cod_console"));
                                $squantity = $game[3];
                                $gameprice = $game[4];
                                echo'
                                    <tr>
                                      <th scope="row">'.$nome_game[0].'</th>
                                      <td>'.$console[0].'</td>
                                      <td>'.$squantity.'</td>
                                      <td>'.$gameprice.'</td>
                                    </tr>
                                    ';
                                  }
                                  
                                  echo'
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>

                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>

                        </div>
                      </div>
                    </div>
                    </td>
                    <td>
                      <input class="form-control" type="hidden" name="del_ordine" value="'.$id_order.'">
                      <input class="form-control" type="hidden" name="id_user_order" value="'.$id_user.'">
                      <button type="submit" name="deleteordine" class="btn btn-danger">Elimina</button>
                    </td>
                    </form>
                    </tr>
                    ';
                  }
                ?>
              </tbody>
            </table>
          </div>
          <!-- Fine gestione ordini -->

          <!-- Inizio gestione profilo -->
          <div class="tab-pane fade" id="profili" role="tabpanel" aria-labelledby="profili-tab">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th scope="col">Username</th>
                  <th scope="col">Ruolo</th>
                  <th scope="col">Punti</th>
                  <th scope="col">Attivo?</th>
                  <th scope="col">Cancellato?</th>
                  <th scope="col">Salva</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $lista= mysql_query("select * from my_nopaynogame.USERS");
                  while($elem = mysql_fetch_row($lista)){
                    $username = $elem[5];
                    $role = $elem[8];
                    $name_role= mysql_fetch_row(mysql_query("select * from my_nopaynogame.DOM_ROLE where cod_role = '$role'"));
                    $points = $elem[10];
                    $flag_deleted = $elem[11];
                    $flag_active = $elem[12];
                    echo'
                    <tr';
                    if($flag_deleted == 'Y'){
                      echo' class="table-danger"';
                    }elseif($flag_active == 'N'){
                      echo' class="table-warning"';
                    }elseif($role == 'RL4'){
                      echo' class="table-primary"';
                    }elseif($role == 'RL3'){
                      echo' class="table-info"';
                    }elseif($role == 'RL2'){
                      echo' class="table-secondary"';
                    }
                    echo'><form method="post">
                    <th scope="row">'.$username.'
                      <input type="hidden" name="user" value="'.$elem[0].'">
                    </th>
                    <td>
                      <select name="role" class="form-control">
                        <option value="'.$name_role[0].'" selected>'.$name_role[1].'</option>';
                        $lista_role= mysql_query("select * from my_nopaynogame.DOM_ROLE");
                        while($ruolo=mysql_fetch_row($lista_role)){
                        $cod = $ruolo[1];
                        $cod_value = $ruolo[0];
                        echo"<option  value='".$cod_value."'>".$cod."</option>";
                        }
                      echo'
                      </select>
                    </td>
                    <td>'.$points.'</td>
                    <td>
                      <select name="active" class="form-control">
                        <option value="'.$flag_active.'" selected>'.$flag_active.'</option>';
                        if($flag_active == 'Y'){
                          $choice = 'N';
                        }else{
                          $choice = 'Y';
                        }
                        echo"<option  value='".$choice."'>".$choice."</option>";
                      echo'
                      </select>
                    </td>
                    <td>
                      <select name="deleted" class="form-control">
                        <option value="'.$flag_deleted.'" selected>'.$flag_deleted.'</option>';
                        if($flag_deleted == 'Y'){
                          $choice = 'N';
                        }else{
                          $choice = 'Y';
                        }
                        echo"<option  value='".$choice."'>".$choice."</option>";
                      echo'
                      </select>
                    </td>
                    <td>
                      <button type="submit" name="save_user" class="btn btn-success">Salva</button>
                    </td>
                    </form>
                    </tr>
                    ';
                  }
                ?>
              </tbody>
            </table>
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