<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php

// session_start();

require "./src/model/Product.php";
require "./src/model/Order.php";
require "./src/model/OrderProduct.php";
require "./src/model/Room.php";

require "./src/model/Connection.php";


// require "../../model/Order.php";
// require "../../model/OrderProduct.php";
// require "../../model/Product.php";
// require "../../model/Room.php";



  // THIS defoult and we will remove when ahmed combine with me 

if (!isset($_SESSION['user_id'])) {
    header('Location:src/view/website/login.php');
}

$product = new Product();
$data = $product->getProducts();


if (isset($_POST['search'])) {

    $product = new Product();
    $data = $product->search($_POST['dataSearch']);

} else if (isset($_POST[''])) {
    $data = $product->getProducts();
}




if (isset($_GET['id'])) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    } else {
        if (!in_array($_GET['id'], $_SESSION['cart'])) {
            $_SESSION['cart'][] = $_GET['id'];
        }
    }
}


function clear_cart()
{
    $_SESSION['cart'] = array();
}


if (isset($_POST['confirm_order'])) {
    if (isset($_POST['productName']) && ($_POST['productQantity']) && $_SESSION['cart']) {

        $productName = $_POST['productName'];
        $productPrice = $_POST['productPrice'];
        $productQuantity = $_POST['productQantity'];
        $productid = $_SESSION['cart'];
        $indexArray = array_values($productid); // i use this to can access by index not by key Gamila ya darsh

        //========================================================================================================
        $user_id = $_SESSION['user_id']; // i must recive this from Ahmed kamal
        $total = $_POST['total'];
        $status = 1;
        $notes = $_POST['notes'];

        $room_id = new Room();
        $room = $room_id->getRoom($_POST['room']);
        $room = (int) $room['id'];

        $order = new Order();
        $result = $order->insertOrder($user_id, $total, $status, $notes, $room);
        // $result->execute();

        $result = $order->getOrderid("user_id=" . $_SESSION['user_id']);
        $result = (int) $result['id'];


        // $orderOfUser = $order->getOrder("user_id={$_SESSION['user_id']}");
        //========================================================================================================

        $productOrder = new OrderProduct();
        for ($i = 0; $i < count($productName); $i++) {
            $productOrder->insert_Product_Order($result, $indexArray[$i], $productQuantity[$i], $productPrice[$i]);
        }
        ;
    }

    clear_cart();
    header("Location:index.php");
}
?>