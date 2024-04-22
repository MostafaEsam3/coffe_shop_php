<?php
include_once '../../model/Order.php';
include_once '../../model/User.php';
include_once '../../model/Product.php';
include_once '../../model/OrderProduct.php';


require_once '../../model/Connection.php';

class AllOrder{

    public $userModel;
    public $productModel;
    public $orderModel;
    public $orderProductModel;
    public $manualOrder;
    public function __construct()
    {
        $this->userModel = new User();
        $this->productModel = new Product();
        $this->orderModel = new Order();
        $this->orderProductModel = new OrderProduct();
    }


    public function getAllOrderLatest(){
        return $this->orderModel->getAllOrderLatest();
    }

    public function updateStatus($data){
        $order = $this->orderModel->getOrderById($data['order_id']);
        if($order){
            $data['status'] = intval($order['status'])+1;
            if($data['status'] == $this->orderModel::DONE){
                $orderProducts = $this->orderProductModel->getAllProductOfSpecificOrder($order['id']);
                foreach ($orderProducts as $orderProduct) {
                    $product = $this->productModel->getProductById($orderProduct['product_id']);
                    $data['quantity'] = $product['quantity'] - $orderProduct['quantity'];
                    $data['product_id'] = $product['id'];
                    $this->productModel->decrementOfQuantity($data);
                }
            }
            $this->orderModel->updateStatusOfOrder($data);
        }
    }

    public function getStatusOfOrder($status){
        $label = '';
        switch ($status) {
            case '1':
                $label = '<label class="badge badge-warning">Processing</label>';
                break;
            case '2':
                $label =  '<label class="badge badge-primary">Out of Delivery</label>';
                break;
            case '3':
                $label = '<label class="badge badge-success">Done</label>';
                break;
            case '4':
                $label =  '<label class="badge badge-danger">Cancelled</label>';
                break;
            default:
                # code...
                break;
        }
        return $label;
    }

}