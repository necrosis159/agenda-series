<?php
if(isset($_POST["submit"]))
{
	if($_POST["nom"]==""||$_POST["prenom"]==""||$_POST["email"]==""||$_POST["message"]=="")
		{
			echo "Veuillez remplir les champs.";
		}
	else
	{
		$email=$_POST['email'];
		$email=filter_var($email, FILTER_SANITIZE_EMAIL);
		$email=filter_var($email, FILTER_VALIDATE_EMAIL);

		if (!$email)
		{
			echo "L'adresse e-mail renseignée est invalide";
		}
		else
		{
			$subject = "E-mail via formulaire Contact";
			$message = $_POST['message'];
			$headers = 'From:'. $email . "\r\n"; // Sender's Email
			$headers .= 'Cc:'. $email . "\r\n"; // Carbon copy to Sender
			// Message lines should not exceed 70 characters (PHP rule), so wrap it
			$message = wordwrap($message, 70);
			// Send Mail By PHP Mail Function
			mail("agendaserie@gmail.com", $subject, $message, $headers) or die ("Une erreur est survenue lors de l'envoie du mail");
			echo "Merci de nous avoir contacté !";
		}
	}
}
?>