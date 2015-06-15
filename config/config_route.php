<?php
    
    //Chargement de la class Routing
    $router = new Routing();

    //Index
    $router->get('/index', 'Index@index');
    /*
    Exemple de route :
    url : /user
    destination : 
        controller : controllers/UserController.class.php
        Method dans le controller : index()
    */
    $router->get('/user', 'User@index');

    /*
    Exemple de route :
    url : /user
    destination : 
        controller : controllers/UserController.class.php
        Method dans le controller : index()
        Paramètre : name, surname (avec les expressions regulière)
        ATTENTION : les paramètre doivent avoir le même nom (exemple :  ":param" => "param")
        ATTENTION : ne pas oublier les ":"
        ATTENTION : ne pas se tromper sur les expressions regulières.
    */
    $router->get('/user/:name-:username', 'User@show')
        ->with('name', '[a-zA-Z0-9\-]+')
        ->with('username', '[a-zA-Z0-9\-]+');
    $router->post('/user/:name-:username', 'User@show')
        ->with('name', '[a-zA-Z0-9\-]+')
        ->with('username', '[a-zA-Z0-9\-]+');

    //Ajout user
    $router->post('/user/insert', 'User@insert');


    //Si l'url existe on prend l'url, sinon on mets "/"
    $url = (isset($_GET['url'])) ? $_GET['url'] : '/';
    
    //Traitement de l'url
    $router->parse($url);