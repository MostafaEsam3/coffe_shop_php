
<?php

include_once './includes/header.php';
getHeader('Edit Product');
include_once './includes/nav_bar.php';


$error=[];
if(isset($_GET['error'])){
  $error=json_decode($_GET['error'],true);

}

require("../../model/Connection.php");
require ("../../model/Product.php");

require("../../model/Category.php");
$data=new Category;
 $categories=$data->get_category();
$products=new Product;
$id=$_GET['id'];
$data=$products->getProduct($id);
?>

<div class="container-fluid">
  <div class="row">
    <!-- Left Sidebar start-->
    <?php include_once './includes/side_bar.php'; ?>
    <!-- Left Sidebar End-->

    <div class="content-wrapper">


      <div class="row">
        <div class="col-xl-12 mb-30">
          <div class="card card-statistics mb-30">
            <div class="card-body">



          <h1 class="text-primary">Update Product</h1>

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
    <div class="form-outline" style="width: 22rem;">
      <label   class="form-label" for="form1">Enter the quantity</label>
    <i class="fas fa-dollar-sign trailing"></i>
    <input  value="<?php echo $data['quantity']?>"type="number" id="form1" name="quantity" class="form-control form-icon-trailing" />
    <small class="text-danger" ><?php if(isset($error['$price'])){
        echo $error['$price'];
      } ?></small>
</div>
<select name="category_id" class="form-control my-sm-3" id="category">
      <?php
      foreach($categories as $category){
      ?>
      <option value=<?php echo $category['id']?>><?php echo $category['name']?></option>
      <?php      }
      ?>
    </select>
    <div>
    <label for="photo">Choose a photo:</label>
    <?php if(isset($error['$image'])){
        echo $error['$image'];
      } ?>
    <input class="my-ms-4" type="file" id="photo" name="image" accept="image/*">
    </div>
      <button type="submit " class="btn btn-primary my-sm-2 ">Update</button>
      <input class="col-lg2 text-light p-1 my-sm-2 bg-danger rounded-1 border-0 " type="reset">
  </form>

  </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  include_once './includes/footer.php';
?>
