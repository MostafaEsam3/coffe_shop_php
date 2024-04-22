

<?php

include_once './includes/header.php';
getHeader('All Room');
include_once './includes/nav_bar.php';

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


    <div class="d-flex justify-content-between my-sm-4">
        <h1>All Users</h1>
        <a class="w-0 h-25 btn btn-primary" href="../../views/dashboard/AddUserView.php">add user</a>
    </div>
    <table class="table  table-hover my-lg-4 table-sm  justify-content-center">
    <thead >
        <th  scope="col">Id</th>
        <th  scope="col">Name </th>
        <th  scope="col">Email</th>
        <th scope="col" >Is admin</th>
        <th  scope="col">room_id</th>
        <th  scope="col">Image</th>
        <th  scope="col">Created_at</th>
        <th  scope="col">Action</th>
        <tr>
        </thead>

        <?php
require("../../model/User.php");
require_once("../../controller/dashboard/pagination.php");
      require("../../model/Connection.php");

//for pagination///
$result=new User();
$totalNumberOfUsers=$result->getNumberOfUsers();

$page=(isset($_GET['page']))?(int) $_GET['page'] : 1;
$pageLimit=3;
$pagesNumber=ceil($totalNumberOfUsers / $pageLimit);
$offset=($page-1)*$pageLimit;
if(!$totalNumberOfUsers)
{
  $error['users']="there is no users to list pleas add user to list";
  header("location:../../views/dashboard/AddUserView.php?error=".json_encode($error));

}
if(!validationPage($page,$pagesNumber))
{
    header("location:".$_SERVER['PHP_SELF']."?page=1");
}

$users=$result->getUsersForPagination($pageLimit,$offset);

echo "<pre>";

        foreach($users as $user)
        {
            echo "<tbody>";
            echo "<tr>";
            foreach($user as $key=>$data){
              if($key=='image')
              {
                  echo "<td><img src='.../../img/$data' width='50' hight='50'></td>";
              }
              else
                {
                  echo "<td>$data</td>";
                }
              }
            echo "<td>
            <a class='btn btn-primary' href= ' EditUser.php?id={$user['id']}'>edit</a>
            <a class='btn btn-danger' href='DeleteUser.php?id={$user['id']}'>delete</a>
            </td>";
            echo "</tr>";
            echo "</tbody>";
            }
        ?>
    </table>
    <nav aria-label="...">
  <ul class="pagination">
    <li class="page-item ">
      <a class="page-link" href="<?=$_SERVER['PHP_SELF']."?page=".($page-1)?>" >Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#"><?=$page?></a></li>
    <li class="page-item active">
      <a class="page-link" href="#"><span class="sr-only">page of </span></a>
    </li>
    <li class="page-item"><a class="page-link" href="#"><?=$pagesNumber?></a></li>
    <li class="page-item">
      <a class="page-link" href="<?=$_SERVER['PHP_SELF']."?page=".($page+1)?>">Next</a>
    </li>
  </ul>
</nav>

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
