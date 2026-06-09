<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Messenger Chat</title>
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
        padding: 10px 20px;
        background-color: #4267B2;
        color: white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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

    footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            position: absolute;
            bottom: 0;
        }

    .container {
        padding: 40px;
        text-align: center;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        margin: 40px auto;
        background-color: rgba(255, 255, 255, 0.9);
    }
    body {
        font-family: Arial, sans-serif;
    }
    .chat-container {
        width: 1200px;
        
        margin: 50px auto;
        border: 1px solid #ccc;
        border-radius: 5px;
        overflow: hidden;
    }
    .chat-header {
        background-color: #007bff;
        color: white;
        padding: 10px;
        text-align: center;
    }
    .chat-header button {
        background-color: transparent;
        border: none;
        cursor: pointer;
        color: white;
        float: left;
    }
    .chat-messages {
        height: 300px;
        overflow-y: scroll;
        padding: 10px;
        background-color: #f4f4f4;
    }
    .chat-input {
        display: flex;
        padding: 10px;
        background-color: #e9e9e9;
    }
    .chat-input input[type="text"] {
        flex-grow: 1;
        padding: 5px;
        border-radius: 20px;
        border: none;
        margin-right: 10px;
    }
    .chat-input input[type="file"] {
        margin-right: 10px;
    }
    .chat-input button {
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 5px 15px;
        cursor: pointer;
    }
    .options {
        display: flex;
        justify-content: space-around;
        padding: 10px;
        background-color: #e9e9e9;
    }
    .options button {
        background-color: transparent;
        border: none;
        cursor: pointer;
    }
</style>
</head>
<body>
<header>
    <h1>Facebook Messenger Database Management System</h1>
    <div class="header-buttons">
        <a href="">Home</a>
    <a href="http://localhost/messenger/singin.php">Sign In</a>
            <a href="http://localhost/messenger/singup.php">Sign Up</a>
            <a href="http://localhost/messenger/ads.php">Ads</a>
            <a href="http://localhost/messenger/adminlogin.php">Admin</a>
            <a href="http://localhost/messenger/about.html">About</a>
    </div>
</header>

<div class="chat-container" action="http://localhost/messenger/chatdis.php" method="POST">
   
    <div class="chat-header">
        <button><a href="http://localhost/messenger/singin.php">Back</a></button>
        Messenger Group Chat
    </div>
    <div class="chat-messages" id="chatMessages">
        <!-- Messages will be displayed here -->
    </div>
    <div class="chat-input">
        <input type="file" id="imageInput">
        <input type="text" id="messageInput" placeholder="Type your message...">
        <button onclick="sendMessage()"> Send</button>
        <a href="http://localhost/messenger/callingpp.php" target="_blank"><button>Call</button></a>
    </div>
</div>

<script>
function sendMessage() {
    const messageInput = document.getElementById('messageInput');
    const chatMessages = document.getElementById('chatMessages');
    const imageInput = document.getElementById('imageInput');
    
    if (messageInput.value.trim() !== '' || imageInput.files.length > 0) {
        let message = '';
        
        if (messageInput.value.trim() !== '') {
            message += `<div style="margin-bottom: 10px;"><strong>You:</strong> ${messageInput.value}</div>`;
            messageInput.value = '';
        }
        
        if (imageInput.files.length > 0) {
            const file = imageInput.files[0];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                message += `<div style="margin-bottom: 10px;"><strong>You:</strong> <img src="${e.target.result}" alt="Image" style="max-width: 100px;"></div>`;
                chatMessages.innerHTML += message;
            };
            
            reader.readAsDataURL(file);
        } else {
            chatMessages.innerHTML += message;
        }
    }
}

function goBack() {
    // Implement back button functionality
    console.log('Back button clicked');
}
</script>
<footer>
    Made by Fahim, Rakib, Sajjad
</footer>
</body>
</html>

