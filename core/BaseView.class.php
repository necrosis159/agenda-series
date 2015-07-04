<?php

class baseView {

    private $data = array();
    private $layout = FALSE;

    public function assign($variable, $value) {
        $this->data[$variable] = $value;
        return $this;
    }

    public function render($view, $layout = "layout") {
        extract($this->data);

        try {
            //Vue
            $view = APPLICATION_PATH . '/views/' . $view . '.php';

            if (!file_exists($view)) {
//                include($view);
                throw new Exception('View : ' . $view . ' not found!');
            }
            //Layout
            $file_layout = APPLICATION_PATH . '/views/' . $layout . '.php';

            if (file_exists($file_layout)) {
                include($file_layout);
            } else {
                throw new Exception('Layout : ' . $file_layout . ' not found!');
            }
        } catch (Exception $e) {
            echo $e->errorMessage();
        }
    }

    // Fonction retourne un message d'erreur
    public function errorMessage($message) {
        $result = '<p class="wrong"><img class="message_icons" src="/images/error.png" title="Echec" alt="Echec" align="middle"> &nbsp; ' . $message . '</p>';
        return $result;
    }

    // Fonction retourne un message de validation
    function validMessage($message = '') {
        $result = '<p class="right"><img class="message_icons" src="/images/valid.png" title="Réussi" alt="Réussi" align="middle"> &nbsp; ' . $message . '</p>';
        return $result;
    }
    
    //Fonction pour rediriger vers une autre action d'un controller
    public function redirect($controller, $action, $params = array()) {
        $url = "/" . $controller . "/" . $action;
        if (!empty($params)) {
            $url .= "/";
            $url .= implode("-", $params);
        }
        header("Location: " . $url);
    }

    // Fonction pour convertir le format d'une date en français
    function dateConvert($date_en) {

        $split = explode("-", $date_en);
        $year = $split[0];
        $month = $split[1];
        $day = $split[2];
        $date_fr = "$day" . "/" . "$month" . "/" . "$year";

        return $date_fr;
    }

}
