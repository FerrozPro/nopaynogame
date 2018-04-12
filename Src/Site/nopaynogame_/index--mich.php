<html>
<head>
	<script src="http://code.jquery.com/jquery-1.6.4.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/pdfmake-0.1.27/dt-1.10.15/af-2.2.0/b-1.3.1/b-colvis-1.3.1/b-html5-1.3.1/b-print-1.3.1/fc-3.2.2/fh-3.1.2/r-2.1.1/rr-1.2.0/sc-1.4.2/se-1.2.2/datatables.min.js"></script>
	<script type="text/javascript" src="mdb.js"></script>
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
	<link href="style.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<!------ Include the above in your HEAD tag ---------->
<body>
	<?php
	
	include connection.php;
	
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h1>Rubrica</h1>
			</div>
		</div>
		<div class="row">
			<div class="row-fluid">
			  <select class="selectpicker" data-show-subtext="true" data-live-search="true">
				<option data-subtext="" value=""></option>
				<?php 
					$lista_persone = mysql_query("select * from my_nopaynogame.USERS");
					
					while($persona=mysql_fetch_row($lista_persone)){
						$id_persona = $persona[0];
						$nome = $persona[1];
						$cognome = $persona[2];
						$dipartimento = $persona[4];
						//$azienda = mysql_fetch_row(mysql_query("select NOME from my_laverageorgia.AZIENDA WHERE ID_AZIENDA = ".$persona[6]));
						echo "<option data-subtext='prova' value='".$id_persona."'>".$nome." ".$cognome."</option>";
					}
				?>
			  </select>
			</div>
			  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
			  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
			  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

		</div>
	</div>
	<div class="container search-result">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Sheena Shrestha</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-circle img-responsive"> </div>
                
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Department:</td>
                        <td>Programming</td>
                      </tr>
                      <tr>
                        <td>Hire date:</td>
                        <td>06/23/2013</td>
                      </tr>
                      <tr>
                        <td>Date of Birth</td>
                        <td>01/24/1988</td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Gender</td>
                        <td>Female</td>
                      </tr>
                        <tr>
                        <td>Home Address</td>
                        <td>Kathmandu,Nepal</td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><a href="mailto:info@support.com">info@support.com</a></td>
                      </tr>
                        <td>Phone Number</td>
                        <td>123-4567-890(Landline)<br><br>555-4567-890(Mobile)
                        </td>
                           
                      </tr>
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>            
          </div>
        </div>
      </div>
    </div>
<body>
</html>