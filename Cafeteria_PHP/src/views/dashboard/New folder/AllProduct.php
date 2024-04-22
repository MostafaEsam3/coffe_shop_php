

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body >
<div class="container">
    
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
    <div class="d-flex justify-content-between my-sm-4">
        <h1>All Products</h1>
        <a class="w-0 h-25 btn btn-primary" href="../../views/dashboard/AddProduct.php">add product</a>
    </div>
    <table class="table  table-hover my-lg-4 table-sm  justify-content-center">
    <thead >
        <th  scope="col">Id</th>
        <th  scope="col">Name </th>
        <th  scope="col">Price</th>
        <th  scope="col">quantity</th>
        <th scope="col" >Image</th>
        <th  scope="col">categoryId</th>
        <th  scope="col">Created_at</th>
        <th  scope="col">Action</th>
        <tr>
        </thead>

        <?php
require("../../model/Product.php");
require_once("../../controller/dashboard/pagination.php");
//for pagination///
$result=new Product();
$totalNumberOfProducts=$result->getNumberOfProducts();

$page=(isset($_GET['page']))?(int) $_GET['page'] : 1; 
$pageLimit=3;
$pagesNumber=ceil($totalNumberOfProducts / $pageLimit);
$offset=($page-1)*$pageLimit;

if(!validationPage($page,$pagesNumber))
{
    header("location:".$_SERVER['PHP_SELF']."?page=1");
}

$products=$result->getProductForPagination($pageLimit,$offset);

echo "<pre>";

        foreach($products as $product)
        {
            echo "<tbody>";
            echo "<tr>";
            foreach($product as $key=>$data){
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
            <a class='btn btn-primary' href= ' EditUser.php?id={$product['id']}'>available</a>
            <a class='btn btn-primary' href= ' EditProduct.php?id={$product['id']}'>edit</a>
            <a class='btn btn-danger' href='DeleteProduct.php?id={$product['id']}'>delete</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>