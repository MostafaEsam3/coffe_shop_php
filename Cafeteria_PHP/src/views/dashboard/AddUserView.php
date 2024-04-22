
<?php

include_once './includes/header.php';
getHeader('Add User');
include_once './includes/nav_bar.php';


$error=[];
if(isset($_GET['error'])){
  $error=json_decode($_GET['error'],true);

}
require("../../model/Room.php");
  require("../../model/Connection.php");
  require("../../model/User.php");

  $data=new Room;
  $rooms=$data->getAllRooms();
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



          <h1 class="text-primary">Add User</h1>

  <form method="post" class="col-lg-6 " action="../../controller/dashboard/UserControlar.php" enctype="multipart/form-data">
    <div class="form-group ">
      <label for="username">Name</label>
      <input type="text" class="form-control" id="username" aria-describedby="nameHelp" name="username" >
      <small class="text-danger" ><?php if(isset($error['$username'])){
        echo $error['$username'];
      } ?></small>
    </div>
    <div class="">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email" >
      <small class="text-danger" ><?php if(isset($error['$email'])){
        echo $error['$email'];
      } ?></small>
      <small class="text-danger" ><?php if(isset($error['$existEmail'])){
        echo $error['$existEmail'];
      } ?></small>
    </div>
    <div class="">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" name="password" >
    </div>
    <div class="">
      <label for="exampleInputPassword1">Confirm Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" name="cpassword" >
      <small class="text-danger" ><?php if(isset($error['$password'])){
        echo $error['$password'];
      } ?></small>
    </div>


      <select name="room_id" class="form-control custom-select js-example-multiple" id="room">
      <?php
        foreach($rooms as $room){?>
        <option value="<?php  echo $room['id'];?>"><?php echo $room['name'];?></option>
        <?php }?>
      </select>

     <!-- <select name="category" class="form-control custom-select js-example-multiple" id="category">
    <?php foreach($rooms as $room): ?>
        <option  value="<?php echo $room['name']; ?>"><?php echo $room['name']; ?></option>
    <?php endforeach; ?>
</select>  -->


    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control" id="image"accept="image/*" name="image" >
        <?php if(isset($error['$image'])){
        echo $error['$image'];
      } ?>
</div>
      <button name="addUser" type="submit " class="btn btn-primary my-sm-2 ">Save</button>

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