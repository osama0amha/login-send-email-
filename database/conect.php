
<?php 

class Connect{

  public $connect;

  public function __construct(){

    $conn = new mysqli("localhost", "root", "","loginapp");

    $this->connect = $conn;
          // if ($this->connect->connect_error) {
          //   die("Connection failed: " . $this->connect->connect_error);
          // }
          // else{
          //     echo "Connected successfully";
          // }
  }
  

}

// $connn = new Connect();




    
 

?>