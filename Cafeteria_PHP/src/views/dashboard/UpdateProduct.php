<?php
require ("../../model/Product.php");
require("../../model/Connection.php");

$products=new Product;
$id=$_POST['id'];
$products->updateProduct("
name='{$_POST['productName']}',
price='{$_POST['price']}',
quantity='{$_POST['quantity']}',
category_id='{$_POST['category_id']}'

","$id");
header("location:../../views/dashboard/AllProduct.php");

