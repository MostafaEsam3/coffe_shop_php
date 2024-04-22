<?php 
$errors=[];
if(isset($_GET['errors']))
{
    $errors=json_decode($_GET['errors'],true);
}


?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/loginStyle.css">
    <title>Login</title>
</head>
<body>
<div class="container">
<form action="../../controller/website/UserController.php" method="POST">
    <h2>Login</h2>
    <label for="email">Email</label>    
<input type="text"  name="email"  class="form-control mb-3 " id="email" required/>
    <?php 
        if(isset($errors['email']))
        {
            echo "<span style='color:red'>". $errors['email'] ."</span>";
        }
    ?>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" class="form-control mb-3 " required autocomplete/>
    <?php
    if(isset($errors['password']))
        {
            echo "<span style='color:red'>". $errors['password'] ."</span>";
        }
    ?>
    <a href="forget.php" class="text-primary">forget password?</a>
    <input type="submit" value="Login" name="login" class="button" id="submitBtn">
    <p id="help-text"></p>
</form>
<div>
<?php
if(isset($_GET['error']))
{
    echo "<span style='color:red'> Password or email incorrect </span>";  
}
?>
</div>
</div>
 <script src="assets/loginJs.js"></script>
</body>

</html>