<?php
// session_start();
include_once './includes/header.php';
include_once '../../controller/dashboard/ManualOrder.php';
$manualOrder = new ManualOrder();
$allProduct = $manualOrder->getAllProduct();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $data['product_id'] = intval($_POST['product_id']);
    $data['quantity']  = intval($_POST['quantity']);
    $data['price']  = intval($_POST['price']);
    $data['product_total'] = $data['price'] * $data['quantity'];
    $data['user_id'] = $_SESSION['user_id'];

    $manualOrder->storeInfoCartInSession($data);

    $_SESSION['success'] = 'Product Added Successfully';
}

getHeader('Shopping Order');
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
                        <h4 class="mb-0"> Shopping Order</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="index.html" class="default-color">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Shopping Order</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics mb-30">
                        <div class="card-body">
                            <div>
                                <a class="btn btn-success" href="./checkOut.php">Go Check Out Details</a>
                            </div>
                            <div class="col-sm-12">
                                <h4 class="m-3 text-center">All Products Available
                                </h4>
                                <?php
                                    if(!empty($_SESSION['success'])){
                                        ?>
                                        <p class="alert alert-success">
                                            <?=$_SESSION['success']?>
                                        </p>
                                        <?php
                                        unset($_SESSION['success']);
                                    }elseif(!empty($_SESSION['errors'])){
                                        ?>
                                        <p class="alert alert-danger">
                                        <?=$_SESSION['errors']?>
                                        </p>
                                        <?php
                                        unset($_SESSION['errors']);
                                    }
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                foreach ($allProduct as $product) {
                                    ?>
                                    <div class="col-lg-3 col-sm-6">
                                    <div class="product text-center">
                                        <div class="mb-3 position-relative">
                                            <div class="badge text-white badge-"></div>
                                            <a class="d-block" href="#">
                                                <img class="img-fluid" src="./ProductImage/<?=$product['image']?>"
                                                    alt="d">
                                            </a>
                                            <div class="product-overlay mt-2">
                                                <li class="list-inline-item m-0 p-0">
                                                <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                                    <input type="hidden" name="product_id"
                                                    value="<?=$product['id']?>">
                                                    <input type="hidden" name="price"
                                                    value="<?=$product['price']?>">
                                                    <?php
                                                    if(isset($_SESSION['cart'][$_SESSION['user_id']][$product['id']])){
                                                        ?>
                                                          <input type="number" min="1" step="1" value="<?=$_SESSION['cart'][$_SESSION['user_id']][$product['id']]['quantity']?>" name="quantity" />
                                                        <?php
                                                    }else{
                                                        ?>
                                                          <input type="number" min="1" step="1" value="1" name="quantity" />
                                                        <?php
                                                    }
                                                    ?>

                                                    <button type="submit" class="btn btn-sm btn-dark mt-2">
                                                            Add to cart
                                                    </button>
                                                </form>
                                                </li>
                                            </div>
                                        </div>
                                        <h6> <a class="reset-anchor" href="#"><?=$product['name']?></a></h6>
                                        <p class="text-muted">
                                            <?=$product['price']?> $
                                        </p>
                                    </div>
                                </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
include_once './includes/footer.php';
?>