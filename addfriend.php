<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "messenger_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userEmail = $_SESSION['userEmail'];
$userId = $_SESSION['userId'];

// Fetch all users except the current user
$sql = "SELECT * FROM users WHERE id != '$userId'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Friend - Messenger</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #4267B2;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header-buttons {
            display: flex;
            align-items: center;
        }

        .header-buttons a {
            margin-left: 15px;
            text-decoration: none;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            border: 1px solid white;
            transition: background-color 0.3s;
        }

        .header-buttons a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .footer {
            background-color: #4267B2;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
        }

        .footer:before {
            content: '';
            position: absolute;
            top: 100%;
            left: 50%;
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-top: 20px solid #4267B2;
            z-index: 1;
        }

        .container {
            padding: 40px;
            text-align: center;
            margin: 40px auto;
            background-color: rgba(255, 255, 255, 0.9);
        }

        .user-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
        }

        .btn {
            background-color: #0084FF;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #2a4a7b;
        }
    </style>
</head>

<body>

<header>
    <h1>Facebook Messenger Database Management System</h1>
    <div class="header-buttons">
        <a href="http://localhost/messenger/desh.php">Home</a>
        <a href="http://localhost/messenger/singin.php">Chat</a>
        <a href="http://localhost/messenger/ads.php">Ads</a>
        <a href="http://localhost/messenger/viewfriend.php">Your Friend list</a>
        <a href="http://localhost/messenger/viewaddfriend.php">Search your Friend</a>
        <a href="http://localhost/messenger/singinconnection.php">Beck</a>
       

        <a href="singin.php">LOGOUT</a>
    </div>
</header>

<div class="container">
    <h2>Add Friend</h2>
    <div class="user-list">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $friendId = $row['id'];
                $friendEmail = $row['email'];
                echo "<div class='user-item'>
                        <span>$friendEmail</span>
                        <a href='addfriendprocess.php?friendId=$friendId' class='btn'>Add Friend</a>
                      </div>";
            }
        } else {
            echo "No users found.";
        }
        ?>
    </div>
</div>

<div class="footer">
    Made by Fahim, Rakib, Sajjad
</div>

</body>

</html>

<?php
$conn->close();
?>
