<?php
require("../../model/Room.php");
require("../../model/Connection.php");
require("../../model/Product.php");
$rooms=new Room;
$room=validation($_POST['name']);
var_dump($room);

$error=[];
if(strlen($room)<3)
{
    $error['$name']="The room name must be more than two character";
}


if(strlen($room)==0)
{
    $error['$name']="Pleas enter the room";
}
$result=$rooms->getAllRooms("name='$room'");

    if($result)
    {
        $error['$ExistName']=" the name is exist";

    }

function validation($data)
{

    $data=trim($data);
    $data=addslashes($data);
    $data=htmlspecialchars($data);
    return $data;

}
 if(count($error)>0){
     header("location:../../views/dashboard/AddRoom.php?error=".json_encode($error));

}
 else{
    $rooms->addRoom($room);
    header("location:../../views/dashboard/AllRoom.php");

 }
?>