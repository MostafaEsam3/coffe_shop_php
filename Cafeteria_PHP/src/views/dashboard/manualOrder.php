<?php
// session_start();
include_once './includes/header.php';
include_once '../../controller/dashboard/ManualOrder.php';
$manualOrder = new ManualOrder();
$allUser = $manualOrder->getAllUser();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = intval($_POST['user_id']);
    //store userId in Database
    if (is_int($userId)) {
        $_SESSION['user_id'] = $userId;
        header('Location: shoppingOrder.php');
    }

}



getHeader('Manual Order');
include_once './includes/nav_bar.php';
?>
<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <?php include_once './includes/side_bar.php'; ?>
        <!-- Left Sidebar End-->

        <div class="content-wrapper">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-0"> Manual Order</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="index.html" class="default-color">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Manual Order</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics mb-30">
                        <div class="card-body">
                            <h5 class="card-title">Make Order</h5>
                            <?php
                            if (isset($_SESSION['makeOrder'])) {
                                ?>
                                <p class="alert alert-success">
                                    <?= $_SESSION['makeOrder'] ?>
                                </p>
                                <?php
                                unset($_SESSION['makeOrder']);
                            }
                            ?>
                            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                                <div class="form-group">
                                    <label class="form-label">
                                        Choose User Name to Make Order
                                    </label>
                                    <select class="custom-select js-example-basic-multiple" name="user_id" required>
                                        <option selected disabled>
                                            Choose User Name
                                        </option>
                                        <?php
                                        foreach ($allUser as $user) {
                                            ?>
                                            <option value="<?= $user['id'] ?>">
                                                <?= $user['username'] ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Go</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include_once './includes/footer.php';
            ?>