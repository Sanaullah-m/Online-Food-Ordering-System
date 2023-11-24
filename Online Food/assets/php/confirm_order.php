<?php

session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){


    
// Retrieve the form data
$firstName = isset($_POST['first_name']) ? $_POST['first_name'] : '';
$lastName = isset($_POST['last_name']) ? $_POST['last_name'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$totalPrice = isset($_POST['total_price']) ? $_POST['total_price'] : 0;

// Prepare the product names
$productNames = "";
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $productName = $item['name'];
        $productNames .= $productName . ", ";
    }
    $productNames = rtrim($productNames, ", "); // Remove the trailing comma and space
}



// Connect to the database
$servername = "localhost";
$username = "root";
$dbpassword = ""; // Enter your MySQL password here
$dbname = "onlinefood";

$conn = new mysqli($servername, $username, $dbpassword, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO invoice (first_name, last_name, phone, Email, Address, bill, Products) VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param("sssssis", $firstName, $lastName, $phone, $email, $address, $totalPrice, $productNames);


if ($stmt->execute()) {
    // Sign-up successful
    // Perform any other actions or redirections
    unset($_SESSION['cart']);
    echo "<script>
    alert('ORDER CONFIRMED');
    window.location.href = '../../index.html';
    </script>";
    // header("location:../../index.html");

} else {
    // Sign-up failed
    // Display an error message or perform other actions
    echo "Error: " . $stmt->error;
}

// Close the database connection
$stmt->close();
$conn->close();

exit(); 
}
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <!--
      - custom css link 
    -->
    <link rel="stylesheet" href="../css/signup.css">
    <link rel="stylesheet" href="../css/foodhub.css">
    <link rel="stylesheet" href="../css/media_query.css">

    <!--
      - google font link
    -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Monoton&family=Rubik:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

</head>

<body>

    <body>
        <nav class="navbar">

            <div class="navbar-wrapper">

                <a href="../../index.html">
                    <img src="../images/logo.svg" alt="logo" width="130">
                </a>

            </div>
        </nav>

        <div class="registratoin-form">
            <form action="confirm_order.php" method="post">
                <div class="title">Enter Details</div>

                <div class="text-row">
                    <div class="input-box">
                        <input type="text" name="first_name" placeholder="Enter Your First Name"  required>
                        <div class="underline"></div>
                    </div>

                    <div class="input-box">
                        <input type="text" name="last_name" placeholder="Enter Your Last Name" required>
                        <div class="underline"></div>
                    </div>

                </div>

                <div class="text-row">
                    <div class="input-box">
                        <input type="text" name="phone" placeholder="Enter Your Phone No" required>
                        <div class="underline"></div>
                    </div>

                    <div class="input-box">
                        <input type="text" name="email" placeholder="Enter Your Email (optional)">
                        <div class="underline"></div>
                    </div>

                </div>

                <div class="text-row">
                    <div class="input-box">
                        <input type="text" name="address" placeholder="Enter Your Address" required>
                        <div class="underline"></div>
                    </div>


                </div>

                <?php
                    // Retrieve the total price from the URL query parameter
                    if (isset($_GET['total_price'])) {
                        $totalPrice = (int)$_GET['total_price'];
                    }
                ?>

                <div class="cart-total">
                    <p>Total: <?php echo $totalPrice; ?> Rs</p>
                </div>

                <input type="hidden" name="total_price" value="<?php echo $totalPrice; ?>">

                <div>
                    <button type="submit" class="confirm-btn">Confirm</button>
                </div>
            </form>

        </div>
    </body>
</body>

</html>