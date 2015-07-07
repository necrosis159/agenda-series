<?php
    
    //Chargement de la class Routing
    $router = new Routing();

//Route Sans Paramètre
    //Index
    $router->get('/', 'Index@index');
    $router->get('/index', 'Index@index');
    //Ajout d'utilisateur
    $router->get('/user/ajout', 'User@index');
    $router->get('/user/test', 'User@test');
    //Ajouter un commentaire
    $router->post('/serie/comment', 'Serie@comment');
    //Ajout user
    $router->post('/user/insert', 'User@insert');
    //404
    $router->get('/404', 'Default@index404'); 
    
    // Page du calendrier général
    $router->get('/calendar/show', 'Calendar@show'); 
    
    //Account
    $router->get('/account/', 'Account@login');
    $router->get('/account/index', 'Account@login');
    $router->get('/account/login', 'Account@login');
    $router->get('/account/register', 'Account@register');
    $router->get('/account/logout', 'Account@logout');
    $router->get('/account/profile', 'Account@profile');
    $router->get('/account/edit', 'Account@edit');
    $router->get('/account/series', 'Account@series');
    $router->get('/account/ajaxSearchSeriesByName', 'Account@ajaxSearchSeriesByName');
    $router->post('/account/check-login', 'Account@checkLogin');
    $router->post('/account/register', 'Account@register');
    $router->post('/account/profile', 'Account@profile');
    $router->post('/account/edit', 'Account@edit');
    
    
//Route Avec Paramètre
    //Affiche user
    $router->get('/user/show/:name-:username', 'User@show')
        ->with('name', '[a-zA-Z0-9\-]+')
        ->with('username', '[a-zA-Z0-9\-]+');
    $router->post('/user/:name-:username', 'User@show')
        ->with('name', '[a-zA-Z0-9\-]+')
        ->with('username', '[a-zA-Z0-9\-]+');
    //Affiche serie
    $router->get('/serie/:id', 'Serie@serie')
        ->with('id', '[0-9]+');
    $router->post('/serie/:id', 'Serie@serie')
        ->with('id', '[a-zA-Z0-9\-\ ]+');

     //Affiche saison
    $router->get('/serie/:id/Saison:nb1', 'Serie@saison')
        ->with('id', '[0-9]+')
        ->with('nb1', '[0-9]+');
    $router->post('/serie/:id/Saison:nb1', 'Serie@saison')
        ->with('id', '[a-zA-Z0-9\-\ ]+')
        ->with('nb1', '[0-9]+');

     //Affiche episode
    $router->get('/serie/:id/Saison:nb1/Episode:nb2', 'Serie@episode')
        ->with('id', '[0-9]+')
        ->with('nb1', '[0-9]+')
        ->with('nb2', '[0-9]+');
    $router->post('/serie/:id/Saison:nb1/Episode:nb2', 'Serie@episode')
        ->with('id', '[0-9]+')
        ->with('nb1', '[0-9]+')
        ->with('nb2', '[0-9]+');

    //Si l'url existe on prend l'url, sinon on mets "/"
    $url = (isset($_GET['url'])) ? $_GET['url'] : '/';
    
    //Traitement de l'url
    $router->parse($url);