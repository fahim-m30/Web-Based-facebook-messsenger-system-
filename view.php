<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Messenger Accounts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('http://localhost/messenger/viewpic.php');
            background-size: cover;
            background-repeat: no-repeat;
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

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4267B2;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
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

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Gender</th>
            <th>Birthdate</th>
        </tr>
    </thead>
    <tbody>

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

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["first_name"] . "</td>";
            echo "<td>" . $row["last_name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["password"] . "</td>";
            echo "<td>" . $row["gender"] . "</td>";
            echo "<td>" . $row["birthdate"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No records found.</td></tr>";
    }

    $conn->close();
    ?>

    </tbody>
</table>

<footer>
    Made by Fahim, Rakib, Sajjad
</footer>

</body>

</html>
