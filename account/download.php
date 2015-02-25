<?php
    $chemin = $_GET["root"].$_GET["file"];
    
    header('Content-disposition: attachment; filename="' . basename($chemin) . '"');
    header('Content-type: application/octetstream');
    header('Pragma: no-cache');
    header('Expires: 0');
    readfile($chemin);
    // $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
    // http_redirect($monUrl);
    
?>