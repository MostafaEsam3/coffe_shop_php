<?php
require ("../../model/Product.php");
require("../../model/Connection.php");


$products=new Product;
var_dump($_GET);
$id=$_GET['id'];

$products->deleteProductById("$id");
header("location:../../views/dashboard/AllProduct.php");
