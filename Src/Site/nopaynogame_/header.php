  <header>
  <?php
    session_start();
    include connection.php;
	?>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="">NoPayNoGame</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="lista_giochi/lista_giochi.php">Catalogo Completo</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Genere
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    
          <?php 
            $lista_generi = mysql_query("select * from my_nopaynogame.DOM_GENRE");
            
            while($genere=mysql_fetch_row($lista_generi)){
              $id_genere = $genere[0];
              $nome_genere = $genere[1];
              echo"<a class='dropdown-item' value=".$id_genere." href='lista_giochi/lista_giochi.php'>".$nome_genere."</a>";
            }
          ?>

        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Piattaforma
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          
          <?php 
              $lista_console = mysql_query("select * from my_nopaynogame.DOM_CONSOLE");
              
              while($console=mysql_fetch_row($lista_console)){
                $id_console = $console[0];
                $nome_console = $console[1];
                echo"<a class='dropdown-item' value=".$id_console." href='lista_giochi/lista_giochi.php'>".$nome_console."</a>";
              }
            ?>

        </div>
      </li>
      
      <?php
        session_start();
        include connection.php;
        if(isset($_SESSION['user'])=="")
          {
            echo"<li class='nav-item'>";
            echo"<a class='nav-link' href='index.php'>Amministra</a>";
            echo"</li>";
          }
      ?>

      <?php
        session_start();
        include connection.php;
        if(isset($_SESSION['user'])=="")
          {
            echo"<li class='nav-item'>";
            echo"<a class='nav-link' href='index.php'>Log In</a>";
            echo"</li>";
          }
      ?>
          
      <?php
        session_start();
        include connection.php;
        if(isset($_SESSION['user'])=="")
          {

          echo"<li class='nav-item dropdown'>";
          echo"<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
          //echo.$nome." ".$cognome.;
          echo"NOME UTENTE";
          echo"</a>";
          echo"<div class='dropdown-menu' aria-labelledby='navbarDropdown'>";
          echo"<a class='dropdown-item' href=''>Log Out</a>";
          echo"</div>";
          echo"</li>";
          
      }
      ?>
      
    </ul>

    


  </div>
</nav>
</header>
  