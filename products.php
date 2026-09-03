<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php
include("db.php");

$message = "";

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $total = $price * $quantity;

    $sql = "INSERT INTO cart(product_name, product_type, quantity, price, total)
            VALUES('$name', '$type', '$quantity', '$price', '$total')";

    if($conn->query($sql)){
        $message = "Product added to cart successfully!";
    }
}

$type = "";

$query = "SELECT * FROM products";

if(isset($_GET['type']) && $_GET['type'] != ""){
    $type = $_GET['type'];
    $query = "SELECT * FROM products WHERE type='$type'";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fitness Products</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="top-header">
    <h1>MS Fitness Store</h1>

    <form class="search-form" method="GET">
        <input type="text" name="search" placeholder="Type a product name, e.g. Biozyme">
    </form>

    <a href="cart.php" class="cart-icon">🛒 Cart</a>
</header>

<nav class="category-nav">
    <a href="products.php">All</a>
    <a href="products.php?type=Whey Protein">Whey Protein</a>
    <a href="products.php?type=Creatine">Creatine</a>
    <a href="products.php?type=Pre-Workout">Pre-Workout</a>
    <a href="products.php?type=Liquid Carnitine">Liquid Carnitine</a>
    <a href="products.php?type=Fish Oil">Fish Oil</a>
    <a href="products.php?type=Health Supplement">Health Supplement</a>
</nav>

<h2 class="section-title">In High Demand</h2>

<?php if($message != "") { ?>
    <div class="success"><?php echo $message; ?></div>
<?php } ?>

<div class="product-grid">

<?php while($row = $result->fetch_assoc()) { ?>

    <div class="shop-card">

        <div class="image-box">
            <img src="assets/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
        </div>

        <h3><?php echo $row['name']; ?></h3>

        <p class="weight"><?php echo $row['weight']; ?></p>

        <p>
            <span class="price">₹<?php echo $row['price']; ?></span>
            <span class="old-price">₹<?php echo $row['old_price']; ?></span>
            <span class="offer"><?php echo $row['offer']; ?></span>
        </p>

        <p class="code">Extra 5% Off | Code: BIOX</p>

        <form method="POST" action="products.php">

            <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
            <input type="hidden" name="type" value="<?php echo $row['type']; ?>">
            <input type="hidden" name="price" value="<?php echo $row['price']; ?>">

            <input type="number" name="quantity" value="1" min="1" class="qty">

            <input type="submit" name="add" value="ADD TO CART" class="add-btn">

        </form>

        <form method="POST" action="submit.php">
            <input type="submit" value="BUY NOW" class="buy-btn">
        </form>

    </div>

<?php } ?>

</div>

</body>
</html>
<form method="POST" action="products.php">

<input type="hidden" name="name"
value="<?php echo $row['name']; ?>">

<input type="hidden" name="type"
value="<?php echo $row['type']; ?>">

<input type="hidden" name="price"
value="<?php echo $row['price']; ?>">

<input type="number"
name="quantity"
value="1"
min="1">

<input type="submit"
name="add"
value="ADD TO CART"
class="add-btn">

</form>