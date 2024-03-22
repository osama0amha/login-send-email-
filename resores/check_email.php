
<?php

 //print_r($_POST);
 require_once('../database/user.php');
    $err = '';
    $email = $_GET['email'];
    $error = $_GET['x'];
   if(isset($_POST['submit'])){
     
    $code = $_POST['code'];
    
    $user = new User();

    $error = $user->ActiveEmail($email,$code);
    
   }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">

    <title>Document</title>
</head>
<body>
   
<div class="register_contianer">

     <div class="crrds pb-4">
         
          <?php
            if($error == $_GET['x'] || $error == 'Your Account Is active'){
                echo '<div class="alert alert-success text-center" role="alert">'
                       .$error.
                '</div>';
            }
            else{
              echo '<div class="alert  alert-danger text-center" role="alert">'
              .$error.
             '</div>';
            }
           ?>

      <form  method="post">
        <h4>Enter your email code</h4>
      
        <input type="number" name="code" id="name"  placeholder="0-0-0-0-0" style = 'font-size:20px; text-align:center'>
      
        <input type="submit" class= "submit" name ="submit" value="Create">
          
      </form>
      <a href="login.php" class = " mt-2" style = " float: right; margin-right:30px">Sign in</a>

   </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>