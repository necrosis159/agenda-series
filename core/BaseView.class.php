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
    public function error_message($message) {
        $result = '<p class="wrong"><img class="message_icons" src="/images/error.png" title="Echec" alt="Echec" align="middle"> &nbsp; ' . $message . '</p>';
        return $result;
    }

    // Fonction retourne un message de validation
    function valid_message($message = '') {
        $result = '<p class="right"><img class="message_icons" src="/images/valid.png" title="Réussi" alt="Réussi" align="middle"> &nbsp; ' . $message . '</p>';
        return $result;
    }

    public function redirect($controller, $action, $params = array()) {
        $url = "/" . $controller . "/" . $action;
        if (!empty($params)) {
            $url .= "/";
            $url .= implode("-", $params);
        }
        header("Location: " . $url);
    }

}
