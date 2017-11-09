<?php

use \Core\Autoloader;


class App
{
    public static $_instance;
/*
    //permet de charger l'autoloder ROOT/care/Autoloader.php
    public static function load(){
        session_start();
        require '../core/Autoloader.php';
        Autoloader::register();
    }
*/
    //Crée une instance de la classe, si aucune n'est deja créé contenu dans $_instance;
    public static function get_instance(){
        if(is_null(self::$_instance)){
            return self::$_instance = new App;
        }
        return self::$_instance;
    }

}