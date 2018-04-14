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
    <div class="container">
        <h1>Amministrazione</h1>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="magazzino-tab" data-toggle="tab" href="#magazzino" role="tab" aria-controls="magazzino" aria-selected="true">Magazzino</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="ordini-tab" data-toggle="tab" href="#ordini" role="tab" aria-controls="ordini" aria-selected="false">Gestione Ordini</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profili-tab" data-toggle="tab" href="#profili" role="tab" aria-controls="profili" aria-selected="false">Gestione Profili</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">

          <div class="tab-pane fade show active" id="magazzino" role="tabpanel" aria-labelledby="magazzino-tab">
          <table class="table table-sm">
            <thead>
              <tr>
                <th scope="col">Codice</th>
                <th scope="col">Titolo</th>
                <th scope="col">Prezzo</th>
                <th scope="col">Prezzo Saldo</th>
                <th scope="col">Console</th>
                <th scope="col">Quantità</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr>
            </tbody>
          </table>
          </div>

          <div class="tab-pane fade" id="ordini" role="tabpanel" aria-labelledby="ordini-tab">
          </div>

          <div class="tab-pane fade" id="profili" role="tabpanel" aria-labelledby="profili-tab">
          </div>
        </div>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include 'script.php'; ?>
  </body>

</html>