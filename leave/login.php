<?php
require_once 'dbconnect.php';


$name=$_POST["name"];//receiving name field value in $name variable  
$password=$_POST["password"];//receiving password field value in $password variable  

$sql = "SELECT * FROM users where  name='$name' and password='$password'";
$result = $conn->query($sql);

$ret=$result->num_rows;

$conn->close();
if ($ret > 0) {
    session_start();
        $user = mysqli_fetch_assoc($result);

        $_SESSION['userAccessInfo'] = $user['name'];
        $_SESSION['userAccessLevel'] = $user['id'];
        $_SESSION['userAccessLevelType'] = $user['type'];
        if($_SESSION['userAccessLevelType'] == "admin"){
        	header('Location: admin_panel.php') ;
        }
        else{
        	header('Location: home.php') ;	
        }
        
        exit();
    }else{  
        header('Location:./') ;
        exit();
    }  




?> 