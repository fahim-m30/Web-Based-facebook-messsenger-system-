<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Messenger</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('http://localhost/messenger/singinpic.php');
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background-color: #3b5998;
            color: white;
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
            flex: 1;
            padding: 40px;
            text-align: center;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 40px auto;
            background-color: rgba(255, 255, 255, 0.9);
        }

        form {
            text-align: left;
        }

        form label,
        form input {
            margin-bottom: 20px;
            display: block;
        }

        form input[type="email"],
        form input[type="password"] {
            width: 100%;
            padding: 12px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        form input[type="email"]:focus,
        form input[type="password"]:focus {
            border-color: #4267B2;
            outline: none;
        }

        form input[type="submit"] {
            background-color: #4267B2;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        form input[type="submit"]:hover {
            background-color: #2a4a7b;
        }

        footer {
            background-color: #3b5998;
            color: white;
            text-align: center;
            padding: 10px 0;
            width: 100%;
        }

        /* Flexbox styles to place footer at the bottom */
        .flex-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .flex-container > * {
            flex: 0 0 auto;
        }

        .flex-container > .container {
            flex: 1;
        }

    </style>
</head>

<body class="flex-container">

    <header>
        <h1>Facebook Messenger Database Management System</h1>
        <nav>
            <a href="http://localhost/messenger/desh.php" style="font-weight: bold;">Home</a>
            <a href="http://localhost/messenger/singin.php" style="font-weight: bold;">Sign In</a>
            <a href="http://localhost/messenger/singup.php" style="font-weight: bold;">Sign Up</a>
            <a href="http://localhost/messenger/adminlogin.php" style="font-weight: bold;">Admin</a>
            <a href="http://localhost/messenger/about.html" style="font-weight: bold;">About</a>
        </nav>
    </header>

    <div class="container">
        <h2>Sign In to Messenger</h2>
        <form action="http://localhost/messenger/singinconnection.php" method="post">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Login">
        </form>
    </div>

    <footer>
        Made by Fahim, Rakib, Sajjad
    </footer>

</body>

</html>
