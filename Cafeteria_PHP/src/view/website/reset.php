<?php 
$errors=[];
$token=isset($_GET['token'])? $_GET['token']:'';
if(isset($_GET['errors']))
{
    $errors=json_decode($_GET['errors'],true);
   
}
?>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/loginStyle.css">
</head>
<body>

<div class="container border border-primary col-6 h-5">
<form action="../../controller/website/UserController.php" method="POST">
    <input type="password"  name="password" placeholder="enter new password" class="form-control mb-3 "/><?php if(isset($errors['password']))echo "<span style='color:red'>".$errors['password']."</span>"; ?>
    <input type="password"  name="confirm_password" placeholder="confirm password" class="form-control mb-3 "/><?php if(isset($errors['confirm_password']))echo "<span style='color:red'>". $errors['confirm_password']."</span>"; ?>
    <input type="hidden" name="token" value="<?php echo $token;?>">
    <input type="submit" value="Reset" name="Reset" class="btn btn-primary">
    <?php if(isset($errors['match']))echo "<span style='color:red'>". $errors['match']."</span>";?>  
    
</form>
</div>
</body>
</html>