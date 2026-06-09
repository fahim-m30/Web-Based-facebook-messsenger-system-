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

// Query to get friend details, mutual friend count, and mutual friend names
$sql = "SELECT f1.friend_id, 
               u1.first_name, 
               u1.last_name, 
               u1.email, 
               u1.gender, 
               u1.birthdate,
               GROUP_CONCAT(u2.first_name, ' ', u2.last_name ORDER BY u2.first_name ASC SEPARATOR ', ') as mutual_friends,
               COUNT(f2.friend_id) as mutual_count
        FROM friends f1
        JOIN friends f2 ON f1.friend_id = f2.friend_id
        JOIN users u1 ON f1.friend_id = u1.id
        JOIN users u2 ON f2.user_id = u2.id
        WHERE f1.user_id = '$userId' AND f1.friend_id != '$userId' AND f2.friend_id != '$userId'
        GROUP BY f1.friend_id";

$result = $conn->query($sql);
$friendList = '';

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $friendList .= "<tr>
                            <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
                            <td>" . $row['email'] . "</td>
                            <td>" . $row['gender'] . "</td>
                            <td>" . $row['birthdate'] . "</td>
                            <td>" . $row['mutual_count'] . "</td>
                            <td>" . $row['mutual_friends'] . "</td>
                        </tr>";
    }
} else {
    $friendList = "You have no friends.";
}

echo "<!DOCTYPE html>
      <html lang='en'>
      <head>
          <meta charset='UTF-8'>
          <meta name='viewport' content='width=device-width, initial-scale=1.0'>
          <title>View Friends</title>
          <style>
              /* Screen styles */
              body {
                  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                  background-image: url('http://localhost/messenger/seachpic.php');
                  background-repeat: no-repeat;
                  background-size: cover;
                  margin: 0;
                  padding: 0;
                  position: relative;
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

              footer {
                  background-color: #4267B2;
                  color: white;
                  text-align: center;
                  padding: 10px 0;
                  position: absolute;
                  bottom: 0;
                  width: 100%;
              }

              footer:before {
                  content: '';
                  position: absolute;
                  top: 100%;
                  left: 50%;
                  width: 0;
                  height: 0;
                  border-left: 20px solid transparent;
                  border-right: 20px solid transparent;
                  border-top: 20px solid #4267B2;
              }

              /* Print styles */
              @media print {
                  body {
                      background-color: white;
                      color: black;
                  }

                  header, .header-buttons, footer {
                      display: block !important; /* Show header and footer */
                  }

                  .btn {
                      display: none; /* Hide the print button */
                  }
              }
          </style>
      </head>
      <body>

      <header>
      <h1>Facebook Messenger Database Management System</h1>
      <div class='header-buttons'>
          <a href='http://localhost/messenger/desh.php '>Home</a>
          <a href=''>Chat</a>
          <a href='http://localhost/messenger/ads.php'>Ads</a>
          <a href='http://localhost/messenger/viewfriend.php'>Your Friend list</a>
          <a href='http://localhost/messenger/viewaddfriend.php'>Search your Friend</a>
          <a href='http://localhost/messenger/viewaddfriend.php'>Beck</a>
          <a href='http://localhost/messenger/singin.php'>LOGOUT</a>
      </div>
  </header>

      <div class='container'>
          <h2>Messenger Friends List</h2>
          <button onclick='printPage()' class='btn'>Print</button>
          <table>
              <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Gender</th>
                  <th>Date Of Birth</th>
                  <th> Total Friends </th>
                  <th>Total Friends Names</th>
              </tr>
              $friendList
          </table>
      </div>

      <footer>
          Made by Fahim, Rakib, Sajjad
      </footer>

      <script>
          function printPage() {
              window.print();
          }
      </script>

      </body>
      </html>";

$conn->close();
?>
