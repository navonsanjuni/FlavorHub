<?php
include 'connect.php';

if($_SERVER['REQUEST_METHOD']==='GET'){
$menu_id = $_GET['menu_id'];

$item_list = array();

$sql = "SELECT * FROM items WHERE menu='$menu_id'";
$result = mysqli_query($con,$sql);

if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        array_push($item_list,$row);
    }
}

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>item_page</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    padding: 20px;
    gap: 20px;
}

.item-card {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    width: 250px;
    text-align: center;
    transition: transform 0.2s ease-in-out;
}

.item-card:hover {
    transform: scale(1.05);
}

.item-card .image img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-bottom: 1px solid #ddd;
}

.item-card .name {
    font-size: 1.2em;
    font-weight: bold;
    color: #333;
    margin: 10px 0;
}

.item-card .desc {
    font-size: 0.9em;
    color: #777;
    padding: 0 10px;
    height: 60px;
    overflow: hidden;
    text-overflow: ellipsis;
}

.item-card .price {
    font-size: 1.1em;
    color: #28a745;
    font-weight: bold;
    margin: 10px 0;
}

.item-card .availability {
    font-size: 0.9em;
    color: #888;
    margin-bottom: 10px;
}

.item-card button {
    background-color: #007bff;
    color: white;
    padding: 10px;
    width: 80%;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-bottom: 15px;
}

.item-card button:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
<?php if(count($item_list)>0): ?>
<?php foreach($item_list as $item):?>
    <div class="item-card">
        <div class="image"><img src="<?php echo $item['image_link']  ?>" alt=""></div>
        <div class="name"><?php echo $item['name'] ?></div>
        <div class="desc"><?php  echo $item['description'] ?></div>
        <div class="price"><?php echo $item['price'] ?></div>
        <div class="avalabitlity"><?php echo $item['availability'] ?></div>
        <a href="cart/additem.php?item_id=<?php echo $item['item_id'] ?>"><button>ADD To Cart</button></a>
        
    </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No item To show</p>
<?php endif; ?>
</body>
</html>