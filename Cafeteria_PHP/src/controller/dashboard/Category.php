<?php
require("../../model/Category.php");
require("../../model/Connection.php");
require("../../model/Product.php");
$categories=new Category;
$category=validation($_POST['name']);
var_dump($category);
$error=[];
if(strlen($category)<3)
{
    $error['$name']="The category name must be more than two character";
}
if(strlen($category)==0)
{
    $error['$password']="Pleas enter the category";
}
$result=$categories->get_category("name='$category'");

    if($result)
    {
        $error['$name']=" the name is exist";

    }

function validation($data)
{

    $data=trim($data);
    $data=addslashes($data);
    $data=htmlspecialchars($data);
    return $data;

}
 if(count($error)>0){
     header("location:../../views/dashboard/AddCategory.php?error=".json_encode($error));

}
 else{
    $categories->addCategory($category);
    header("location:../../views/dashboard/AllCategory.php");

 }
?>