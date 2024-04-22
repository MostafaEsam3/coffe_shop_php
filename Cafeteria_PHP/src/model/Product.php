<?php
class Product
{
    public $con;
    private $connection = "";

    public function __construct()
    {
        $connect = new Connection();
        $this->con = $connect->con;
        $this->connection = $connect->con;

    }
        public function addProducts($productName, $price,$quantity,$image,$category_id){
            $stmt=$this->con->prepare('insert into products(name,price,quantity,image,category_id)  values(?,?,?,?,?)');
            $stmt->execute(
                [$productName, $price, $quantity, $image,$category_id]);
        }
        public function getProductForPagination($pageLimit,$offset){
            $data= $this->con->query("select* from products limit $pageLimit offset $offset");
            return $data->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getProduct($condition=1){
            $result=$this->con->query("select* from products where $condition");
            return $result->fetch(PDO::FETCH_ASSOC);
        }
        public function deleteProductById($id){
            $this->con->query("delete from products where id=$id");
        }
        public function updateProduct($values,$id){
            $this->con->query("update products set $values where id=$id");
        }
        public function getNumberOfProducts() {
            $result = $this->con->query("select count(id) from products");
            if ($result) {
                $count = $result->fetchColumn();
                return $count;
            } else {
                return false;
            }
        }


    public function getProductById($id)
    {
        $stmt = $this->con->prepare('SELECT * FROM products WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function decrementOfQuantity($data)
    {
        $stmt = $this->con->prepare('UPDATE products set quantity = ? where id = ?');
        $stmt->execute([$data['quantity'], $data['product_id']]);

    }

    public function getProducts($cond = 1)
    {
        $stm=$this->connection->query("SELECT * FROM products WHERE quantity > 0");
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectBasedCondetion($cond = '')
    {
        $statement = $this->connection->prepare("SELECT * FROM products WHERE $cond");
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getCategoryName($id)
    {
        $this->connection = $this->connection->query("select name from categories where id=$id");
        return $this->connection->fetch(PDO::FETCH_ASSOC);
    }


    public function search($word)
    {
        $this->connection = $this->connection->query("SELECT * FROM products WHERE name LIKE '%%$word%%'");
        return $this->connection->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllProduct()
    {
        $stmt = $this->con->prepare("SELECT * FROM products WHERE quantity > 0");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }





}
