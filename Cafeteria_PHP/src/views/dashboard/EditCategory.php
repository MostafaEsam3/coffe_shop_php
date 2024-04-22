<?php

include_once './includes/header.php';
getHeader('Edit Category');
include_once './includes/nav_bar.php';


$error=[];
if(isset($_GET['error'])){
  $error=json_decode($_GET['error'],true);
}
require("../../model/Connection.php");
require("../../model/Category.php");
require_once("../../controller/dashboard/pagination.php");
$result=new Category();
$id=$_GET['id'];
$categories=$result-> getCategoryById($id);
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

<h1 class="text-primary">Update Category</h1>

    <form method="post" class="col-lg-6 " action="../../views/dashboard/UpdateCategory.php" enctype="multipart/form-data">
      <div class="form-group ">
          <label for="exampleInputName">Category name</label>

          <input value="<?php echo $categories[0]['name']?>"  type="text" class="form-control" id="name"  name="name" >

      </div>

        <input type="hidden" id="name" value="<?php echo $categories[0]['id']?>" name="id"><br>
      <div>

      <button type="submit " class="btn btn-primary my-sm-2 ">Update</button>
      <input class="col-lg2 text-light p-1 my-sm-2 bg-danger rounded-1 border-0 " type="reset">

      </div>
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
