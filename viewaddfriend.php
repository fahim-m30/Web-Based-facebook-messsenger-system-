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

$userId = $_SESSION['userId'];

// Search functionality
$searchResult = '';
if(isset($_POST['search'])) {
    $searchTerm = $_POST['searchTerm'];
    $sql_search = "SELECT * FROM users WHERE email='$searchTerm'";
    $result_search = $conn->query($sql_search);

    if ($result_search->num_rows > 0) {
        $row_search = $result_search->fetch_assoc();
        $searchResult .= "<table>
                            <tr>
                                <th>Name</th>
                                <td>" . $row_search['first_name'] . " " . $row_search['last_name'] . "</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>" . $row_search['email'] . "</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>" . $row_search['gender'] . "</td>
                            </tr>
                            <tr>
                                <th>Date Of Birth</th>
                                <td>" . $row_search['birthdate'] . "</td>
                            </tr>";

        // Fetch mutual friend count and names
        $friendIds = [];
        $sql_friends = "SELECT friend_id FROM friends WHERE user_id='$userId'";
        $result_friends = $conn->query($sql_friends);

        while ($row_friends = $result_friends->fetch_assoc()) {
            $friendIds[] = $row_friends['friend_id'];
        }

        $mutualFriends = [];
        foreach ($friendIds as $friendId) {
            $sql_mutual = "SELECT * FROM friends WHERE user_id='$friendId' AND friend_id='" . $row_search['id'] . "'";
            $result_mutual = $conn->query($sql_mutual);

            if ($result_mutual->num_rows > 0) {
                $mutualFriends[] = $friendId;
            }
        }

        $mutualFriendNames = [];
        foreach ($mutualFriends as $mutualFriend) {
            $sql_name = "SELECT first_name, last_name FROM users WHERE id='$mutualFriend'";
            $result_name = $conn->query($sql_name);
            $row_name = $result_name->fetch_assoc();
            $mutualFriendNames[] = $row_name['first_name'] . " " . $row_name['last_name'];
        }

        $searchResult .= "<tr>
                                <th>Mutual Friend Number</th>
                                <td>" . count($mutualFriends) . "</td>
                            </tr>
                            <tr>
                                <th>Mutual Friends Name</th>
                                <td>" . implode(", ", $mutualFriendNames) . "</td>
                            </tr>
                          </table>";
    } else {
        $searchResult = "No friend found with the given email.";
    }
}

// Query to get friend details
$sql = "SELECT * FROM friends WHERE user_id='$userId'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>View Friends</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('http://localhost/messenger/seachpic.php');
            background-repeat: no-repeat;
            background-size: cover;
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

        .container {
            padding: 40px;
            text-align: center;
            margin: 40px auto;
            background-color: rgba(255, 255, 255, 0.9);
        }

        .btn {
            background-color: #0084FF;
            color: white;
            padding: 15px 30px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            background-color: #4267B2;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 1;
        }

    </style>
</head>
<body>

<header>
    <h1>Facebook Messenger Database Management System</h1>
    <div class='header-buttons'>
        <a href='http://localhost/messenger/desh.php'>Home</a>
        <a href='http://localhost/messenger/singin.php'>Chat</a>
        <a href='http://localhost/messenger/ads.php'>Ads</a>
        <a href='http://localhost/messenger/viewfriend.php'>Your Friend list</a>
        <a href='http://localhost/messenger/viewaddfriend.php'>Search your Friend</a>
        <a href='addfriend.php'>Beck</a>
        <a href='singin.php'>LOGOUT</a> 
    </div>
</header>

<div class='container'>
    <h2>Search Your Friend</h2>
    <form action='' method='post'>
        <input type='text' name='searchTerm' placeholder='Enter friend email'>
        <input type='submit' name='search' value='Search'>
        <?php if(isset($_POST['search']) && $searchResult !== "No friend found with the given email."): ?>
            <button onclick="printContent()" class="btn">Print</button>
        <?php endif; ?>
    </form>
    <div id="printArea">
        <?php echo $searchResult; ?>
    </div>
</div>

<div class='footer'>
    Made by Fahim, Rakib, Sajjad
</div>

<script>
    function printContent() {
        var printButton = document.querySelector('.btn');
        printButton.style.display = 'none';
        window.print();
        printButton.style.display = 'block';
    }
</script>

</body>
</html>

<?php
$conn->close();
?>
