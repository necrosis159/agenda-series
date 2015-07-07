<?php
class NewsletterController extends baseView {

	// public function send() {

	// 	$user = new User();
	// 	$resultat=$user->select()
 //                        ->from(array("u" =>"user", "s" => "serie"), array("user_id", "user_surname", "user_name", "user_email", "serie_name"))
 //            			// ->where('', "=", 'admin')

	// 		 ->execute();
	// 	$this->assign('user',$resultat)


	// 		 ->render("userNewsletter");
	// }

	public function newsletter() {
			// ' . $result["user_name"] . "" ."<br>". "Voici la liste de vos épisodes : " . "<li>" . $result["serie_name"] . "</li>";

            $model_user = new User();
            $result = $model_user->newsletter();
            $cpt = 0;
            //On récupère tout les users qui sont inscrit a la newsletter avec la fonction newsletter
            foreach ($result as $value) {
            	print("---------------DEBUT---------------<br>");
            	$message = "
            	<!DOCTYPE html>
				<html>
				    <head>
				        <meta charset='UTF-8'>
				        <title>Agenda-Serie</title>
				        <meta name='description' content='Ma description'>
				        <link type='text/css' rel='stylesheet' href='/css/styles.css'>
				        <link type='text/css' rel='stylesheet' href='/css/menu.css'>
				        <link type='text/css' rel='stylesheet' href='/css/series.css'>
				        <link type='text/css' rel='stylesheet' href='/css/calendar.css'>
				    </head>
				    <body>
				        <div class='header_bg'>
				            <div class='wrap'>
				                <div class='header'>
				                    <div class='logo'>
				                        <a href='/'>
				                            <img src='/images/home.jpg' alt=''>
				                            <h1> A S </h1>
				                            <div class='clear'> </div>
				                        </a>
				                    </div>
				                    <div class='text'>
				                        <p>Toute l'actualité des séries TV</p>
				                    </div>
				                    <div class='clear'> </div>
				                </div>
				            </div>
				        </div>
				<br>Bonjour, "
				;
            	// $message = file_get_contents("views/layoutNewsletter.php");
            	$user_id = $result[$cpt]["user_id"];
            	// var_dump($value);
            	// var_dump($user_id);
            	$email = $result[$cpt]["user_email"];
            	$message .= $result[$cpt]["user_surname"]."<br>"."Votre semaine avec Agenda-serie<br>";
            	// var_dump($email); 
            	print("Message apres surname: "); var_dump($message);
            	//On récupère toutes les séries que chaque user suit, on récupère l'id de la série
            	$result2 = $model_user->serieUser($user_id);
            	print("Liste des series de l'utilisateur :");
            	var_dump($result2);

            	$cpt2 = 0;

            	foreach ($result2 as $value2) {
            		var_dump($cpt2);
            	if (!empty($result2)) {
            		// if (count($result2) > 1) {
            			$serie_id = $result2[$cpt2]["serie_id"];
            			var_dump($message);
		            // } else {
            		// 	$serie_id = $result2["serie_id"];
		            // }
		        }
		        else {
		        	// $message .= "Vous n'avez pas de nouvel épisode cette semaine"; 
		        }

            		// var_dump($serie_id);
            		// var_dump($cpt2);

            		//Les dates de sorties des épisodes !
            		$model_episode = new Episode();
            		$result3 = $model_episode->airdate($serie_id);
            		var_dump($result3);
            		print("Var_dump Episode");
            		var_dump($message);
            		$cpt3 = 0;

	            		foreach ($result3 as $value3) {
	            		if (!empty($result3)) {
            				$message .= "<li>".$result2[$cpt2]["serie_name"]."</li>";

	            			$message .= $result3[$cpt3]["episode_air_date"]." Episode ".$result3[$cpt3]["episode_number"]." : ".$result3[$cpt3]["episode_name"]."<br>";
	            		}
	            		else{
	            			$message .= "Aucun nouvel episode";
	            		}
	            		print("Message apres un episode : ");
	            		var_dump($message);
	            		$cpt3 = $cpt3 + 1;
	            	}
            		$cpt2 = $cpt2 + 1;

            	}
        		//Envoie du mail !
					$subject = "Votre semaine sur Agenda-serie.fr";
					$message .= "<br><br><hr>En ce moment sur Agenda-serie.fr !";
					//Fermeture des balises body, html et autres
					$message .= "</body></html>";
				
					$headers = 'From:'. 'agendaserie@gmail.com' . "\n"; // Sender's Email
					$headers .= 'Cc:'. 'agendaserie@gmail.com' . "\n"; // Carbon copy to Sender
					$headers .= 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

					// Message lines should not exceed 70 characters (PHP rule), so wrap it
					// $message = wordwrap($message, 70);
					// Send Mail By PHP Mail Function
					// var_dump($subject);
					// var_dump($headers);
					// var_dump($message);
					try {
						mail($email, $subject, $message, $headers) or die ("Une erreur est survenue lors de l'envoie du mail");
					    // $this->assign("messageNewsletter", $message);
			            // $this->render("userNewsletter");

					} catch (Exception $e) {
						print($e);
					}
					// var_dump($message);
            	$cpt = $cpt + 1;
            }

            // $this->assign("test", $result);
            // print($result[0]["user_id"]);
            // var_dump($result2);

            // foreach ($result as $value) {
           	// $this->assign("userid", $result["user_id"]);
            // $this->assign("username", $result["user_name"]);
            // $this->assign("usermail", $result["user_email"]);
            // $this->assign("seriename", $result["serie_name"]);
			// }


		// $user = new User();
		// $resultat=$user->select()
  //               ->from(array("u" =>"user"), array("user_id", "user_surname", "user_name", "user_email"))
  //   			->where('user_surname', "=", 'Administrateur')

		// ->execute();
		// $this->assign('user',$resultat);

		// $user2 = new User();
		// $resultat2=$user2->select()
  //               ->from(array("u" =>"user"), array("user_id", "user_surname", "user_name", "user_email"))
  //   			// ->where('user_surname', "=", 'Administrateur')
		// ->execute();
		// $this->assign('user2',$resultat2)


		// $email=filter_var($email, FILTER_SANITIZE_EMAIL);
		// $email=filter_var($email, FILTER_VALIDATE_EMAIL);




	}
}