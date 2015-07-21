<?php
class ContactController extends baseView {

	public function contact() {
        // Test des champs du formulaire à l'envoi
            $arrayErrors = array();
            $nom = '';
            $prenom = '';
            $email = '';
            $messageForm = '';
            // On vérifie qu'aucun champ du formulaire n'a été ajouté par l'utilisateur
            if(isset($_POST['g-recaptcha-response'])){
                $captcha=$_POST['g-recaptcha-response'];
            }

            $liste_champs = array("nom", "prenom", "email", "messageForm", "submit");
            if (count(array_diff($liste_champs, array_keys($_POST))) === 0) {
                $error = 0;

                // On affecte chaque champ du formulaire à une variable
                $nom = strtoupper(trim($_POST['nom']));
                $prenom = trim($_POST['prenom']);
                $email = trim($_POST['email']);
                $messageForm = trim($_POST['messageForm']);

                // Champ nom
                if (strlen($nom) == 0) {
                    $arrayErrors[] = "Le nom n'est pas valide";
                    $error ++;
                }
                if (strlen($nom) > 50) {
                    $arrayErrors[] = "Le nom possède un nombre de caractères trop grand";
                    $error ++;
                }

                // Champ Prénom
                if (strlen($prenom) == 0) {
                    $arrayErrors[] = "Le prénom n'est pas valide";
                    $error ++;
                }
                if (strlen($prenom) > 50) {
                    $arrayErrors[] = "Le prénom possède un nombre de caractères trop grand";
                    $error ++;
                }

                // Champ email
                if (strlen($email) == 0) {
                    $arrayErrors[] = "L'email n'est pas valide";
                    $error ++;
                }
                if (strlen($email) > 50) {
                    $arrayErrors[] = "L'email possède un nombre de caractères trop grand";
                    $error ++;
                }
                // Champ message
                if (strlen($messageForm) == 0) {
                    $arrayErrors[] = "Le message n'est pas valide";
                    $error ++;
                }
                if (strlen($messageForm) > 1000) {
                    $arrayErrors[] = "Le message possède un nombre de caractères trop grand (supérieur a 1000)";
                    $error ++;
                }
                //Captcha
                $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdmCgoTAAAAAC73f2yVCPZ_B2mulpJFJa5OL2jA&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
                if($response == false)
                {
                    $arrayErrors[] = "Le captcha n'est pas valide";
                    $error ++;
                }
                if($captcha == '')
                {
                    $arrayErrors[] = "Le captcha n'est pas valide";
                    $error ++;
                }

                // Si il y a une erreur on retourne le message d'erreur sinon on envoie le mail
                if ($error > 0) {
                    array_unshift($arrayErrors, "Formulaire invalide");
                } else {
                    $subject = "E-mail Contact de " . $nom . " " . $prenom;
                    $headers = 'From:'. $email . "\r\n";
                    $headers .= 'Cc:'. $email . "\r\n";

                    mail("agendaserie@gmail.com", $subject, $messageForm, $headers) or die ("Une erreur est survenue lors de l'envoie du mail");

                    $message = $this->validMessage("Merci de nous avoir contacté !");
                    $this->assign("message", $message);
                }
            } else {
                $arrayErrors[] = "Erreur lors de l'envoie de l'email";
            }
            $this->assign("arrayErrors", $arrayErrors);
        $this->assign("nom", $nom);
        $this->assign("prenom", $prenom);
        $this->assign("email", $email);
        $this->assign("messageForm", $messageForm);
        $this->render("contact");	
    }

}
