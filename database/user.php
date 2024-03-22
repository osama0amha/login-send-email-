


<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once('conect.php');
require '../vendor/autoload.php';


   class User{


    public function create($name, $email, $password, $code){
       
        $connn = new Connect();

         $sql = "INSERT INTO `users` (name, email, password , code_verification,verification_code) 
               VALUES ('$name', '$email', '$password', $code,0)";

        if($connn->connect->query($sql))
        {
            echo'yes';
        }
        else{
            echo'no';
        }
          
          $connn->connect->close();
    }

     public function emailIsFound($email){

        $connn = new Connect();

        $sql ="SELECT email FROM `users` WHERE email = '$email'";
        $result   =$connn->connect->query($sql);
        $result->fetch_assoc();

       if($result->num_rows == 0){
        return false;
       }
       return true;  

    }

    public function UserIsFound($email,$password){

    $connn = new Connect();

    $sql ="SELECT * FROM `users` WHERE email = '$email' And password = '$password'";
    $result   =$connn->connect->query($sql);
    $result->fetch_assoc();

      if($result->num_rows == 0){
       return false;
      }
      return true;  
      }

    public function UserIsActive($email,$password){

    $connn = new Connect();

    $sql ="SELECT * FROM `users` WHERE email = '$email' And password = '$password' and 	verification_code = 1";
    $result   =$connn->connect->query($sql);
    $result->fetch_assoc();

    if($result->num_rows == 0){
     return false;
    }
    return true;  
    }

    public function SendCodeEmail($email, $code){

     $mail = new PHPMailer(true);

      try {
          //Server settings
          $mail->SMTPDebug = SMTP::DEBUG_SERVER;        
          $mail->isSMTP();                              
          $mail->Host       = 'smtp.gmail.com';         
          $mail->SMTPAuth   = true;                     
          $mail->Username   = 'amhaayoub19@gmail.com';   
          $mail->Password   = 'ogut duwp owoi senc';    
          $mail->SMTPSecure = 'ssl';            
          $mail->Port       = 465;                     
          //Recipients
          $mail->setFrom('amhaayoub19@gmail.com');   
          $mail->addAddress($email);       
          //Content
          $mail->isHTML(true);                                  
          $mail->Subject = 'Here is the subject';
          $mail->Body    = 'This is the HTML message body <b>'.$code.'</b>';

          $mail->send();
         return 'Message has been sent';
      } catch (Exception $e) {
           return "Message could not be sent";
      }
    }

    public function ActiveEmail($email,$code){
  
      $connn = new Connect();
  
      $sql ="SELECT * FROM `users` WHERE email = '$email' And code_verification = $code ";
      $result   =$connn->connect->query($sql);
      $result->fetch_assoc();
  
     if($result->num_rows == 0){
      return 'Your Account Is not active';
     }
     $sqll = "UPDATE `users` SET verification_code =1 WHERE email= '$email'";
     $connn->connect->query($sqll);
     return 'Your Account Is active';
    
     }

}

?>