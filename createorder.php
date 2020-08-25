<?php


$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "cms";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
$user =$_POST['user'];
$pids =$_POST['pids'];
$quant= $_POST['q'];
$amt = $_POST['amt'];
$status = $_POST['status'];
  
    $sql = "INSERT INTO `orders`(`name`, `items`, `quantity`, `amount`, `status`) 
VALUES ('$user', '$pids' , '$quant', '$amt', '$status')";
$conn->query($sql);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


?>