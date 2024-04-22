
<?php
include_once './includes/header.php';
getHeader('All Category');
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


<h1>All Category</h1>
<a class="w-0 h-25 btn btn-primary" href="../../views/dashboard/AddCategory.php">Add category</a>

<table class="table  table-hover my-lg-4 table-sm  justify-content-center">
<thead >
        <th  scope="col">Id</th>
        <th  scope="col">Name </th>
        <th  scope="col">created at </th>
        <th  scope="col">action </th>
        <tr>
        </thead>
        <?php
         require("../../model/Connection.php");
         require("../../model/Category.php");
         require_once("../../controller/dashboard/pagination.php");
         $result=new Category();
         //$categories=$result->get_category();
         $totalNumberOfProducts=$result->getNumberOfCategories();
         $page=(isset($_GET['page']))?(int) $_GET['page'] : 1;
         $pageLimit=3;
         $pagesNumber=ceil($totalNumberOfProducts / $pageLimit);
         $offset=($page-1)*$pageLimit;

         if(!validationPage($page,$pagesNumber))
         {
             header("location:".$_SERVER['PHP_SELF']."?page=1");
         }
         $categories=$result->getCategoriesPagination($pageLimit,$offset);
echo "<pre>";
        foreach($categories as $category)
        {
            echo "<tbody>";
            echo "<tr>";
            foreach($category as $key=>$data){



                    echo "<td>$data</td>";



                      }

                    echo "<td>
                    <a class='btn btn-primary' href= ' EditCategory.php?id={$category['id']}'>edit</a>
                    <a class='btn btn-danger' href='DeleteCategory.php?id={$category['id']}'>delete</a>
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