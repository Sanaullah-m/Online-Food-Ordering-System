<?php
// Start session
session_start();

// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "onlinefood";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the database
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<title>Menu</title>

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

            <div class="navbar-btn">
                <button onclick="location.href='cart.php'" class="shopping-cart-btn">
                    <img src="../images/cart.svg" alt="shopping cart icon" width="18">
                    <span class="count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
                </button>
            </div>
        </div>
    </nav>

    <section class="product" id="menu">

        <div class="empty-container"> </div>

        <h2 class="section-title">Most popular dishes</h2>

        <div class="products-grid">

            <?php
            if ($result->num_rows > 0) {
                // Loop through each row and generate product cards
                while ($row = $result->fetch_assoc()) {
                    $productName = $row['product_name'];
                    $productPrice = $row['product_price'];
                    $productDescription = $row['product_description'];
                    $productImage = $row['product_image'];
                    ?>

            <a href="#">
                <div class="product-card">
                    <div class="img-box">
                        <img src="../images/<?php echo $productImage; ?>" alt="product image" class="product-img"
                            width="200" loading="lazy">
                    </div>
                    <div class="product-content">
                        <div class="wrapper">
                            <h3 class="product-name">
                                <?php echo $productName; ?>
                            </h3>
                            <p class="product-price">
                                <?php echo $productPrice; ?>
                                <span class="small">Rs</span>
                            </p>
                        </div>
                        <p class="product-text">
                            <?php echo $productDescription; ?>
                        </p>
                    </div>
                    <div class="product-cart">
                        <form action="cart.php" method="post">
                            <input type="hidden" name="product_name" value="<?php echo $productName; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $productPrice; ?>">
                            <button type="submit" class="shopping-cart-btn" onclick="alert('Product added to cart');">
                                <img src="../images/cart.svg" alt="shopping cart icon" width="18">
                            </button>
                        </form>
                    </div>
                </div>
            </a>

            <?php
                }
            } else {
                echo "No products found.";
            }

            $conn->close();
            ?>

        </div>

    </section>

</body>

</html>
