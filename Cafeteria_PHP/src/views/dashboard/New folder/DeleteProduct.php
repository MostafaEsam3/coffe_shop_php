<?php
require ("../../model/Product.php");


$products=new Product;
var_dump($_GET);
$id=$_GET['id'];

$products->deleteProductById("$id");
header("location:../../views/dashboard/AllProduct.php");
