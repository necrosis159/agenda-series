<?php
class NewsletterController extends baseView {

	public function newsletter() {

          if ((!isset($_SESSION['user_status'])) || ($_SESSION['user_status'] != 1)) {
              $this->redirect("index", "");
              break;
          }

            $model_user = new User();
            $result = $model_user->getNewsletter();
            $cpt = 0;

            //On récupère tout les users qui sont inscrit a la newsletter avec la fonction newsletter

            foreach ($result as $value) {
            	$message = "
				<html>
				    <head>
				        <meta charset='UTF-8'>
				        <style>
						</style>
				    </head>
				    <body>
				    <span style='font-family: Lato, sans-serif; font-size: 14px;'> 
				    <a href='http://agenda-serie.fr/'><img src='http://i.imgur.com/xEDII4v.png' alt='Loading image' /></a><br>
                	    <h1>Toute l'actualité des séries TV !</h1><br>
					<br>Bonjour, "
				;
            	$user_id = $result[$cpt]["user_id"];
            	$email = $result[$cpt]["user_email"];
            	$message .= $result[$cpt]["user_surname"]."<br>"."Votre semaine avec Agenda-serie !<br><hr>";

            	//On récupère toutes les séries que chaque user suit, on récupère l'id de la série
            	$result2 = $model_user->serieUser($user_id);

            	$cpt2 = 0;

            	foreach ($result2 as $value2) {
            	if (!empty($result2)) {
            			$serie_id = $result2[$cpt2]["serie_id"];
		        }

            		//Les dates de sorties des épisodes !
            		$model_episode = new Episode();
            		$result3 = $model_episode->airdate($serie_id);
            		$cpt3 = 0;
            		$model_base = new Baseview();

	            		foreach ($result3 as $value3) {
	            		if (!empty($result3)) {
							$result4 = $model_base->dateConvert($result3[$cpt3]['episode_air_date']);
	            			$message .= '</a><li><b>'. $result4 . '</b><br><a href=http://agenda-serie.fr/serie/'. $result2[$cpt2]['serie_id'] . '>' . $result2[$cpt2]['serie_name'] . "</a> : <a href=http://agenda-serie.fr/serie/Saison" . $result3[$cpt3]['season_number'] . "/Episode" . $result3[$cpt3]['episode_number'] . " </a>  S" . $result3[$cpt3]['season_number'] . "E" . $result3[$cpt3]['episode_number'];
	            			if(!empty($result3[$cpt3]['episode_name'])) {
	            				$message .= ' - ' . $result3[$cpt3]['episode_name'];
	            			}
	            		}
	            		$cpt3 = $cpt3 + 1;
	            	}
            		$cpt2 = $cpt2 + 1;

            	}
        		//Envoie du mail !
					$subject = "Votre semaine sur Agenda-serie.fr";
					// $message .= "<br><br><hr>En ce moment sur Agenda-serie.fr !";
					//Fermeture des balises body, html et autres
					$message .= "</span></body></html>";
					
					$headers = 'From:'. 'agendaserie@gmail.com' . "\n";
					$headers .= 'Cc:'. 'agendaserie@gmail.com' . "\n";
					$headers .= 'MIME-Version: 1.0' . "\n";
					$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

					try {
						mail($email, $subject, $message, $headers) or die ("Une erreur est survenue lors de l'envoie du mail");
					    $this->assign("messageNewsletter", $message);
			            $this->render("userNewsletter");

					} catch (Exception $e) {
						print($e);
					}
            	$cpt = $cpt + 1;
            }
	}
}