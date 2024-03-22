
<?php
 //print_r($_POST);
 require_once('../database/user.php');
    
    $error= null;
    $name = '';
    $email = '';
    $user = new User;
   if(isset($_POST['submit'])){
     
     $name = $_POST['name'];
     $email = $_POST['email'];
     $password = $_POST['password'];
     $confirmPassword = $_POST['confirmPassword'];
      

     if($user->emailIsFound($email))
     {
      $error = 'This username is already in use.';
     }
     elseif (strlen($password) < 8) {
      $error = 'Password must be 8 characters or more';
     }
     elseif($password != $confirmPassword){
      $error = 'The two passwords entered do not match.';
     } 
     else{
          
      $user = new User();
      $code = mt_rand(99999,999999);

      $user->create($name ,$email,$password, $code);
      $message =  $user->SendCodeEmail($email , $code);
      header( 'Location: check_email.php?x= '.$message.'& email='.$email);
         
     }
    

    
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
            if($error){
                echo '<div class="alert alert-danger text-center" role="alert">'
                       .$error.
                '</div>';
            }
           ?>

      <form  method="post">
        <h2 class="logo">Register</h2>
      
        <input type="text" value = '<?php  echo $name?>' name="name" id="name"  placeholder="Full Name" require>
      
        <input type="email" value = '<?php echo $email?>'  name="email" id="email" placeholder="E-mail"  require>
        
        <input type="password" name="password" id="password" placeholder="Password"  require>
        
        <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password"  require>
  
        <input type="submit" class= "submit" name ="submit" value="Create">
          
      </form>

      <a href="login.php" class = " mt-2" style = " float: right; margin-right:30px">Have account? Sign in</a>

      
   </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>