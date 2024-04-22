<?php
class Room
{

    public $con;
    private $connection = "";

    public function __construct()
    {
        $connection = new Connection();
        $this->con = $connection->con;
        $this->connection = $connection->con;

    }

    public function getAllRoom(){
        $stmt = $this->con->prepare('SELECT * FROM rooms');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRoomsPagination($pageLimit,$offset){
        $data= $this->con->query("select* from rooms limit $pageLimit offset $offset");
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public  function getRoomById($id)
    {
        $cat = $this->con->query("select* from rooms where id= $id");
        return $cat->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllRooms($con=1){
        $stmt = $this->con->prepare("select * from rooms where $con");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addRoom($room){
        $cat=$this->con->prepare('insert into rooms(name)  values(?)');
        $cat->execute([$room]);

    }
    function deleteRoomById($id){

        $this->con->query("delete from rooms where id=$id");

    }
    public function updateRoom($values,$id){
        $this->con->query("update rooms set $values where  id= $id");


    }

     public function getNumberOfRooms() {
        $result = $this->con->query("select count(id) from rooms");

        if ($result) {

            $count = $result->fetchColumn();
            return $count;
        } else {
            return false;
        }
    }


    public function getRoom($name)
    {
        $stmt = $this->connection->prepare("SELECT id FROM rooms WHERE name = ?");
        $stmt->execute([$name]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getAll_Room($cond = 1)
    {
        $this->connection = $this->connection->query("select * from rooms where $cond");
        return $this->connection->fetchAll(PDO::FETCH_ASSOC);
    }





}

