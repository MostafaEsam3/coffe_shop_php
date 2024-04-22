<?php
// session_start();
include_once './includes/header.php';
include_once '../../controller/dashboard/AllOrder.php';
include_once '../../controller/dashboard/CheckOrder.php';


$checkOrder = new CheckOrder();
$orders = new AllOrder();


if($_SERVER['REQUEST_METHOD'] =='POST'){
    $data['order_id'] = intval($_POST['order_id']);
    $orders->updateStatus($data);
}
$allOrder = $orders->getAllOrderLatest();


getHeader('Orders');
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
                        <h4 class="mb-0"> All Orders</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="index.html" class="default-color">Home</a>
                            </li>
                            <li class="breadcrumb-item active">All Orders</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics mb-30">
                        <div class="card-body">
                            <div class="table-responsive mt-15">
                                <table class="table center-aligned-table mb-0">
                                    <thead>
                                        <tr class="text-dark">
                                            <th>Order Id</th>
                                            <th>userName</th>
                                            <th>Created At</th>
                                            <th>Created By</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($allOrder as $order) {
                                            $user = $checkOrder->getUserById($order['user_id']);
                                            $allOrderProduct = $checkOrder->getAllProductOfSpecificOrder($order['id']);
?>
                                        <tr>
                                            <td><?=$order['id']?></td>
                                            <td><?=$user['username']?></td>
                                            <td><?=$order['created_at']?></td>
                                            <td><?=$order['created_by']?></td>
                                            <td><?=$order['total']?></td>
                                            <td>
                                                <?=
                                                $orders->getStatusOfOrder($order['status']);
                                                ?>
                                            </td>
                                            <td>
                                            <button class="btn btn-outline-success btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg-<?=$order['id']?>">
                                                    View Order
                                            </button>

                                            <div class="modal fade bd-example-modal-lg-<?=$order['id']?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <div class="modal-title"><div class="mb-30">
                                                        <h2>All Product</h2>
                                                    </div>
                                                    </div>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <table class="table center-aligned-table mb-0">
                                <thead>
                                <tr class="text-dark">
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>quantity</th>
                                    <th>Price</th>
                                    <th>totalPerProduct</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($allOrderProduct as $orderProduct) {
                                            $product = $checkOrder->getProductById($orderProduct['product_id']);
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?=$orderProduct['product_id']?>
                                                    </td>
                                                    <td>
                                                        <img class="img-fluid" src="./ProductImage/<?=$product['image']?>"
                                                        alt="d">
                                                    </td>
                                                    <td><?=$product['name']?></td>
                                                    <td>
                                                        <?=$orderProduct['quantity']?>
                                                    </td>
                                                    <td><?=$product['price']?></td>
                                                    <td><?=$orderProduct['total']?></td>
                                                </tr>
                                            <?php
                                        }
                                        ?>


                                    </tbody>
                                                    </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            </td>
                                            <?php
                                            if($order['status'] < 3){
                                                ?>
                                                 <td>
                                                <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
                                                    <input type="hidden" value="<?=$order['id']?>" name="order_id" />
                                                    <button type="submit" class="btn btn-outline-warning btn-sm">
                                                        Change Status
                                                    </button>
                                                </form>
                                            </td>
                                                <?php
                                            }
                                            ?>

                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
include_once './includes/footer.php';
?>