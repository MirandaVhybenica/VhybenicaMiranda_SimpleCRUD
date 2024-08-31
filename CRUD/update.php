<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit</title>
</head>
<body>
    <h1>Edit Products</h1>
</body>
</html>


<?php
include 'connection.php';

if (isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();

        ?>
        <form method ="POST" action="update.php?id=<?php echo $id; ?>">
            Name: <input type="text" name="name" value="<?php echo $row['name'];?>"><br>
            Description: <input type="text" name="description" value="<?php echo $row['description'];?>"><br>
            Price: <input type="number" name="price" value="<?php echo $row['price'];?>"><br>
            Quantity: <input type="number" name="quantity" value="<?php echo $row['quantity'];?>"><br>
            <input type="submit" value="Update Product">
        </form>
        <?php
    }else{
        echo"No product found";
    }
}else{
    echo "No ID provided";
}
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name=$_POST['name'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $quantity=$_POST['quantity'];

    $sql = "UPDATE products SET name = '$name',description ='$description',price = $price, quantity =$quantity, updated_at = CURRENT_TIMESTAMP WHERE id = $id";

    if($conn->query($sql)===TRUE){
        echo "Record updated succesfully";
        header('Location: read.php');
        exit();
    }else{
        echo "Error: ".$conn->error;
    }
    $conn->close();
}
?>