<?php
include_once '../../model/Order.php';
include_once '../../model/User.php';
include_once '../../model/Product.php';
include_once '../../model/OrderProduct.php';
require_once '../../model/Connection.php';

class CheckOrder{

    public $userModel;
    public $productModel;

    public $orderModel;
    public $orderProductModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->productModel = new Product();

        $this->orderModel = new Order();
        $this->orderProductModel = new OrderProduct();
    }

    public function filterOrders($data){
        if(isset($data['dateFrom']) && isset($data['dateTo']) && isset($data['user_id'])){
            return $this->orderModel->filterOrderbyDateAndUser($data);
        }elseif(isset($data['dateFrom']) && isset($data['dateTo'])){
            return $this->orderModel->filterOrderbyDate($data);
        }else{
            return $this->orderModel->filterOrderbyUser($data);
        }
    }

    public function getUserById($userId){
        return $this->userModel->getUserById($userId);
    }

    public function getProductById($productId){
        return $this->productModel->getProductById($productId);
    }

    public function getAllProductOfSpecificOrder($orderId)
    {
        return $this->orderProductModel->getAllProductOfSpecificOrder($orderId);
    }
}