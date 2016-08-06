<?php

/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 8/6/16
 * Time: 10:02 AM
 */

define("DB_HOST", 'localhost');
define("DB_DBNAME", 'mvc-project');
define("DB_USERNAME", 'root');
define("DB_PASSWORD", '');

abstract class database
{
    public $conn; // PDO class de ket noi den co so du lieu
    public $stmt; // PDO Statament class

    // Khai bao 1 ham khoi tao

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DBNAME, DB_USERNAME, DB_PASSWORD);
            $this->conn->exec("SET CHARACTER SET utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

//            echo "Ket noi thanh cong o day nha";

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    // Ham lay tat ca gia tri theo bang
    public function getAll($table){
        $sql = "SELECT * FROM ".$table;
//        echo $sql; exit;
        try{
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->execute();
            $result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch(PDOException $e){
            die($e->getMessage());
        }
        return $result;
    }
    //ham lay rows theo ID

    public function getItemById($table,$id){
        $sql = "SELECT * FROM ".$table." WHERE id = ?";

        try{
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->bindValue(1,$id,PDO::PARAM_INT);
            $this->stmt->execute();
        } catch(PDOException $e){
            echo "<pre>";var_dump($e->getMessage());echo "</pre>"; exit;
        }
        $result = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }







    public function deleteById($table,$id){
        $sql = "DELETE FROM ".$table." WHERE id = ?";
        try{

            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->bindValue(1,$id,PDO::PARAM_INT);
            $this->stmt->execute();

        } catch(PDOException $e){
            echo "<pre>";var_dump($e->getMessage());echo "</pre>"; exit;
        }
        if($this->getItemById($table,$id) !== false) {
            return false;
        } else {
            return true;
        }



    }
    public function getItemByName($table,$name,$column){
        $sql = "SELECT * FROM ".$table." WHERE ".$column." = ?";

        try{
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->bindValue(1,$name);
            $this->stmt->execute();
        } catch(PDOException $e){
            echo "<pre>";var_dump($e->getMessage());echo "</pre>"; exit;
        }
        $result = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }




}