<?php
class OrderProduct{

    public $con;
    private $connection = "";

    public function __construct()
    {
        $connection = new Connection();
        $this->con = $connection->con;
        $this->connection =$connection->con;
    }

    public function insertProductOrder($data){
        $stmt = $this->con->prepare('INSERT INTO order_products (order_id,product_id,quantity,total) VALUES (?,?,?,?)');
        $stmt->execute([
            $data['order_id'],
            $data['product_id'],
            $data['quantity'],
            $data['total_per_product']
        ]);
    }

    public function getAllProductOfSpecificOrder($orderId){
        $stmt = $this->con->prepare('SELECT * FROM order_products where order_id = ?');
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getOrderProduct($cond = 1)
    {
        $this->connection = $this->connection->query("select * from order_products where $cond");
        return $this->connection->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_Product_Order($orderid, $productid, $quantity, $total)
    {
       
        $sql = "INSERT INTO order_products (order_id, product_id, quantity, total) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
    
        $stmt->bindParam(1, $orderid, PDO::PARAM_INT);
        $stmt->bindParam(2, $productid, PDO::PARAM_INT);
        $stmt->bindParam(3, $quantity, PDO::PARAM_INT);
        $stmt->bindParam(4, $total, PDO::PARAM_STR);
    
        
        $stmt->execute();
    
        // Return the last inserted ID
    }


     function getOrderDetailes($id)
    {
        $stm=$this->con->prepare("SELECT pr.id,pr.name,pr.price,ord.quantity,pr.image FROM order_products as ord join products as pr on ord.product_id=pr.id and order_id =?");
        $stm->bindParam(1,$id,PDO::PARAM_INT);
        $stm->execute();
        $data=$stm->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

}
