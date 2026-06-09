<?php
// Database connection
$servername = "localhost"; // Assuming your database server is localhost
$username = "root"; // Assuming your database username is root
$password = ""; // Assuming your database password is empty
$database = "messenger_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into the database
if(isset($_POST["submit"])) {
    $person_name = $_POST["person_name"];
    $email = $_POST["email"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $fees = $_POST["fees"];
    $date = date("Y-m-d");
    $image = ""; // Initialize image variable

    if($_FILES["image"]["error"] == 4) {
        echo "<script>alert('Image Does Not Exist');</script>";
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        
        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('Invalid Image Extension');</script>";
        } elseif ($fileSize > 1000000) {
            echo "<script>alert('Image Size Is Too Large');</script>";
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($tmpName, 'img/' . $newImageName);
            $image = $newImageName;

            // Insert data into database
            $query = "INSERT INTO tb_ads (person_name, email, name, price, fees, date, image) 
                      VALUES ('$person_name', '$email', '$name', '$price', '$fees', '$date', '$image')";
            mysqli_query($conn, $query);

            echo "<script>alert('Successfully Added');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Messenger Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #4267B2;
            color: white;
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

        form {
            max-width: 400px;
            margin: 20px auto;
            background: #fff; /* Background color for the form box */
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select,
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            text-align: left;
        }

        input[type="submit"] {
            background-color: #0084FF;
            border: none;
            cursor: pointer;
            color: white; /* Text color for the submit button */
        }

        h2 {
            text-align: center;
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
    <h1>Facebook Messenger Database Management System</h1>
    <div class="header-buttons">
        <a href="http://localhost/messenger/home.php">Home</a>
        <a href="http://localhost/messenger/singin.php">Sign In</a>
        <a href="http://localhost/messenger/singup.php">Sign Up</a>
        <a href="http://localhost/messenger/ads.php">Ads</a>
        <a href="http://localhost/messenger/adminlogin.php">Admin</a>
        <a href="http://localhost/messenger/about.html">About</a>
    </div>
</header>

    
<form action="" method="post" enctype="multipart/form-data">
        <label for="person_name">Person Name:</label>
        <input type="text" name="person_name" id="person_name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" required><br>

        <label for="fees">Fees:</label>
        <input type="number" name="fees" id="fees" required><br>

        <label for="date">Date:</label>
        <input type="date" name="date" id="date" required><br>

        <label for="image">Image:</label>
        <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" required><br>

        <button name="submit">Submit</button>
        <a href="http://localhost/messenger/data.php">View</a>
    </form>

<footer>
    Develop by Fahim, Rakib, Sajjad
</footer>
</body>
</html>
