<?php
// session_start();
include_once './includes/header.php';
include_once '../../controller/dashboard/CheckOrder.php';
include_once '../../controller/dashboard/ManualOrder.php';
$manualOrder = new ManualOrder();
$allUser = $manualOrder->getAllUser();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $checkOrder = new CheckOrder();
    if(!empty($_POST['dateFrom']) && !empty($_POST['dateTo']) && $_POST['user_id'] != null){
        $data['dateFrom'] = $_POST['dateFrom'];
        $data['dateTo'] = $_POST['dateTo'];
        $date['user_id'] = $_POST['user_id'];
    }elseif(!empty($_POST['dateFrom']) && !empty($_POST['dateTo'])){
        $data['dateFrom'] = $_POST['dateFrom'];
        $data['dateTo'] = $_POST['dateTo'];
    }else{
        $data['user_id'] = $_POST['user_id'];
    }
    $allOrder = $checkOrder->filterOrders($data);

}

getHeader('Checks Order');
include_once './includes/nav_bar.php';
?>
<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <?php include_once './includes/side_bar.php';?>
        <!-- Left Sidebar End-->

        <div class="content-wrapper">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-0"> Checks Order</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="index.html" class="default-color">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Checks Order</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics mb-30">
                        <div class="card-body">
                            <h5 class="card-title">Check</h5>
                            <form class="form-inline mt-5 mb-3" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                <div class="form-group mb-2">
                                    <input type="date" class="form-control" name="dateFrom">
                                </div>
                                <div class="form-group mx-sm-3 mb-2">
                                    <input type="date" class="form-control" name="dateTo">
                                </div>
                                <div class="form-group mx-sm-3 mb-2">
                                    <select class="custom-select js-example-basic-multiple" name="user_id" required>
                                        <option value="null" selected>all user</option>
                                        <?php
                                        foreach ($allUser as $user) {
                                        ?>
                                        <option value="<?=$user['id']?>">
                                            <?=$user['username']?>
                                        </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-warning mb-2">select</button>
                            </form>
                            <div class="col-xl-12 mb-30">
                                <div class="card card-statistics h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Order Search</h5>
                                        <div class="accordion">

                                            <?php
                                            if(!empty($allOrder)){
                                            foreach ($allOrder as $order) {
                                                $user = $checkOrder->getUserById($order['user_id']);
                                                $allOrderProduct = $checkOrder->getAllProductOfSpecificOrder($order['id']);

                                                ?>
                                            <div class="acd-group acd-active">
                                                <a href="#" class="acd-heading">
                                                    Order
                                                    <?= $user['username']?> -
                                                    <?=$order['total']?> $ -
                                                    <?=$order['created_at']?> by
                                                    <?=$order['created_by']?>
                                                </a>
                                                <div class="acd-des">
                                                    <div class="table-responsive mt-15">
                                                        <table class="table center-aligned-table mb-0">
                                                            <thead>
                                                                <tr class="text-dark">
                                                                    <th>#</th>
                                                                    <th>Product Name</th>
                                                                    <th>quantity</th>
                                                                    <th>Image</th>
                                                                    <th>Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                            foreach ($allOrderProduct as $orderProduct) {
                                                $product = $checkOrder->getProductById($orderProduct['product_id']);
                                                                ?>
                                                                <tr>
                                                                    <td><?=$orderProduct['product_id']?></td>
                                                                    <td><?=$product['name']?></td>
                                                                    <td><?=$orderProduct['quantity']?></td>
                                                                    <td>
                                                                        <img src="ProductImage/<?=$product['image']?>" width="50px" height="50"alt="..." />
                                                                    </td>
                                                                    <td><?=$orderProduct['total']?></td>
                                                                </tr>
                                                                <?php
                                            }
                                            ?>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                        }
                                        ?>




                                        </div>
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