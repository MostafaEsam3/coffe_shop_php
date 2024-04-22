<?php
require ("../../model/Room.php");
require("../../model/Connection.php");


$result=new Room();
var_dump($_GET);
$id=$_GET['id'];

$result->deleteRoomById($id);
header("location:../../views/dashboard/AllRoom.php");
