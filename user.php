<?php

/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 8/6/16
 * Time: 10:44 AM
 */

include_once "database.php";

class user extends database
{
    private $table = 'users';
    public function __construct()
    {
        parent::__construct();
    }

    // override
    public function getItemById( $id)
    {
        return parent::getItemById($this->table, $id);
    }
    //ham getall

    public function getAll()
    {
        return parent::getAll($this->table);
    }
    public function getItemByName( $name)
    {
        return parent::getItemByName($this->table, $name,'user_name'); // TODO: Change the autogenerated stub
    }

    public function insertUser($user_name,$user_pass,$user_email){

        $sql = "INSERT INTO ".$this->table." (user_name, user_pass, user_email) VALUES (? , ? , ?) ";

        try{
            $this->stmt = $this->conn->prepare($sql);
            // bindParam

            $this->stmt->bindParam(1,$user_name,PDO::PARAM_STR);
            $this->stmt->bindParam(2,$user_pass,PDO::PARAM_STR);
            $this->stmt->bindParam(3,$user_email,PDO::PARAM_STR);

            $this->stmt->execute();


        } catch(PDOException $e){
            die($e->getMessage());
        }
            $id = $this->conn->lastInsertId();
         return $this->getItemById($id);

    }


    // ham thay doi gia tri


    public function updateUser($id,$user_name,$user_pass,$user_email){
        $sql = "UPDATE ".$this->table." SET user_name=:user_name, user_pass=:user_pass, user_email=:user_email WHERE id = :id ";
//        return $sql;

        try{

            $this->stmt = $this->conn->prepare($sql);

            $this->stmt->bindValue(":user_name", $user_name);
            $this->stmt->bindValue(":user_pass", $user_pass);
            $this->stmt->bindValue(":user_email", $user_email);
            $this->stmt->bindValue(":id", $id,PDO::PARAM_INT);

            $this->stmt->execute();

        }catch (PDOException $e){
            die($e->getMessage());
        }

        return $this->getItemById($id);

    }


    public function searchUser($name){
        $sql = "SELECT * FROM ".$this->table." WHERE user_name LIKE  ?";

        try{
            $this->stmt = $this->conn->prepare($sql);

            $name = "%$name%";
            $this->stmt->bindValue(1,$name);
            $this->stmt->execute();
        } catch(PDOException $e){
            echo "<pre>";var_dump($e->getMessage());echo "</pre>"; exit;
        }
        $result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}



















