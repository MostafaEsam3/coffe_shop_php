<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome Icons  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-6kny1Ns6O/44mnv/o9cj+4sWT0QfpwP2jQFHt4Vw0cVEzrN3uVCr6IeLFJz+/TbnNwh+QujXJCP01HgFsMDpiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Google Fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    <title>Forgot Password </title>
</head>
<body>

    <!-- <div class="container border border-primary col-6 h-5"> -->
    <div class="card">
    <p class="lock-icon"><i class="fa-solid fa-lock"></i></p>
    <h2>Forgot Password?</h2>
    <p>You can reset your Password here</p>
<form action="../../controller/website/UserController.php" method="POST">
    <input type="text"  name="email" placeholder="enter your email " class="passInput "/>
   
    <input type="submit" value="Send Email" name="forget" class="button">
    <?php 
if(isset($_GET['error']))
{
    if($_GET['error']=="1")
   echo "<div class='erMessage text-white mt-2 text-center'>email required</div>";
    else
   echo "<div class='erMessage text-white mt-2 text-center'>email invalid</div>";

}
?>    
    
    
</form>

</div>
</body>

</html>
</div>
