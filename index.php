<?php
    session_start();

    //Auto-load des elements de base
    define('APPLICATION_PATH', realpath(dirname(__FILE__)));

    function autoloader_core($class) {
        if(file_exists('core/' . $class . '.class.php'))
        {
            include 'core/' . $class . '.class.php';
        }
    }
    function autoloader_controllers($class) {
        if(file_exists('controllers/' . $class . '.class.php'))
        {
            include 'controllers/' . $class . '.class.php';
        }
    }
    function autoloader_models($class) {
        if(file_exists('models/' . $class . '.class.php'))
        {
            include 'models/' . $class . '.class.php';
        }
    }
    spl_autoload_register('autoloader_core');
    spl_autoload_register('autoloader_controllers');
    spl_autoload_register('autoloader_models');

    //Chargement des routes
    require 'config/config_route.php';
