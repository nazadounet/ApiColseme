<?php
require_once 'core/nazad/debug.php';//debuging files
include_once 'core/access/access.php';

/*Class require section*/
require 'core/database/Pdo.php';
/*Class require section*/

use Core\Database\SPDO;

$SPDO = SPDO::getInstance();

//recupération des info de la table user, afin de pouvoir par la suite
//vérifier s'il n'existe pas un email identique a celui recupérer via angular
$userData = $SPDO->recupUserData();

//ici on stock les erreurs
$errors= [];


if(file_get_contents('php://input')){

    $dataFromAngular = json_decode(file_get_contents('php://input'));

    //si la variable $errors est vide alors on peut inscrire l'user
    if(empty($errors)){
        $SPDO->prepareAction("INSERT INTO user (pseudo, email, password, passwordConfirm) VALUES (:pseudo, :email, :password, :passwordConfirm)",
            [
                'pseudo' => $dataFromAngular->pseudo,
                'email' => $dataFromAngular->email,
                'password' => $dataFromAngular->password,
                'passwordConfirm' => $dataFromAngular->passwordConfirm
            ]);

        //recupère la dernière ID inscrite
        $response = $SPDO->getLastInsertId();

        $lastId = $response;

        print_r(json_encode($lastId));


    }else{
        print_r(json_encode($errors));
    }
}




