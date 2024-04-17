<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopAssist-LONGSHOP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://i.redd.it/cool-wallpapers-v0-qm1v3yhghkvb1.jpg?width=3840&format=pjpg&auto=webp&s=a8af285636403f6646c38ef5debeaa0399b48730'); /* Replace with your image URL */
            background-size: cover;
        }
        .chat-container {
            max-width: 999px;
            margin: 20px auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .chat-header {
            padding: 10px;
            text-align: center;
            color: #007BFF;
            font-size: 1.5em;
            border-bottom: 1px solid #ccc;
        }
        .chat-box {
            height: 300px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            padding: 10px;
        }
        #user-input {
            width: calc(100% - 70px);
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 5px;
        }
        button {
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">ShopAssist-LONGSHOP</div>
        <div class="chat-box" id="chat-box"></div>
        <input type="text" id="user-input" placeholder="Type your message...">
        <button onclick="sendMessage()">Send</button>
    </div>

    <script>
        function sendMessage() {
            var userInput = document.getElementById("user-input").value;
            if (userInput.trim() !== "") {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "api.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = xhr.responseText;
                        document.getElementById("chat-box").innerHTML += "<p><strong>You:</strong> " + userInput + "</p>";
                        document.getElementById("chat-box").innerHTML += "<p><strong>LONGSHOP (AI):</strong> " + response + "</p>";
                        document.getElementById("user-input").value = "";
                        document.getElementById("chat-box").scrollTop = document.getElementById("chat-box").scrollHeight;
                    }
                };
                xhr.send("message=" + userInput);
            }
        }
    </script>
</body>
</html>
