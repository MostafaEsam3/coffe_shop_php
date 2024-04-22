
<?php


include_once './includes/header.php';
getHeader('Edit User');
include_once './includes/nav_bar.php';

require ("../../model/User.php");
require("../../model/Connection.php");
require("../../model/Room.php");
$id=$_GET['id'];
  $data=new Room;
  $rooms=$data->getAllRooms();
$error=[];
if(isset($_GET['error'])){
  $error=json_decode($_GET['error'],true);
}
$users=new User;

$data=$users->get_user($id);
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


  <h1 class="text-primary">Update User</h1>
  <form method="post" class="col-lg-6 " action="../../views/dashboard/UpdateUser.php" enctype="multipart/form-data">
    <div class="form-group ">

    <input type="hidden" id="fname" value="<?php echo $id?>" name="id"><br><br>
      <label for="exampleInputName">Name</label>
      <input type="text" class="form-control" id="username" value="<?php echo $data['username']?>" aria-describedby="nameHelp" name="username" required>
      <small class="text-danger" ><?php if(isset($error['$username'])){
        echo $error['$username'];
      } ?></small>
    </div>
    <div class="">
      <label for="exampleInputEmail">Email</label>
      <input type="email" value="<?php echo $data['email']?>" class="form-control" id="exampleInputEmail" name="email" required>
      <small class="text-danger" ><?php if(isset($error['$email'])){
        echo $error['$email'];
      } ?></small>
      <small class="text-danger" ><?php if(isset($error['$existEmail'])){
        echo $error['$existEmail'];
      } ?></small>
    </div>
    <div class="">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" value="<?php echo $data['password']?>" class="form-control" id="exampleInputPassword1" name="password" required>
    </div>
    <div class="">
      <label for="exampleInputPassword1">Confirm Password</label required>
      <input value="<?php echo $data['password']?>" type="password" class="form-control" id="exampleInputPassword1" name="password" >
      <small class="text-danger" ><?php if(isset($error['$password'])){
        echo $error['$password'];
      } ?></small>
    </div>

    <select name="room_id" class="form-control custom-select js-example-multiple" id="room" required>
      <?php
        foreach($rooms as $room){?>
        <option value="<?php  echo $room['id'];?>"><?php echo $room['name'];?></option>
        <?php }?>
      </select>
    <div>

      <button   name="updateUser" type="submit " class="btn btn-primary my-sm-2 ">Update</button>

      <input  class="col-lg2 text-light p-1 my-sm-2 bg-danger rounded-1 border-0 " type="reset">

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
