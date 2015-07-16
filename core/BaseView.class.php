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

    // Fonction de pagination
    function paginate_function($serie_per_page, $page, $total_serie, $total_pages) {
        $pagination = '';
        if ($total_pages > 0 && $total_pages != 1 && $page <= $total_pages) { //verify total pages and current page number
            $pagination .= '<ul class="pagination">';

            $right_links = $page + 3;
            $previous = $page - 1;
            $next = $page + 1;
            $first_link = true;

            if ($page > 1) {
                $previous_link = ($previous == 0) ? 1 : $previous;
                $pagination .= '<li class="first"><a href="/account/series/page/1" data-page="1" title="First">&laquo;</a></li>'; //first link
                $pagination .= '<li><a href="/account/series/page/'.$previous.'" data-page="' . $previous_link . '" title="Previous">&lt;</a></li>';
                for ($i = ($page - 2); $i < $page; $i++) { //Create left-hand side links
                    if ($i > 0) {
                        $pagination .= '<li><a href="/account/series/page/'.$i.'" data-page="' . $i . '" title="Page' . $i . '">' . $i . '</a></li>';
}
                }
                $first_link = false; //set first link to false
            }

            if ($first_link) { //if current active page is first link
                $pagination .= '<li class="first active">' . $page . '</li>';
            } elseif ($page == $total_pages) { //if it's the last active link
                $pagination .= '<li class="last active">' . $page . '</li>';
            } else { //regular current link
                $pagination .= '<li class="active">' . $page . '</li>';
            }

            for ($i = $page + 1; $i < $right_links; $i++) { //create right-hand side links
                if ($i <= $total_pages) {
                    $pagination .= '<li><a href="/account/series/page/'.$i.'" data-page="' . $i . '" title="Page ' . $i . '">' . $i . '</a></li>';
                }
            }
            if ($page < $total_pages) {
                $next_link = ($page > $total_pages) ? $total_pages : $next;
                $pagination .= '<li><a href="/account/series/page/'.$next_link.'" data-page="' . $next_link . '" title="Next">&gt;</a></li>'; //next link
                $pagination .= '<li class="last"><a href="/account/series/page/'.$total_pages.'" data-page="' . $total_pages . '" title="Last">&raquo;</a></li>'; //last link
            }

            $pagination .= '</ul>';
        }
        return $pagination;
    }

}
