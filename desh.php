<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook Messenger Database Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e6e6ff; /* Light purple */
            background-image: linear-gradient(45deg, #e6e6ff, #ccf2ff); /* Light blue */
            background-repeat: no-repeat;
            background-attachment: fixed;
            transition: background-color 0.5s;
        }

        body.dark-mode {
            background-color: #333; /* Dark grey */
            background-image: linear-gradient(45deg, #333, #555); /* Dark blue */
            color: #e6e6e6; /* Light grey */
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
            padding: 20px;
        }

        footer {
            background-color: #3b5998;
            color: white;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            clear: both;
        }

        /* Toggle button styles */
        .toggle-btn {
            position: fixed;
            right: 20px;
            top: 20px;
            background-color: #3b5998;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            z-index: 9999;
        }

    </style>
</head>

<body>

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
        <h2>About Messenger</h2>
        <p>
            Facebook Messenger is a messaging app and platform. Originally developed as Facebook Chat in 2008, the company revamped its messaging service in 2010, and subsequently released standalone iOS and Android apps in August 2011. Over the years, Facebook Messenger has evolved into a comprehensive messaging platform, offering various features such as text messaging, voice and video calls, file sharing, and more.
        </p>
        <img src="http://localhost/messenger/deshpic.php" alt="Messenger Image" style="margin-top: 20px; width: 100%;">

        <p style="margin-top: 20px;">
            Facebook Messenger is an essential tool for communication in today's digital age, connecting people from all over the world. With its user-friendly interface and extensive features, Messenger has become one of the most popular messaging platforms globally.
            <button class="toggle-btn" onclick="toggleMode()">Toggle Mode</button>
        </p>
    </div>

    <footer>
        Made by Fahim, Rakib, Sajjad
    </footer>

    <script>
        function toggleMode() {
            const body = document.body;
            body.classList.toggle('dark-mode');
        }
    </script>

</body>

</html>
