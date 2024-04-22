<?php
require("../../model/User.php");
require("../../model/Category.php");
require("../../model/Connection.php");

    

var_dump($_POST);
$users=new User;
$username=validation($_POST['username']);
$email=validation($_POST['email']);
$password=validation($_POST['password']);
$room_id=validation($_POST['room_id']);
$Cpassword=validation($_POST['cpassword']);
$room_id=($_POST['room_id']);
$id=$_POST['id'];


$error=[];
if(strlen($username)<3)
{
    $error['$username']="The user name must be more than two character";
}
if($password!==$Cpassword||strlen($password)==0)
{
    $error['$password']="The the confirm password is not mach with the password";
}
if(!filter_var($email,FILTER_VALIDATE_EMAIL))
{

$error['$email']="Invalid email";

}


if($_FILES['image']['size']>10000000) {
    $error['image']="the image is too long";
}
else
{
    $from=$_FILES['image']['tmp_name'];

    $image=$_FILES['image']["name"];
    move_uploaded_file($from,"../../views/dashboard/img/".$image);
        
    
}

$result=$users->getUserByEmail("email='$email'");

    if($result)
    {
        $error['$existEmail']="email is exist";

    }



    
    if(count($error)>0)
    {
        header("location:../../views/dashboard/AddUserView.php?error=".json_encode($error));
        
    }


    else{
        
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        try {
            $users->add_user($username,$email,$room_id,$passwordHash,$image);
            header("location:../../views/dashboard/AllUser.php");
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