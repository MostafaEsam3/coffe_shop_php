<?php
require ("../../model/User.php");
require("../../model/Connection.php");


$users=new User;
var_dump($_GET);
$id=$_GET['id'];

$users->delete_user("$id");
header("location:../../views/dashboard/AllUser.php");
