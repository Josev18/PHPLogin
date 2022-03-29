<?php
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    //Database Connection

    $con = new mysqli("localhost","root","root","phptest");
    if($con ->connect_error){
        die("Failed to connect : ".$con->connect_error);
    }
    else{
        $stmt = $con->prepare("select * from user where email = ?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows > 0){
            $data = $stmt_result->fetch_assoc();
            if($data['password'] === $password){
                header("location: ../html/index.html");
            }
            else{
                header("location: ../html/Login.html");
            }
        }
        else{
            header("location: ../html/Login.html");
        }
    }
?>
<?php include("top.php");?>
<?php include("bottom.php");?>