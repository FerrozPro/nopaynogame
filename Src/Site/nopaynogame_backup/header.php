<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<title>NoPayNoGame</title>
</head>
  
  <?php include 'connection.php';
	session_start();?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href=''>NoPayNoGame</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php if(!isset($_GET['cp']) || $_GET['cp']=='home'){echo"active";} ?>">
        <a class="nav-link" href="index.php?cp=home">Home</a>
      </li>
      <li class="nav-item <?php if($_GET['cp']=='cat'){echo"active";} ?>">
        <a class="nav-link" href="gamelist.php?cp=cat&tipo_ricerca=catalogo">Catalogo Completo</a>
      </li>
      <li class="nav-item <?php if($_GET['cp']=='gen'){echo"active";} ?> dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Genere
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		
          <?php 
          $lista_generi = ($conn->query("SELECT * from my_nopaynogame.DOM_GENRE"));
          foreach($lista_generi as $genere) {
              $id_genere = $genere[0];
              $nome_genere = $genere[1];
              echo"<a class='dropdown-item' value=".$id_genere." href='gamelist.php?cp=gen&tipo_ricerca=genere&id=".$id_genere."'>".$nome_genere."</a>";
            }
          ?>

        </div>
      </li>
      <li class="nav-item <?php if($_GET['cp']=='con'){echo"active";} ?> dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Piattaforma
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          
          <?php
          $lista_console = ($conn->query("SELECT * from my_nopaynogame.DOM_CONSOLE"));
          foreach($lista_console as $console) { 
              $id_console = $console[0];
              $nome_console = $console[1];
              echo"<a class='dropdown-item' value=".$id_console." href='gamelist.php?cp=con&tipo_ricerca=console&id=".$id_console."'>".$nome_console."</a>";
            }
        ?>

        </div>
      </li>
	  </ul>
      <ul class="nav navbar-nav navbar-right">
      <?php
        if($_SESSION['role']=="RL4" || $_SESSION['role']=="RL3" || $_SESSION['role']=="RL2")
          {
            echo"<li class='nav-item ";
			if($_GET['cp']=='ammi'){echo'active';}
			echo"'>";
            echo"<a class='nav-link' href='administrate.php?cp=ammi'>Amministra</a>";
            echo"</li>";
          }
      ?>

      <?php
        if(!isset($_SESSION['user']))
          {
            echo"<li class='nav-item ";
			if($_GET['cp']=='sign'){echo'active';}
			echo"'>";
            echo"<a class='nav-link' href='sign.php?cp=sign'>Accedi</a>";
            echo"</li>";
          }
      ?>

            <?php
        if(isset($_SESSION['user']))
          {
			if(isset($_SESSION['carrello'])){
				$num_item = count($_SESSION['carrello']);
			}
			echo'<a href="shoppingcart.php?cp=carrello" class="btn btn-warning" role="button">
			  Carrello <span class="badge badge-light">'.$num_item.'</span>
			</a>';
          }
      ?>
          
      <?php
        if(isset($_SESSION['user']))
          {
		echo"<li class='nav-item dropdown";
			if($_GET['cp']=='user'){echo'active';}
			echo"'>";
          echo"<li class='nav-item dropdown'>";
          echo"<a class='nav-link dropdown-toggle' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
          //echo.$nome." ".$cognome.;
          echo $_SESSION['name']." ".$_SESSION['surname'];
          echo"</a>";
          echo"<div class='dropdown-menu' aria-labelledby='navbarDropdown'>";
		  echo"<a class='dropdown-item' href='account.php?cp=user'>Profilo</a>";
          echo"<a class='dropdown-item' href='disconnection.php'>Esci</a>";
		  echo"</div>";
          echo"</li>";
          
      }
      ?>
	</div>
    </ul>
  </div>
</nav>
  