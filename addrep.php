<?php

require 'error.php';
require 'db.php';

if(!$conn){
    die('connection error' . $conn->connect_error);
}

if(isset($_POST['add'])){
    // echo'hello charles';
    $author=$_POST['author'];
    $title=$_POST['title'];
    $category=$_POST['category'];
    print_r($_FILES['rep']);
    // die();
    // echo $author;
    if(isset($_FILES['report']['name'])){
        // print_r($_FILES['report']);
        //filename
        $filename = $_FILES['report']['name'];
        //source
        $source = $_FILES['report']['tmp_name'];
         //destination
        $destination = "financerecords/".$filename;
        
        //upload
        $upload = move_uploaded_file($source, $destination);
        if(!$upload){
            $_SESSION['error'] = "file upload failed cannot proceed";
            header("location:addreport.php");
            die();
        }
    }else{
        $filename = '';
        $_SESSION['error'] = "file upload failed cannot proceed";
            header("location:addreport.php");
            die();
    }
    $sql = "insert into finrecords(author, title, category, report) values(?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $author, $title, $category, $filename);
    $stmt->execute();
    $_SESSION['error'] = "report upload sucessfull";
    header("location:addreport.php");
    
}
