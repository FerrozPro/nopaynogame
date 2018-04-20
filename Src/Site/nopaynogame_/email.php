<?php

		require 'PHPMailer/PHPMailerAutoload.php';
		$user=$_POST['USERNAME'];
		$iduser=$_POST['ID_USER'];
		$password =$_POST['PASSWORD'];
    	$email=$_POST['EMAIL'];	//mail destinatario	
		
		echo $email;
		
		
		$subject = "Mail registrazione NoPayNoGame";//titolo
        $message = "<p>Ciao! Grazie per esserti registrato.<br> Di seguito sono riportati username e password
						che ti serviranno per accedere al sito:<br>
						<b> Username: </b> $user <br>
						<b> Password: </b> $password <br><br>
						Per attivare il tuo account, premi <a href='nopaynogame.altervista.org/conferma.php?utente=$iduser'>qui</a><br>
					  Se vuoi eliminare l'account, acedi al tuo account, nella sezione impostazioni clicca su elimina account<br>
					  </p>";	  	//corpo del messaggio
	    $mail = new PHPMailer;
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);
		//$mail->SMTPDebug = 3;                               	// Enable verbose debug output
		$mail->isSMTP();                                      	// Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  						// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               	// Enable SMTP authentication
		$mail->Username = 'sportellocicitis@gmail.com';         //GMAIL mittente
		$mail->Password = 'sportellocic@itis';  	            //password della Gmail
		$mail->SMTPSecure = 'tls';                            	// Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    	// TCP port to connect to
		$mail->From = 'accountcic@gmail.com';					//mittente visualizzato
		$mail->FromName = 'Sistema di Account';			//nome mittente visualizzato
		//$mail->ReplyTo = 'accountcic@gmail.com';
		$mail->isHTML(true);                                  	// Set email format to HTML
		$mail->WordWrap = 75;

		$mail->addAddress($email);     // Add a recipient
		$mail->Subject = $subject;
		$mail->Body    = $message;

		if(!$mail->send()) {
                echo "<script>alert('La mail non è stata inviata. Errore: ". $mail->ErrorInfo."');</script>";
            } 
        else {
                echo "<script>alert('Mail inviata con successo.');</script>";
            }
			//header("Location: sign.php");

?>
