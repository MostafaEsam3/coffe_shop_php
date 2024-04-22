<?php
class Category {
    public $con;
    public function __construct(){
        $connection = new Connection();
        $this->con = $connection->con;
    }

    public function get_category($values=1){
        $cat = $this->con->query("select* from categories where $values");
        return $cat->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCategoryById($id)
    {
        $cat = $this->con->query("select* from categories where id= $id");
        return $cat->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addCategory($categoryName){
        $cat=$this->con->prepare('insert into categories(name)  values(?)');
        $cat->execute([$categoryName]);
    
    }
    
    function add_room($cols,$values){
        $this->con->query("insert into rooms($cols)  values($values)");
        
    
    }
function deleteCategoryById($id){
    
        $this->con->query("delete from categories where id= $id");
    
}
public function updateCategory($values,$id){
    $this->con->query("update categories set $values where  id= $id");

}
function getCategoriesPagination($pageLimit,$offset){
    $data= $this->con->query("select* from categories limit $pageLimit offset $offset");
    return $data->fetchAll(PDO::FETCH_ASSOC);
}
function getNumberOfCategories() {
    $result = $this->con->query("select count(id) from categories");
    
    if ($result) {
        
        $count = $result->fetchColumn();
        return $count;
    } else {
        return false;
    }
}
}

?>