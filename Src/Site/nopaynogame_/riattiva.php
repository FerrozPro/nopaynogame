<!doctype html>
<html lang="en">

<?php
session_start();
require 'connection.php';
$utente=$_SESSION['user'];
$query ="SELECT * FROM USERS WHERE USERNAME='$utente' || EMAIL='$utente'";
$ris = ($conn->query($query));

  
?>
    <?php	include 'header.php'; ?>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 ">
        <br>
		<form>
		  <div class="form-group">
			<label for="exampleInputEmail1">Email o Username</label>
			<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
			<small id="emailHelp" class="form-text text-muted">Inserisci la vecchia email con cui ti eri iscritto oppure il vecchio username</small>
		  </div>
		  <div class="form-group">
			<label for="exampleInputPassword1">Password</label>
			<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
		  </div>
		   <button type="submit" class="btn btn-primary">Submit</button>
		  </form>
		</div>
	   </div>
	</div>
			
			
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script type="text/javascript">
       int reply_click(clicked_id)
		{
			return clicked_id;
		}
	</script>
  
  </body>

</html>



