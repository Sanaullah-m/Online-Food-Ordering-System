<?php
// Step 1: Connect to the database
$servername = "localhost";
$username = "root";
$dbpassword = ""; // Enter your MySQL password here
$dbname = "onlinefood";

$conn = new mysqli($servername, $username, $dbpassword, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Handle record deletion
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    //Validate the ID (e.g., check if it's a positive integer)
    if (!is_numeric($id) || $id <= 0) {
        die("Invalid ID");
    }

    $query = "DELETE FROM INVOICE WHERE ID = $id";
    $conn->query($query);

    //Redirect back to the dashboard or perform any other necessary actions
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Fetch and display the data in a table
$sql = "SELECT * FROM INVOICE";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
       .record {
  background: hsla(0, 0%, 100%, 0.9);
  box-shadow: -1px 1px 3px 0 hsla(0, 0%, 0%, 0.05);
  backdrop-filter: blur(10px);
  transition: 0.5s ease-in-out;
  width:98%;  
  margin-left:10px; 
  justify-content: center;
   
}

.record th,
.record td {
  background: var(--cultured);
  font-weight: 500;
  padding: 10px;
}

.record th {
  font-size: var(--fs-3);
}

.record td {
  font-size: var(--fs-4);
  text-align: center;
  color:var(--space-cadet);

}

    </style>

     <!--
      - custom css link 
    -->
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

        <style>
        .dashboard-container {
            background-color: #f1f2f4;
            overflow: hidden;
            width: 100%;
            display: flex;
            margin-bottom: 20px;
            padding: 10px 20px;   
        }

        .dashboard-container .nav-link{
            
            margin-left: auto;
            padding: 10px;
            margin-right: 130px;
            font-size: 20px;
            font-weight: 500;
        }
        
    </style>

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
                        <button onclick="location.href='products.php'" class="nav-link">Add Items</button>
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

    
    <div class="empty-container"> </div>
    <div class="empty-container"> </div>

    <div class="dashboard-container">
    <h1 id="dashboard">Dashboard</h1>
    <button onclick="location.href='dashboard.php'" class="nav-link">Refresh</button>
    </div>
    

    <table class="record">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>BILL</th>
            <th>Products</th>
            <th>Action</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';    
            echo '<td>'.$row['ID'].'</td>';
            echo '<td>'.$row['first_name'].'</td>';
            echo '<td>'.$row['last_name'].'</td>';
            echo '<td>'.$row['phone'].'</td>';
            echo '<td>'.$row['Email'].'</td>';
            echo '<td>'.$row['Address'].'</td>';
            echo '<td>'.$row['bill'].'</td>';
            echo '<td>'.$row['Products'].'</td>';
            echo '<td><a href="?delete_id='.$row['ID'].'">Complete</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
</body>
</html>

<?php
// Step 4: Close the database connection
$conn->close();
?>
