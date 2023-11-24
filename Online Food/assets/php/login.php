<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validate the form data (optional)

    // Check if the username and password are correct
    if (($email === 'ADMIN'|| $email === 'admin') && $password === '123') {
        // Credentials are correct, do something (e.g., redirect to a dashboard page)
        header("Location: dashboard.php"); 
        exit();
    } else {
        // Invalid credentials
        $error = "Invalid username or password.";
        echo "<script>alert($error);</script>";
    }
}
?>


<!DOCTYPE html>
<html>
<title>Login</title>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!--
      - custom css link 
    -->
    <link rel="stylesheet" href="../css/login.css">
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

        </div>
    </nav>

    <div class="login-form">
        <form action="login.php" method="post">
            <div class="title">Login</div>
            <div class="input-box">
                <input type="text" name="email" placeholder="Enter Your Email" required>
                <div class="underline"></div>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Enter Your Password" required>
                <div class="underline"></div>
            </div>
            <div>
                <button type="submit" class="sign-in-btn">SIGN IN</button>
            </div>
        </form>
    </div>
</body>
</html>