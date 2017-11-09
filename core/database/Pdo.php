<?php

namespace Core\Database;

use \PDO;

class SPDO
{

    private $PDOInstance = null;


    private static $instance = null;


    const DEFAULT_SQL_USER = 'root';

    const DEFAULT_SQL_HOST = 'localhost';

    const DEFAULT_SQL_PASS = 'root';

    const DEFAULT_SQL_DTB = 'Colseme';


    private function __construct()
    {
        $this->PDOInstance = new PDO('mysql:dbname='.self::DEFAULT_SQL_DTB.';host='.self::DEFAULT_SQL_HOST,self::DEFAULT_SQL_USER ,self::DEFAULT_SQL_PASS);
        $this->PDOInstance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
        $this->PDOInstance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
    }


    public static function getInstance()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new SPDO();
        }
        return self::$instance;
    }

    public function recupUserData($one = false){
        $req = $this->PDOInstance->query('SELECT * FROM user');
        $req->setFetchMode(PDO::FETCH_OBJ);
        if($one = true){
            $datas = $req->fetch();
        }else{
            $datas = $req->fetchAll();
        }
        return $datas;
    }

    public function getLastInsertId(){
       $userId = $this->PDOInstance->lastInsertId();
       return $userId;
    }

    public function queryRecup($statement, $class_name = null, $one = false){
        $req = $this->PDOInstance->query($statement);
        if($class_name === null){
            $req->setFetchMode(PDO::FETCH_OBJ);
        }else{
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if ($one){
            $datas = $req->fetch();
        }else{
            $datas = $req->fetchAll();
        }
        return $datas;
    }

    //requete préparé, argument: (requete,atributes, nome de class, $one = un seul resultat)
    public function prepareRecup($statement, $attributes, $class_name = null, $one = false){
        $req = $this->PDOInstance->prepare($statement);
        $req->execute($attributes);
        if($class_name === null){
            $req->setFetchMode(PDO::FETCH_OBJ);
        }else{
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if ($one){
            $datas = $req->fetch();
        }else{
            $datas = $req->fetchAll();
        }
        $datas = json_encode($datas);
        return $datas;
    }

    //requêtes effectuant tout autre action que le recup ( SET / UPDATE / DELETE )
    public function prepareAction($statement, $attributes){
        $req = $this->PDOInstance->prepare($statement);
        $req->execute($attributes);
    }
}