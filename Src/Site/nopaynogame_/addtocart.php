<?php
	
	session_start();
	if(isset($_SESSION['role']) && $_SESSION['role']=="RL1"){
		if(isset($_SESSION['carrello'])){
			array_push($_SESSION['carrello'],$_POST['cod_gioco']);
		}else{
			$_SESSION['carrello'] = array();
			array_push($_SESSION['carrello'],$_POST['cod_gioco']);
		}
		header('Location: index.php');
	}else{
		header('Location: sign.php?cp=sign&msg=cart');
	}

?>