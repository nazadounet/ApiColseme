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

    $dataTerrainUser = $SPDO->queryRecup('SELECT id, pseudo, email, firstname, lastname, statusTerrain, phone, idterrain, size, plotNb, latitude, longitude, streetNameTerrain, streetNumberTerrain, postCodeTerrain, cityTerrain, descriptionTerrain, toolsTerrain FROM user 
                          INNER JOIN terrain
                            ON id = user_iduser');

    print_r(json_encode($dataTerrainUser));
}






