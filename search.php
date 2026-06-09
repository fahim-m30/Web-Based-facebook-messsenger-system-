<?php
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

$firstName = $lastName = $email = $gender = $birthdate = "";
$message = "";

if(isset($_POST['search'])) {
    $search_email = $_POST['email'];
    
    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $search_email); // Assuming email is a string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
        $email = $row['email'];
        $gender = $row['gender'];
        $birthdate = $row['birthdate'];
    } else {
        $message = "No user found with the provided email.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('http://localhost/messenger/searchpic.php');
            background-size: cover;
            background-repeat: no-repeat;
            background-color: #f4f4f4; /* Fallback color */
        }

        .background-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
            z-index: -1; /* Place it behind the content */
        }

        .result, .message {
            text-align: left;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 400px;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            background-color: #0084FF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #4267B2;
            color: white;
            position: absolute;
            top: 0;
            width: 100%;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header-buttons a {
            margin-left: 15px;
            text-decoration: none;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid white;
        }

        .header-buttons a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            position: absolute;
            bottom: 0;
        }
    </style>
</head>
<body>

<header>
    <h1>Admin Panel</h1>
    <div class="header-buttons">
        <a href="http://localhost/messenger/amininfo.php">ADMIN INFO</a>
        <a href="http://localhost/messenger/view.php">VIEW THE MEMBER</a>
        <a href="http://localhost/messenger/search.php">SEARCH MEMBER</a>
        <a href="http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=messenger_db&table=users">EDIT MEMBER</a>
    </div>
</header>

<div class="background-overlay"></div>

<center>
    <h1>Search by Email</h1><br/>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Email: <input type="text" name="email"><br/><br/>
        <input type="submit" name="search" value="Search">
    </form>
    <br><br><br>

    <?php if (!empty($firstName)): ?>
        <div class="result">
            <h2>User Information</h2>
            <p><strong>First Name:</strong> <?php echo $firstName; ?></p>
            <p><strong>Last Name:</strong> <?php echo $lastName; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Gender:</strong> <?php echo $gender; ?></p>
            <p><strong>Birthdate:</strong> <?php echo $birthdate; ?></p>
            <a href="http://localhost/messenger/search.php" class="btn">Back to Search</a>
        </div>
    <?php elseif (!empty($message)): ?>
        <div class="message">
            <h2><?php echo $message; ?></h2>
            <a href="search_form.html" class="btn">Back to Search</a>
        </div>
    <?php endif; ?>

</center>

<footer>
    Made by Fahim, Rakib, Sajjad
</footer>

</body>
</html>
