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

$email = $_POST['email'];
$password = $_POST['password'];

// Check if account exists
$sql_check = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    $row = $result_check->fetch_assoc();
    $_SESSION['userId'] = $row['id'];
    $_SESSION['userEmail'] = $row['email'];

    // Count the number of friends
    $userId = $row['id'];
    $sql_count_friends = "SELECT COUNT(*) as totalFriends FROM friends WHERE user_id='$userId'";
    $result_count_friends = $conn->query($sql_count_friends);
    $row_count_friends = $result_count_friends->fetch_assoc();
    $totalFriends = $row_count_friends['totalFriends'];

    echo "<!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, initial-scale=1.0'>
              <title>Messenger Home</title>
              <style>
                  body {
                      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                      background-color: #f4f4f4;
                      margin: 0;
                      padding: 0;
                      display: flex;
                      flex-direction: column;
                      min-height: 100vh;
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

                  .container {
                      padding: 40px;
                      text-align: center;
                      margin: 40px auto;
                      background-color: rgba(255, 96, 112, 0.9); /* #FF6070 */
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

                  .footer {
                      background-color: #4267B2;
                      color: white;
                      text-align: center;
                      padding: 10px 0;
                      position: relative;
                      margin-top: auto;
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
              </style>
          </head>
          <body>

          <header>
              <h1>Welcome, " . $_SESSION['userEmail'] . "</h1>
              <div class='header-buttons'>
                  <a href='http://localhost/messenger/desh.php' class='btn'>Home</a>
                  <a href='singin.php' class='btn'>Logout</a>
              </div>
          </header>

          <div class='container'>
              <h2> CHOOSE THE OPTIONS </h2>
              <p>Enjoy the Messeger. Here, you can contact your friends , join in the social world , and more.</p>
              <p>Total Friends: $totalFriends</p>
              <a href='#' class='btn'>Chat</a>
              <a href='addfriend.php' class='btn'>Add Friend</a>
              <a href='#' class='btn'>Ads</a>
          </div>

          <div class='footer'>
              Made by Fahim, Rakib, Sajjad
          </div>

          </body>
          </html>";
} else {
    echo "<!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, initial-scale=1.0'>
              <title>Sign In - Messenger</title>
              <style>
                  body {
                      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                      background-color: #f4f4f4;
                      display: flex;
                      flex-direction: column;
                      min-height: 100vh;
                      align-items: center;
                      justify-content: center;
                  }

                  .message {
                      text-align: center;
                      padding: 20px;
                      background-color: #ffffff;
                      border-radius: 5px;
                      box-shadow: 0 0 10px rgba(0,0,0,0.1);
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
              </style>
          </head>
          <body>
              <div class='message'>
                  <h2>Invalid Email or Password</h2>
                  <a href='http://localhost/messenger/singin.php' class='btn'>Try Again</a>
              </div>
          </body>
          </html>";
}

$conn->close();
?>
