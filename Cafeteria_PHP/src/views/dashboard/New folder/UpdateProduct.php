<?php
require ("../../model/Product.php");

var_dump($_POST);

$products=new Product;
$id=$_POST['id'];

$products->updateProduct("
name='{$_POST['productName']}',
price='{$_POST['price']}'

",$id);
header("location:../../views/dashboard/AllProduct.php");

