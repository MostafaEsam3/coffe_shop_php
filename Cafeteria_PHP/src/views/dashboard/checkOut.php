<?php
// session_start();
include_once './includes/header.php';
if(isset($_SESSION['user_id'])){
    include_once '../../controller/dashboard/ManualOrder.php';
    $manualOrder = new ManualOrder();

    if(isset($_POST['trash'])){
        $product_id = intval($_POST['product_id']);
        unset($_SESSION['cart'][$_SESSION['user_id']][$product_id]);
    }
    $allCartInfo = $_SESSION['cart'][$_SESSION['user_id']];
    // $allRoom = $manualOrder->getAllRoom();

    if(isset($_POST['order'])){
        $userInfo = $manualOrder->getUserById($_SESSION['user_id']);
        //insert in Order table
        $data['user_id'] = $_SESSION['user_id'];
        $data['total_per_order'] = $_POST['final_total'];
        $data['status'] = $manualOrder->orderModel::PROCESSING;
        $data['notes'] = $_POST['notes'];
        $data['room_id'] = $userInfo['room_id'];
        $data['created_by'] = 'admin';
        //check if quantity is less than stock
        $error = $manualOrder->checkQuantityOfProductBeforePlaceOrder();
        if(!$error){
            $orderId = $manualOrder->storeOrder($data);
            //get lastInsertId and insert in order product from session
            foreach ($allCartInfo as $productId => $cartInfo) {
                $data['order_id'] = $orderId;
                $data['product_id'] = $productId;
                $data['quantity'] = $cartInfo['quantity'];
                $data['total_per_product'] = $cartInfo['totalPerProduct'];
                $manualOrder->insertProductOrder($data);
            }
            unset($_SESSION['cart']);
            $_SESSION['makeOrder'] = 'The Order created Successfully';
            header("Location: manualOrder.php");
        }
    }

    getHeader('CheckOut Shipping');
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
                        <h4 class="mb-0">CheckOut Shipping</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="index.html" class="default-color">Home</a>
                            </li>
                            <li class="breadcrumb-item active">CheckOut Shipping</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics mb-30">
                        <div class="card-body">
                            <h5 class="text-uppercase mb-4">Cart Info</h5>
                            <?php
                            if(isset($_SESSION['error'])){
                                ?>
                                <p class="alert alert-danger"><?=$_SESSION['error']?></p>
                                <?php
                            }
                            ?>
                            <div class="table-responsive mb-4">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="border-0" scope="col"> <strong
                                                    class="text-small text-uppercase">Product</strong>
                                            </th>
                                            <th class="border-0" scope="col"> <strong
                                                    class="text-small text-uppercase">Price</strong></th>
                                            <th class="border-0" scope="col"> <strong
                                                    class="text-small text-uppercase">Quantity</strong></th>
                                            <th class="border-0" scope="col"> <strong
                                                    class="text-small text-uppercase">Total</strong></th>
                                            <th class="border-0" scope="col"> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $finalTotal = 0;
                                            foreach ($allCartInfo as $product_id => $cartInfo) {
                                                $finalTotal += $cartInfo['totalPerProduct'];
                                                $product = $manualOrder->getProductById($product_id);
                                        ?>
                                        <tr>
                                            <th class="pl-0 border-0" scope="row">
                                                <div class="media align-items-center"><a
                                                        class="reset-anchor d-block animsition-link"
                                                        href="javascript:void(0);">
                                                        <img src="./ProductImage/<?=$product['image']?>"
                                                        alt="..." width="70" /></a>
                                                    <div class="media-body ml-3">
                                                        <strong class="h6">
                                                            <a class="reset-anchor animsition-link">
                                                                <?=
                                                                    $product['name']
                                                                ?>
                                                            </a>
                                                        </strong>
                                                    </div>
                                                </div>
                                            </th>
                                            <td class="align-middle border-0">
                                                <p class="mb-0 small">
                                                    <?= $product['price']?>
                                                </p>
                                            </td>
                                            <td class="align-middle border-0">
                                                <input type="number" min="1" step="1"
                                                    value="<?= $cartInfo['quantity'] ?>" class="small
                                                            text-uppercase text-gray
                                                            headings-font-family" />
                                            </td>
                                            <td class="align-middle border-0">
                                                <p class="mb-0 small">
                                                    <?= $cartInfo['totalPerProduct'];?> </p>
                                            </td>
                                            <td class="align-middle border-0">
                                                <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
                                                    <input type="hidden" name="product_id" value="<?=$product_id?>" />
                                                    <button name="trash" type="submit" class="reset-anchor">
                                                        <i class="fa fa-trash small text-muted"></i>
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="card-body">
                            <h5 class="text-uppercase mb-4">Cart total</h5>
                            <h6><?=$finalTotal?></h6>
                        </div>
                        <div class="card-body">
                            <h2 class="h5 text-uppercase mb-4">Billing details</h2>
                            <div class="row">
                                <div class="col-lg-8">
                                    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                                        <input type="hidden" name="final_total" value="<?=$finalTotal?>"/>
                                        <div class="row">
                                            <div class="col-lg-12 form-group">
                                                <label class="text-small text-uppercase" for="firstName">Notes</label>
                                                <textarea class="form-control form-control-lg" id="firstName"
                                                    name="notes" type="text"></textarea>
                                            </div>
                                            <div class="col-lg-12 form-group">
                                                <button name="order" class="btn btn-dark" type="submit">
                                                    Place order
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
    include_once './includes/footer.php';
}else{
    header('Location: manualOrder.php');
}

?>