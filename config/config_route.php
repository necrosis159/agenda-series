<?php
    
    //Chargement de la class Routing
    $router = new Routing();

    //Index
    $router->get('/index', 'Index@index');
    //Ajout d'utilisateur
    $router->get('/user/ajout', 'User@index');

    //Affiche user
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