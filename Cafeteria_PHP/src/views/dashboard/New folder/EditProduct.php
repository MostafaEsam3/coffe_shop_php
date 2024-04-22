
<?php
$error=[];
if(isset($_GET['error'])){
  $error=json_decode($_GET['error'],true);

}
require ("../../model/Product.php");
$products=new Product;
$id=$_GET['id'];
$data=$products->getProduct($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 ">

    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>


    <div class="container">
      <div class="row">
        <div>

          <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            
              <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                  <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                  </li>
                </ul>
                
              </div>
            </nav>
          </div>
          
          <h1 class="text-primary">AddProduct</h1>

        <div style="width:100%; " class="min-vh-100   col-6 d-flex  justify-content-center align-items-center" >
  <form method="post" class="col-lg-6 " action="../../views/dashboard/UpdateProduct.php" enctype="multipart/form-data">
    <div class="form-group ">
    <input type="hidden" id="name" value="<?php echo $data['id']?>" name="id"><br><br>

      <label for="exampleInputName">Product Name</label>
      <input value="<?php echo $data['name']?>" type="text" class="form-control" id="productName" aria-describedby="nameHelp" name="productName" >
      <small class="text-danger" ><?php if(isset($error['$productName'])){
        echo $error['$productName'];
      } ?></small>
    </div>

    <div class="form-outline" style="width: 22rem;">
      <label   class="form-label" for="form1">Enter the Price</label>
    <i class="fas fa-dollar-sign trailing"></i>
    <input  value="<?php echo $data['price']?>"type="number" id="form1" name="price" class="form-control form-icon-trailing" />
    <small class="text-danger" ><?php if(isset($error['$price'])){
        echo $error['$price'];
      } ?></small>
</div>




  <div class=" form-group">
    <label for="category">Choose Category:</label>
    <a href="">add category</a>
    <select name="category" class="form-control" id="cars">
      <option value="Hot drink">Hot drink</option>
      <option value="juices">juices</option>
      <option value="Soda water">Soda water</option>
      <small class="text-danger" ><?php if(isset($error['$category'])){
        echo $error['$category'];
      } ?></small>
    </select>
  </div>
    <div>
    <label for="photo">Choose a photo:</label>
    <?php if(isset($error['$image'])){
        echo $error['$image'];
      } ?>
    <input class="my-ms-4" type="file" id="photo" name="image" accept="image/*">
    </div>
      <button type="submit " class="btn btn-primary my-sm-2 ">Save</button>
      <input class="col-lg2 text-light p-1 my-sm-2 bg-danger rounded-1 border-0 " type="reset">
    
  </form>
</div>
</div>
  </div>
        
        
      </div>

      
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
