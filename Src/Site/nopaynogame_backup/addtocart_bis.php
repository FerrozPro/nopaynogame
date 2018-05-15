<?php
	session_start();
	require 'connection.php';
	if(isset($_SESSION['role']) && $_SESSION['role']=="RL1"){
		$gioco=$_POST['cod_gioco'];
		echo $gioco;
		$query="SELECT COUNT(*) FROM GAMES g, GAME_WAREHOUSE gw WHERE g.COD_GAME=gw.COD_GAME AND gw.COD_GAME='$gioco'";
		$ris = ($conn->query($query));
		//conto quante volte il cod gioco appare nella'array se supera la quantità disponbiile allora rimando un alert
		foreach($ris as $riga) {
			$max=count($_SESSION['carrello']);
			$i=0;
			while($max!=0){
				if($_SESSION['carrello'][$i] == $_POST['cod_gioco'])
					$conta++;
				$max--;
			}
			if($conta > $quantita)
				echo"NO";
		}
		if(isset($_SESSION['carrello'])){
			array_push($_SESSION['carrello'],$_POST['cod_gioco']);
		}else{
			$_SESSION['carrello'] = array();
			array_push($_SESSION['carrello'],$_POST['cod_gioco']);
		}
		//header('Location: index.php');
	//}//else{
		//header('Location: sign.php?cp=sign&msg=cart');
	}

?>