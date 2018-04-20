 <?php
 require("connection.php");
$idconferma=$_GET["utente"];
$query="UPDATE USER SET CONFIRM='Y' WHERE ID_USER='$idconferma'";
$ris = ($conn->query($query));

header('location: sign.php');
 
 ?>