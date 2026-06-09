<?php
// Database connection
require 'connection.php';

// Insert data into the database
if(isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    $time = date("Y-m-d H:i:s");
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
            $query = "INSERT INTO chats (name, email, time, message, image) 
                      VALUES ('$name', '$email', '$time', '$message', '$image')";
            mysqli_query($conn, $query);

            echo "<script>alert('Message Sent Successfully');</script>";
        }
    }
}
?>

<footer>
    Developed by Fahim, Rakib, Sajjad
</footer>

</body>
</html>
