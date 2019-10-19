<?php
session_start();
if(!isset($_SESSION['userAccessInfo']) || (trim($_SESSION['userAccessInfo']) == '')){
	header('location:./');
	exit();
}
else{
	//echo "Hello ".$_SESSION['userAccessInfo'];
}

?>

<?php
  
    require_once 'dbconnect.php';// Connection of server

    //Collect Members info
    
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];

    //Query for Members information
    
    $retval = $conn->query( "INSERT INTO `users`(`name`, `email`, `password`,`phone`) VALUES ( '$name','$email','$password','$phone')");

    if(! $retval ) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Entered data successfully\n";
    mysqli_close($conn);
	header('location: index.php');
    exit();


?>