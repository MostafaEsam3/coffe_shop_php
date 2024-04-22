<?php
// require("./Connection.php");
class Product {
    private $host="localhost";
    private $dbname="cofephp";
    private $user="root";
    private $password="";
    private $connection;
    
      function __construct(){
        $this->connection=new pdo("mysql:host=$this->host;dbname=$this->dbname",$this->user,$this->password);
    
    }

function get_connection()
{
    return $this->connection;
}
function addProducts($productName, $price,$quantity,$image,$category_id){
    $stmt=$this->connection->prepare('insert into products(name,price,quantity,image,category_id)  values(?,?,?,?,?)');
    $stmt->execute(
        [$productName, $price, $quantity, $image,$category_id]);

}


function getProductForPagination($pageLimit,$offset){
    $data= $this->connection->query("select* from products limit $pageLimit offset $offset");
    return $data->fetchAll(PDO::FETCH_ASSOC);
}
function getProduct($condition=1){
    $result=$this->connection->query("select* from products where $condition");
return $result->fetch(PDO::FETCH_ASSOC);
}
function deleteProductById($id){
    $this->connection->query("delete from products where id=$id");
}
function updateProduct($values,$id){
    $this->connection->query("update products set $values where id=$id");
}

function getNumberOfProducts() {
    $result = $this->connection->query("select count(id) from products");
    
    if ($result) {
        
        $count = $result->fetchColumn();
        return $count;
    } else {
        
        return false;
    }
}
}

?>
}
?>