<?php
class baseView
{
    private $data = array();
    private $layout = FALSE;

    public function assign($variable, $value)
    {
        $this->data[$variable] = $value;
        return $this;
    }

    public function render($view, $layout="layout")
    {
        extract($this->data);

        try {
            //Layout
            $file_layout = APPLICATION_PATH . '/views/' . $layout . '.php';

            if (file_exists($file_layout)) {
                $this->layout = $file_layout;
            } else {
                throw new Exception('Layout : ' . $file_layout . ' not found!');
            }
            //Vue
            $view = APPLICATION_PATH . '/views/' . $view . '.php';

            if (file_exists($view)) {
                include($view);
            } else {
                throw new Exception('View : ' . $view . ' not found!');
            }
        }
        catch (Exception $e) {
            echo $e->errorMessage();
        }
    }


}