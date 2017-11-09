<?php
require_once 'core/nazad/debug.php';//debuging files
include_once 'core/access/access.php';

/*Class require section*/
require 'core/database/Pdo.php';
/*Class require section*/

use Core\Database\SPDO;

$SPDO = SPDO::getInstance();

$userData = $SPDO->recupUserData();


if(file_get_contents('php://input')) {

    $dataFromAngular = json_decode(file_get_contents('php://input'));

    $SPDO->prepareAction('INSERT INTO terrain (user_iduser, streetNumberTerrain, streetNameTerrain, postCodeTerrain ,cityTerrain, latitude, longitude, size, plotNb, descriptionTerrain, toolsTerrain, statusTerrain) VALUES (:user_iduser, :streetNumberTerrain, :streetNameTerrain, :postCodeTerrain ,:cityTerrain, :latitude, :longitude, :size, :plotNb, :descriptionTerrain, :toolsTerrain, :statusTerrain)',
        [
            ':user_iduser' => $dataFromAngular->userId,
            ':streetNumberTerrain' => $dataFromAngular->streetNumber,
            ':streetNameTerrain' => $dataFromAngular->streetName,
            ':postCodeTerrain' => $dataFromAngular->postCode,
            ':cityTerrain' => $dataFromAngular->city,
            ':latitude' => $dataFromAngular->latitude,
            ':longitude' => $dataFromAngular->longitude,
            ':size' => $dataFromAngular->size,
            ':plotNb' => $dataFromAngular->plotNb,
            ':descriptionTerrain' => $dataFromAngular->description,
            ':toolsTerrain' => $dataFromAngular->tools,
            ':statusTerrain' => $dataFromAngular->statusTerrain
        ]);

        print_r('terrain added');
}






