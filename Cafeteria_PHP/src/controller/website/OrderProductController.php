<?php
require '../../model/OrderProduct.php';
require_once '../../model/Connection.php';

class OrderProductController{
    private $Model;
    function __construct()
    {
        $this->Model=new OrderProduct;
    }

    function getDetailes($id)
    {
        return $this->Model->getOrderDetailes($id);
        
    }
}
?>