<?php
// Database connection
require 'connection.php';

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
            $query = "INSERT INTO tb_ads (person_name, email, name, price, fees, Date, image) 
                      VALUES ('$person_name', '$email', '$name', '$price', '$fees', '$date', '$image')";
            mysqli_query($conn, $query);

            echo "<script>alert('Successfully Added');</script>";
        }
    }
}

// Fetch and display data from the database
$rows = mysqli_query($conn, "SELECT * FROM tb_ads ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
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
            position: relative;
            bottom: 0;
        }

        
    </style>
</head>

<body>

<header>
    <h1>Facebook Messenger Database Management System</h1>
    <div class="header-buttons">
      <a href="#">Home</a>
        <a href="#">Sign In</a>
        <a href="#">Sign Up</a>
        <a href="#">Admin</a>
        <a href="#">Ads</a>
        <a href="#">About</a>
    </div>
</header><br><br>
<body>
    <center>
        <table border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>#</td>
                <td>Person Name</td>
                <td>Email</td>
                <td>Product Name</td>
                <td>Price</td>
                <td>Fees</td>
                <td>Date</td>
                <td>Image</td>
            </tr>

            <?php $i = 1; ?>
            <?php foreach ($rows as $row) : ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row["person_name"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["price"]; ?></td>
                    <td><?php echo $row["fees"]; ?></td>
                    <td><?php echo $row["date"]; ?></td>
                    <td><img src="img/<?php echo $row["image"]; ?>" width="200" title="<?php echo $row['image']; ?>"></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </center>
<br><br>

<footer>
    Develop by Fahim, Rakib, Sajjad
</footer>
   
    <br> 
</body>


</html>



