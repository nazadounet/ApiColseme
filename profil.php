<?php
require_once 'core/nazad/debug.php';//debuging files
include_once 'core/access/access.php';

/*Class require section*/
require 'core/database/Pdo.php';
/*Class require section*/

use Core\Database\SPDO;

$SPDO = SPDO::getInstance();

if(file_get_contents('php://input')){


    $dataFromAngular = json_decode(file_get_contents('php://input'));

        $SPDO->prepareAction("UPDATE user SET lastname = :lastname, firstname = :firstname, adress = :adress,birthDay = :birthDay, phone = :phone WHERE id = :id",
                            [
                                ':lastname' => $dataFromAngular->lastname,
                                ':firstname' => $dataFromAngular->firstname,
                                ':adress' => $dataFromAngular->adress,
                                ':birthDay' => $dataFromAngular->birthDay,
                                ':phone' => $dataFromAngular->phone,
                                ':id' => $dataFromAngular->id
                            ]);
        $id = $dataFromAngular->id;

        $response = $SPDO->queryRecup("SELECT id, pseudo, email, lastname, firstname, adress, phone FROM user WHERE id = $id");

        $userData =
            [
                'id' => $response[0]->id,
                'pseudo' => $response[0]->pseudo,
                'email' => $response[0]->email,
                'lastname' => $response[0]->lastname,
                'firstname' => $response[0]->firstname,
                'adress' => $response[0]->adress,
                'phone' => $response[0]->phone,
            ];

        print_r(json_encode($userData));

}




