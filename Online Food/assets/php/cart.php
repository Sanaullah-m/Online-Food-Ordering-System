<?php
// Start session
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the product name and price are provided
    if (isset($_POST['product_name']) && isset($_POST['product_price'])) {
        // Create an array to store the cart items in the session
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Add the selected product to the cart
        $productName = $_POST['product_name'];
        $productPrice = $_POST['product_price'];

        $item = array(
            'name' => $productName,
            'price' => $productPrice
        );

        $_SESSION['cart'][] = $item;
    } elseif (isset($_POST['delete_item'])) {
        // Delete item from cart
        $index = $_POST['delete_item'];
        if (isset($_SESSION['cart'][$index])) {
            unset($_SESSION['cart'][$index]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<title>Cart</title>

<head>
    <link rel="stylesheet" href="../css/foodhub.css">
    <link rel="stylesheet" href="../css/media_query.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Monoton&family=Rubik:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>

<body>

    <nav class="navbar">
        <div class="navbar-wrapper">
            <a href="../../index.html">
                <img src="../images/logo.svg" alt="logo" width="130">
            </a>

            <div class="navbar-btn-group">


                <ul>
                    <li>
                        <button onclick="location.href='menu.php'" class="nav-link">Menu</button>
                    </li>
                </ul>

                <button onclick="location.href='cart.php'" class="shopping-cart-btn">
                    <img src="../images/cart.svg" alt="shopping cart icon" width="18">
                    <span class="count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
                </button>
            </div>
        </div>
    </nav>

    <div class="empty-container"> </div>
    <div class="empty-container"> </div>

    <section class="cart" id="cart">
        <h2 class="section-title">Your Cart</h2>

        <?php
        if (!empty($_SESSION['cart'])) {
            $totalPrice = 0;
            foreach ($_SESSION['cart'] as $index => $item) {
                $productName = $item['name'];
                $productPrice = $item['price'];
                $totalPrice += $productPrice;
                ?>

                
        <div class="cart-item">
            <p class="product-name"><?php echo $productName; ?></p>
            <p class="product-price"><?php echo $productPrice; ?></p>
            <p><style>
                p{
                    font-size:22px;
                    
                    margin-left: 10px;
                }
            </style>Rs</p>
            <form action="cart.php" method="post">
                <input type="hidden" name="delete_item" value="<?php echo $index; ?>">
                <button type="submit" class="delete-btn"><style>
                    .delete-btn{
                        font-size: 18px;
                        font-weight: bold;
                        margin-left: 30px;
                        margin-right: 10px;
                        color: red;

                        font-family: 
                    }
                </style>Delete</button>
            </form>
        </div>
        <?php
            }
            ?>

<div class="bottom-nav">
    <style>
        .bottom-nav {
            background-color: #f1f2f4;
            overflow: hidden;
            position: fixed;
            bottom: 0;
            width: 100%;
            display: flex;
        }

        .cart-total {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 10px;
            font-weight: 500
        }

        .right-element {
            margin-left: auto;
            padding: 10px;
            margin-right: 130px;
        }
    </style>

    <div class="cart-total">
        <p>Total: <?php echo $totalPrice; ?> Rs</p>
    </div>


    <button onclick="location.href='confirm_order.php? total_price=<?php echo $totalPrice; ?>'" class="right-element btn btn-primary">CHECKOUT</button>

</div>

        

        <?php
        } else {
            echo "<p>Your cart is empty.</p>";
        }
        ?>
    </section>


    

</body>

</html>
