<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
</head>
<body>
    <h1>Create New Products</h1>
</body>
</html>

<?php
include 'connection.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price= $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO products(name, description, price, quantity, created_at, updated_at) VALUES('$name', '$description', '$price', '$quantity',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

    if($conn->query($sql)===TRUE){
        header('Location: read.php');
    }else{
        echo"Error: ".$sql."<br>".$conn->error;
    }
    $conn->close();
}
?>
<form method = "POST" action="create.php">
    Name: <input type="text" name="name"><br>
    Description: <input type="text" name="description"><br>
    Price: <input type="number" name="price"><br>
    Quantity: <input type="number" name="quantity"><br>
    <input type="submit" value="Add Product"><br>
</form>