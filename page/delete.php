<?php 

 
$servername  = 'localhost';
$username    = 'root';
$password    =  '';
$dbname      = 'cvautomation';
$conn = new mysqli($servername, $username, $password ,$dbname);
    // Check connection
if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
}

$id = $_POST['delete_id'];
$sql = "DELETE FROM  cvautomation WHERE id = '$id' ";
$query = mysqli_query($conn,$sql);