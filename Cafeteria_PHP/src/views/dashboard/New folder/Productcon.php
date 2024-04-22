

<?php
var_dump($_POST['productName']);
require("../../model/Product.php");


$Products=new Product;
$productName=validation($_POST['productName']);
$Price=validation($_POST['price']);


$error=[];
if(strlen($productName)<3)
{
    $error['$productName']="The user name must be more than two character";
}
if(strlen($Price)==0)
{
    $error['$password']="Pleas enter the price";
}


$result=$Products->getProduct("name='$productName'");


    if($result)
    {
        $error['$productName']="product is exist";

    }

if($_FILES['image']['size']>100000) {
    $error['image']="the image is too long";
 }
else
{
    $from=$_FILES['image']['tmp_name'];

    $image=$_FILES['image']["name"];
    move_uploaded_file($from,"../../views/dashboard/ProductImage/".$image);

}


if(count($error)>0)
{

    header("location:../../views/dashboard/AddProduct.php?error=".json_encode($error));
}
else{    
    $category_id=1;
    $quantity=5;
    try {
        $Products->addProducts($_POST['productName'],$_POST['price'],$quantity,$image,$category_id,);
        header("location:../../views/dashboard/AllProduct.php");
    } catch (PODException $th) {
        echo $th->getMessage();
        header("location:".$_SERVER['PHP_SELF']."?errors=");
    }

}
function validation($data)
{

    $data=trim($data);
    $data=addslashes($data);
    $data=htmlspecialchars($data);
    return $data;

}
?>
