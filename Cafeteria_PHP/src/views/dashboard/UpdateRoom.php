<?php
require ("../../model/Room.php");
require("../../model/Connection.php");
$rooms=new Room;
$id=$_POST['id'];

$rooms->updateRoom("
name='{$_POST['name']}'

",$id);
header("location:../../views/dashboard/AllRoom.php");

