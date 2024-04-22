<?php 
session_start();
require '../../controller/website/OrderController.php';
require '../../controller/website/OrderProductController.php';

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="assets/myorder.css">
<body >
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="#"><?=$_SESSION['username']?></a>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="http://localhost/Cafeteria_php/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/Cafeteria_php/src/view/website/myorder.php">Myorder</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?=$_SERVER['PHP_SELF']."?logout=1"?>" >Logout</a>
        </li>
      </ul>
     
    </div>
  </div>
</nav>
<?php
if(isset($_GET['logout']))
{
    session_destroy();
    header("Location:login.php");
    exit();
}


if(!isset($_SESSION['user_id']))
{
    header("Location:login.php");
}
else{
    $order=new OrderController;
    function validate($page,$pageNumber)
    {
        return ($page>=1 and $page <=$pageNumber);
    }
    $page = (isset($_GET['page']) )? (int) $_GET['page'] :1;
    $totalCount=$order->getTotalCount($_SESSION['user_id']);
    $pageLimit=2;
    $pageNumber=ceil($totalCount/$pageLimit);
    $offset=($page-1) * $pageLimit;
    if (!validate($page,$pageNumber)) {
        header("Location:myorder.php?page=1");
    }
    if (isset($_POST['search']))
    {
        $from=$_POST['from'];
        $to=$_POST['to'];
        
        $allOrders=$order->filterDataByDate($from,$to,$_SESSION['user_id'],$pageLimit, $offset);
      
    }else{

        $allOrders=$order->fetch_data($_SESSION['user_id'],$pageLimit, $offset);
    }
   
}
?>
<div class="container bg-primary bg-gradient">
<h1>My Order</h1>
    <div class="row">
        <form action="<?php $_SERVER['PHP_SELF']."?page=1";?>" method="POST" class="col-md-6 mb-3" id="dateFilterForm">
            <div class="form-row">
                <div class="col-4">
                    <input type="date" name="from" class="form-control" placeholder="Date from" onchange="filterOrders()">
                </div>
                <div class="col-4">
                    <input type="date" name="to" class="form-control" placeholder="Date to" onchange="filterOrders()">
                </div>

                <div class="col-2">
                    <input type="submit" name="search" value="Search" class="btn btn-primary">
                </div>
            </div>

        </form>
    </div>

    <div class="row">
        <table id="orderTableContainer" class="table col-12 table-bordered ">
            <tr class="table-primary">
                <th>Order Date</th>
                <th>Status</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
            <?php 
            $totalAmout=0;
            $orderProductController = new OrderProductController;
            foreach($allOrders as $orderinfo)
            {
                
                
                
                $orderproducts= $orderProductController->getDetailes($orderinfo['id']);
                // var_dump($orderinfo['id']);
                // var_dump($orderproducts);
                echo "<tr class='order-date-row table-success'>";
                echo "<td>".$orderinfo['created_at']."<button class='toggle-btn btn btn-primary'>+</button></td>";
                if($orderinfo['status']==1)
                echo "<td> processing </td>";
                else if($orderinfo['status']==2)
                    echo "<td> out of delievry </td>";
                else if($orderinfo['status']==3)
                    echo "<td> Done </td>";      
                else if($orderinfo['status']==4)
                    echo "<td> Canceled </td>";      
                echo "<td>".$orderinfo['total']."</td>";
                $totalAmout+=$orderinfo['total'];
                $disabled = ($orderinfo['status'] == 2 || $orderinfo['status'] == 3 || $orderinfo['status'] == 4) ? 'disabled' : '';
                // Create the link with the disabled attribute if status is 2 or 3
                echo "<td><a href='http://localhost/Cafeteria_php/src/controller/website/OrderController.php?id={$orderinfo['id']}' class='btn btn-primary {$disabled}'>Cancel</a></td>";
                echo "</tr>";
                echo "<tr  class='order-details' style='display: none;'><td colspan='4'>";
                echo "<div class='d-flex justify-content-around'>";
                foreach($orderproducts as $productinfo)
                {
                     
                    echo "<div class='border border-success'>";
                    echo "<div><img src='../../views/dashboard/ProductImage/{$productinfo['image']}' style='width:60px;height:60px;'></div>";
                    echo "<div>Product Name: {$productinfo['name']}.</div>";
                    echo"<div>Product Quantity : {$productinfo['quantity']}</div>";
                    echo "<div>Price: ".($productinfo['price'] * $productinfo['quantity'])."</div>";
                    echo "</div>";
                    

                }
                echo "</div >";
                echo "</td></tr>";
                //var_dump($orderproducts[0]["image"]);//,$orderproducts['name'],$producInfo['price']*$orderinfo['quantity'] ,$orderinfo['quantity']);
            }
            ?>
        </table>
    </div>

    <div class="row">
        <div class="col-3 ml-50">
            <h3>Total EGP<?=$totalAmout?></h3> 
        </div>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item <?php if($page==1) echo "disabled";?>">
                <a class="page-link" href="<?= $_SERVER['PHP_SELF']. "?page=".($page-1)?>" ><</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">page <?=$page?>  of <?=$pageNumber?></a></li>
            <li class="page-item <?php if($page==$pageNumber) echo "disabled";?>">
                <a class="page-link" href="<?=$_SERVER['PHP_SELF']. "?page=".($page+1)?>">></a>
            </li>
        </ul>
    </nav>
</div>


<script>
        
        document.querySelectorAll('.toggle-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const row = btn.closest('.order-date-row').nextElementSibling;
                row.style.display = (row.style.display === 'none' || row.style.display === '') ? 'table-row' : 'none';
                btn.textContent = (btn.textContent === '+') ? '-' : '+';
            });
        });
    </script>
</body>