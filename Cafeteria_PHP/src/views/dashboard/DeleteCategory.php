<?php
require ("../../model/Category.php");
require("../../model/Connection.php");


$result=new Category();
$categories=$result->get_category();
var_dump($_GET);
$id=$_GET['id'];

$result->deleteCategoryById("$id");
header("location:../../views/dashboard/AllCategory.php");
