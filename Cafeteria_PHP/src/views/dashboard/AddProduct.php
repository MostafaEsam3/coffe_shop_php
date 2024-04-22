<?php
include_once './includes/header.php';
getHeader('Add Product');
include_once './includes/nav_bar.php';


$error=[];
if(isset($_GET['error'])){
  $error=json_decode($_GET['error'],true);

}
require("../../model/Connection.php");
require("../../model/Category.php");

$data=new Category;
$categories=$data->get_category();
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




              <h1 class="text-primary">AddProduct</h1>
              <form method="post" class="col-lg-6 " action="../../controller/dashboard/Product.php"
                enctype="multipart/form-data">
                <div class="form-group ">
                  <label for="exampleInputName">Product Name</label>
                  <input type="text" class="form-control" id="username" aria-describedby="nameHelp" name="productName">
                  <small class="text-danger"><?php if(isset($error['$productName'])){
        echo $error['$productName'];
      } ?></small>
                </div>

                <div class="form-outline" style="width: 22rem;">
                  <label class="form-label" for="form1">Enter the Price</label>
                  <i class="fas fa-dollar-sign trailing"></i>
                  <input type="number" id="form1" name="price" class="form-control form-icon-trailing" />
                  <small class="text-danger"><?php if(isset($error['$price'])){
        echo $error['$price'];
      } ?></small>
                </div>
                <div class="form-outline" style="width: 22rem;">
                  <label class="form-label" for="form1">Enter the Quantity</label>
                  <i class="fas fa-dollar-sign trailing"></i>
                  <input type="number" id="form1" name="quantity" class="form-control form-icon-trailing" />
                  <small class="text-danger"><?php if(isset($error['$price'])){
        echo $error['$price'];
      } ?></small>
                </div>




                <div class=" form-group">
                  <label for="category">Choose Category:</label>
                  <a href="../../views/dashboard/AddCategory.php">add category</a>

                  <select name="category_id" class="form-control my-sm-3" id="category">
                    <?php
      foreach($categories as $category){
      ?>
                    <option value=<?php echo $category['id']?>><?php echo $category['name']?></option>
                    <?php
      // <?=$category['id']
      }
      ?>
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
    </div>
  </div>
</div>

<?php
  include_once './includes/footer.php';
?>