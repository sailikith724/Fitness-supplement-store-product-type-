<?php
include("db.php");

$result = $conn->query("SELECT * FROM cart");

$total_amount = 0;

while($row = $result->fetch_assoc()){

    $total_amount += $row['total'];
}

$conn->query("DELETE FROM cart");
?>

<!DOCTYPE html>
<html>
<head>

<title>Order Success</title>

<link rel="stylesheet" href="style.css?v=10">

<style>

.success-box{

    width:500px;
    margin:100px auto;
    background:white;
    padding:40px;
    text-align:center;
    border-radius:10px;
    box-shadow:0 0 10px gray;
}

.success-box h1{

    color:green;
    font-size:40px;
}

.success-box p{

    font-size:22px;
}

.home-btn{

    display:inline-block;
    margin-top:20px;
    background:#16a34a;
    color:white;
    padding:15px 25px;
    text-decoration:none;
    border-radius:5px;
    font-size:20px;
}

</style>

</head>

<body>

<div class="success-box">

    <h1>
        Order Placed Successfully!
    </h1>

    <p>
        Your fitness supplement order has been submitted.
    </p>

    <p>

        <b>Total Amount Paid:</b>

        ₹<?php echo $total_amount; ?>

    </p>

    <a href="index.php" class="home-btn">

        Back To Home

    </a>

</div>

</body>
</html>