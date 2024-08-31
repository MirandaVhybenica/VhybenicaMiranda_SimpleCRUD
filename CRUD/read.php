<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Products</title>
</head>
<body>
    <h1>List of Products</h1>
</body>
</html>

<?php
include 'connection.php';



if(isset($_GET['delete_id'])){
    $delete_id = $_GET['delete_id'];

    $sql = "DELETE FROM products WHERE id = $delete_id";

    if($conn->query($sql)===TRUE){
        $message = "<p style ='color: green;'>Record deleted</p>";
    }else{
        $message = "<p style = 'color: red;'>Error deleting record:".$conn->error."</p>";
    }
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if($result->num_rows>0){
    echo "<table border = '1'>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Created_at</th>
        <th>Updated_at</th>
        <th>Actions</th>
    </tr>";

    while($row = $result->fetch_assoc()){
        echo "
        <tr>
            <td>".$row['id']."</td>
            <td>".$row['name']."</td>
            <td>".$row['description']."</td>
            <td>".$row['price']."</td>
            <td>".$row['quantity']."</td>
            <td>".$row['created_at']."</td>
            <td>".$row['updated_at']."</td>

            <td>
                <a href ='update.php?id=".$row['id']."'>Edit</a>
                <a href ='read.php?delete_id=".$row['id']."'onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
            </td>
        </tr>";
    }
    echo "</table>";
}else{
    echo "0 results";
}
$conn->close();
?>
