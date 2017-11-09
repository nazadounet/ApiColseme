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
    //print_r($dataFromAngular->email);

    $userData = $SPDO->recupUserData();
    //print_r($userData[0]->email);

    foreach ($userData as $data) {

        $authentificated = false;
        $notAuthentificated = true;

        if($data->email === $dataFromAngular->email && $data->password === $dataFromAngular->password){
            $authentificated = true;
            print_r(json_encode([
                'status' => 'authentificated',
                'userId' => $data->id
            ]));
        }else if($notAuthentificated = true){
           print_r('nothing match');
        }

    }

}



