<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('http://localhost/messenger/aboutpic.php');
            background-size: cover;
            background-repeat: no-repeat;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header, footer {
            background-color: #3b5998;
            color: white;
            text-align: center;
            padding: 15px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
        }

        header a {
            margin-left: 20px;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        header a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333333;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #e0e0e0;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

    </style>
</head>

<body>

    <header>
        <h1>Facebook Messenger Database Management System</h1>
        <nav>
            <a href="http://localhost/messenger/singin.php" style="font-weight: bold;">Sign In</a>
            <a href="http://localhost/messenger/singup.php" style="font-weight: bold;">Sign Up</a>
            <a href="http://localhost/messenger/adminlogin.php" style="font-weight: bold;">Admin</a>
            <a href="http://localhost/messenger/about.html" style="font-weight: bold;">About</a>
        </nav>
    </header>

    <div class="container">
        <div class="header">
            <h1>Admin Login</h1>
        </div>
        <?php if (!empty($message)): ?>
            <p style="color: red;"><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="http://localhost/messenger/adminconnect.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="email" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Login">
            </div>
        </form>
    </div>

    <footer>
        Made by Fahim, Rakib, Sajjad
    </footer>

</body>

</html>
