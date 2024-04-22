<?php
class User {

    public $con;
    private $data;

    public function __construct(){
        $connection = new Connection();
        $this->con = $connection->con;
    }

    public function getAllUserToMakeOrderByAdmin()
    {
        $stmt = $this->con->prepare('SELECT id,username FROM users WHERE is_admin = ?');
        $stmt->execute([false]);
        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($userId){
        $stmt = $this->con->prepare('SELECT * FROM users where id = ?');
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function add_user($username, $email,$room_id, $passwordHash, $image){
        $stmt=$this->con->prepare('insert into users(username,email,room_id,password,image)  values(?,?,?,?,?)');
        $stmt->execute(
            [$username, $email,$room_id, $passwordHash, $image]);

    }


    public function getUsersForPagination($pageLimit,$offset){
        $data = $this->con->query("select id, username, email, is_admin, room_id, image, created_at from users limit $pageLimit offset $offset");
        if($data){
            return $data->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return 0;
        }
    }
    public function get_user($id){
        $result=$this->con->query("select* from users  where id=$id");
    return $result->fetch(PDO::FETCH_ASSOC);
    }
    public function getUserByEmail($email){
        $result=$this->con->query("select* from users  where $email");
    return $result->fetch(PDO::FETCH_ASSOC);
    }
    public function delete_user($id){
        $this->con->query("delete from users where id=$id");
    }
    public function updateUser($values,$id){
        $this->con->query("update users set $values where id= $id");
    }

    public function getNumberOfUsers() {
        $result = $this->con->query("select count(id) from users");
        if ($result) {
            $count = $result->fetchColumn();
            return $count;
        }
        else {

            return false;
        }

    }

       function __set($key,$value)
    {
        $this->$key=$value;
    }
    function  getUserData($cond=1)
    {
        try{

            $stm=$this->con->query("select * from users where $cond");
            $this->data=$stm->fetch(PDO::FETCH_ASSOC);
            // $stm->execute([$cond]);
            return $this->data;
        }catch(PDOException $e)
        {
            echo "Error retrieving user data: ".$e->getMessage();

        }
        
    }
    
    function UpdateUserData($values,$email)
    {
       try{
         $sql=  "UPDATE users SET token = ? WHERE email=?";
        //$sql="INSERT INTO users (token) VALUES ('{$values}')  WHERE $cond";
         $stm = $this->con->prepare($sql);
         $stm->execute([$values,$email]);
       }catch(PDOException $e)
       {
        echo "Error updating user data: " . $e->getMessage();
       }
    }
    function reset_pass($value,$token)
    {

       try{
         $sql="update users set password= ? where token=?";
        $stm = $this->con->prepare($sql);
        $stm->execute([$value,$token]);
        header("Location:../../view/login.php");
       }catch(PDOException $e)
       {
        echo "Error resetting password: " . $e->getMessage();
       }
    }
    function reset_token($token)
    {
        try{
            $sql="update users set token='' where token =?";
           $stm = $this->con->prepare($sql);
           $stm->execute([$token]);
           
          }catch(PDOException $e)
          {
           echo "Error resetting token: " . $e->getMessage();
          }
    }
}
