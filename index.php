<?php

include 'bd/BD.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id'])){
        $query="select * from contacts where id=".$_GET['id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="select * from contacts";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $id=$_POST['id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $city=$_POST['city'];
    $country=$_POST['country'];
    $job=$_POST['job'];
    $query="insert into contacts(id, name, email, city, country, job ) values ('$id', '$name', '$email','$city','$country','$job')";
    $queryAutoIncrement="select MAX(id) as id from frameworks";
    $resultado=metodoPost($query, $queryAutoIncrement);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $id=$_POST['id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $city=$_POST['city'];
    $country=$_POST['country'];
    $job=$_POST['job'];
    $query="UPDATE contacts SET id='$id', name='$name', email='$email' , city='$city' , country='$country' , job='$job' WHERE id='$id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $id=$_GET['id'];
    $query="DELETE FROM frameworks WHERE id='$id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

header("HTTP/1.1 400 Bad Request");


?>