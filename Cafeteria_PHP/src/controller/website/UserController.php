<?php
session_start();
require '../../model/User.php';
require_once '../../model/Connection.php';
require '../../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../../../vendor/phpmailer/phpmailer/src/Exception.php';

function validate($data)
{
$data=trim($data);
$data=addslashes($data);
$data=htmlspecialchars($data);
return $data;
}
$errors=[];


// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;



class UserController 
{
    private $flag;
    private $userModel;
    function __construct()
    {
        $this->userModel=new User;

    }
    function login($email,$pass)
    {
         $this->flag=$this->userModel->getUserData("email='{$email}'");
        $HashedPass=$this->flag['password'];
        
       
         if($this->flag && password_verify($pass,$HashedPass))
         {
               
                if($this->flag['is_admin']==1){

                    $_SESSION['admin']['id']=$this->flag['id'];
                    $_SESSION['admin']['username']=$this->flag['username'];
                    $_SESSION['admin']['email']=$this->flag['email'];
                    //render to admin panel
                    header("Location:../../views/dashboard/manualOrder.php");
                }
                else{
                    $_SESSION['username']=$this->flag['username'];
                    $_SESSION['user_id']=$this->flag['id'];
                    $_SESSION['email']=$this->flag['email'];
                    $_SESSION['room_id']=$this->flag['room_id'];
                    $_SESSION['user_image']=$this->flag['image'];
                    //render to index
                    header("Location:../../../index.php");
                }
                
            
         }
         else
         {
             header("Location:../../view/website/login.php?error=1");
         }
    }   
    function forget($email)
    {
        
        $this->flag=$this->userModel->getUserData("email='{$email}'");
       
        if($this->flag)
         {
                $mail=new PHPMailer\PHPMailer\PHPMailer();
                try{
                    $reset_password_token=md5(rand());
                    $receiver=$email;
                    //server setting
                    $mail->isSMTP();
                    $mail->Host='smtp.gmail.com';
                    $mail->SMTPAuth=true;
                    $mail->Username='sonbaty1937@gmail.com';
                    $mail->Password='ynnm msiu zzyq soae';
                    $mail->SMTPSecure='tls';
                    $mail->Port=587;
                    //Recipients
                    $mail->setFrom('sonbaty1937@gmail.com', 'Ahmed kamal');
                    $mail->addAddress($email);
                    //content
                    $mail->isHTML(true);
                    $mail->Subject="Password Reset Request";
                    $mail->Body = "You recently requested to reset your password your code = $reset_password_token <br> <a href='http://localhost/Cafeteria_php/src/view/website/code_reset_password.php'>Reset Password</a>";
                   
                    //sendmail
                    
                    $mail->send();
                    echo "Email sent successfully to $receiver";
                    echo $reset_password_token;
                     $this->userModel->UpdateUserData($reset_password_token,$email) ;
                    header("Location:../../view/website/code_reset_password.php");
                }catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
         }
         
        
    } 
    function reset($pass,$token)
    {   
        $hashedpass=password_hash($pass,PASSWORD_DEFAULT);;
         $this->userModel->reset_pass($hashedpass,$token);
        //var_dump( $this->userModel);
        $this->userModel->reset_token($token);

        header("Location:../../view/website/login.php");
    }
    function confirm_code($token)
    {
       
        $data=$this->userModel->getUserData("token='{$token}'");
        //var_dump($data);
        if(!$data)
        {
            header("Location:../../view/website/code_reset_password.php?error=wrong_code");
        }
        else
        {
            header("Location:../../view/website/reset.php?token=$token");
        }
    }
   
}
$userControler=new UserController;

if(isset($_POST['login']))
{
    // var_dump($_POST['password']);
    if(empty($_POST['email']))
    {   
        $errors['email']='email is required';
    }
    else if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
    {
        $errors['email']='invalid email';
        
    }
    if(empty($_POST['password']))
    {
        $errors['password']='password required';
        
    }
    if(count($errors)>0)
    {
        header("Location:../../view/website/login.php?errors=".json_encode($errors));
    }
    else
    {
       
        $errors=[];
        $userControler->login($_POST['email'],$_POST['password']);
    }
}
else if(isset($_POST['forget']))
{
    if(empty(validate($_POST['email'])))
    {
       
      header("Location:../../view/website/forget.php?error=1");
    }
    else if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
    {
     

         header("Location:../../view/website/forget.php?error=2");
    }
    
    else
    {   
        $userControler->forget($_POST['email']);
        
    }
   

}
else if(isset($_POST['Reset'])){
    if(empty($_POST['password']))
    {
        $errors['password']="password required";
    }
     if(empty($_POST['confirm_password']))
    {
        $errors['confirm_password']="confirm_password required";

    }
     if($_POST['password']!=$_POST['confirm_password'])
    {
        $errors['match']="password and confirm password donot match";

        
    }
    if(count($errors)>0)
    {

        header("Location:../../view/website/reset.php?errors=".json_encode($errors));
    }
    else
    {
        
        $userControler->reset($_POST['password'],$_POST['token']);
    }
}
else if($_POST['confirm'])
{
    $userControler->confirm_code($_POST['code']);
}
if(isset($_GET['logout']))
{
    session_destroy();
    header("Location:../../view/website/login.php");
    exit();
}
?>