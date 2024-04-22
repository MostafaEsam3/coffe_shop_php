<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
</head>    

<div class="card">
<div style="color:aqua">we sent code for your email confirm it</div>
<form action="../../controller/website/UserController.php" method="POST">
    <input type="text"   name="code" placeholder="enter code" class="passInput"/>
    <input type="submit" value="confirm" name="confirm" class="button">
    <?php 
    if(isset($_GET['error']))
    {

    echo "<div class='erMessage text-white mt-2 text-center'>wrong code</div>";
        

    }
    ?>
    
    
</form>
</div>