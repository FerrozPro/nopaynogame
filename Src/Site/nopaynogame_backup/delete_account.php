<?php
	session_start();
	require 'connection.php';
	$utente=$_GET['eliminaccount'];
	$query ="UPDATE USERS SET FLAG_DELETED='Y' WHERE ID_USER=$utente";
    $ris = ($conn->query($query));
	?>
	<h2>Il tuo account è stato eliminato! Qualora volessi riattivare l'account basta reinserire i tuoi dati nel form accedi.</h2>
	<?php
	header('Location: disconnection.php');
?>