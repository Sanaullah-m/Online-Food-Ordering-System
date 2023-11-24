<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "onlinefood";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['product-name'];
    $productDescription = $_POST['product-description'];
    $productPrice = $_POST['product-price'];
    $productImage = $_FILES['product-image']['name'];
    $targetDir = "../images/"; // Set the target directory to save the uploaded images
    $targetFilePath = $targetDir . basename($productImage);

    // Prepare the SQL statement to insert the data into the database
    $stmt = $conn->prepare("INSERT INTO product (product_name, product_description, product_price, product_image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss",$productName, $productDescription, $productPrice, $productImage);

    // Execute the statement
    if ($stmt->execute()) {
        // Move the uploaded image file to a designated folder
        if (move_uploaded_file($_FILES['product-image']['tmp_name'], $targetFilePath)) {
            echo "Image uploaded successfully.";
        } else {
            echo "Error moving the uploaded image.";
        }
        
        header("location: products.php");
        echo "<script>alert('Form submitted successfully.');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Product Form</title>

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

<nav class="navbar">
        <div class="navbar-wrapper">
            <a href="../../index.html">
                <img src="../images/logo.svg" alt="logo" width="130">
            </a>

            <div class="navbar-btn-group">
                    <ul>
                    <li>
                        <button onclick="location.href='dashboard.php'" class="nav-link">Dashboard</button>
                    </li>
                </ul>
                <ul>
                    <li>
                        <button onclick="logout()" class="nav-link">Log Out</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script>
        function logout(){
            window.location.href = "login.php";
        }
    </script>

    <form action="products.php" method="POST" enctype="multipart/form-data" class="registratoin-form">

        <h2 class="title">Product Form</h2>

        <div class="input-box">
            
            <input type="text" name="product-name" placeholder="Product Name" required>
            <div class="underline"></div>
        </div>

        <div class="input-box">
            
            <input type="number" name="product-price" placeholder="Product Price" required>
            <div class="underline"></div>
        </div>

        <div class="input-box">
            <!-- <label>Product Description</label> -->
            <textarea name="product-description" placeholder="Description" required></textarea>
        </div>

        <div class="input-box">
            <label>Product Image</label>
            <input type="file" name="product-image" required>
        </div>

        <input type="submit" value="Submit" class="confirm-btn">
    </form>
</body>

</html>