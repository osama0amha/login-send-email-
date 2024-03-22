
<?php

 //print_r($_POST);
 require_once('../database/user.php');

    $email = '';
    $error= null;

   if(isset($_POST['submit'])){
     
     $email = $_POST['email'];
     $password = $_POST['password'];

     $user = new User();
     if($user->emailIsFound($email)){
        
        if($user->UserIsFound( $email,$password)){

             if(!$user->UserIsActive( $email,$password)){
   
                //  $error = 'Your Account was not active';
                header( 'Location: check_email.php?x= Active Your Acount & email='.$email);
             }
             else{
               $error = 'Your Account was found';
             }
        }
        else{
         $error = 'Wrong password';
        }
      }  
     else{
      $error = 'Your Account was not found';
     }   
   }

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>

    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
   
<div class="register_contianer">

     <div class="crrds pb-4">
         
           <?php
              if($error == 'Your Account was found'){
                  echo '<div class="alert alert-success text-center" role="alert">'
                         .$error.
                  '</div>';
              }
              elseif($error){
                echo '<div class="alert  alert-danger text-center" role="alert">'
                .$error.
               '</div>';
              }
           ?>

      <form  method="post">
        <h2 class="logo">Log in</h2>

        <input type="email" value = '<?php  echo $email?>'  name="email" id="email" placeholder="E-mail">  
        
        <input type="password" name="password" id="password" placeholder="Password">
        
        <input type="submit" class= "submit" name ="submit" value="log in">
          
      </form>

      <a href="register.php" class = " mt-2" style = " float: right; margin-right:30px">Creat account? Register</a>

      
   </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>