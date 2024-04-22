<?php


include_once './includes/header.php';
getHeader('Add Category');
include_once './includes/nav_bar.php';


$error=[];
if(isset($_GET['error'])){
  $error=json_decode($_GET['error'],true);
}

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

              <h1 class="text-primary">Add Category</h1>
              <form method="post" action="../../controller/dashboard/Category.php" enctype="multipart/form-data">
                <div class="form-group ">
                  <label for="exampleInputName">Category name</label>
                  <input type="text" class="form-control" id="username" aria-describedby="nameHelp" name="name">
                  <small class="text-danger"><?php if(isset($error['$name'])){
                    echo $error['$name'];
                  } ?></small>
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