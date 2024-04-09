    <?php  
    session_start(); // Start the session

    // Check if 'user' key is set in $_POST array
    if(isset($_POST['user'])) {
        // 'user' key is set, proceed with your code
        $receiver = $_POST['user'];
    } else {
        // 'user' key is not set, handle this case (for example, redirect to index.php)
        header("Location:select_user.php");
        exit(); // Ensure that script execution stops after redirection
    }
    ?>
    <!DOCTYPE html> 
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chat System</title>
        <link rel="icon" href="logos\TMS_Logo.ico" type="image/x-icon" >
        <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color:#4ba8a8;
            background-image: url('logos/Back.jpg'); /* URL of your background image */
    background-size: cover; /* Cover the entire background */
    background-position: center; /* Center the background image */
        }

        .chat-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .messages {
            overflow-y: scroll;
            max-height: 300px;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .message {
            margin-bottom: 10px;
            padding: 5px;
            border-radius: 5px;
            word-wrap: break-word;
            max-width: 70%;
        }

        .message.sender {
            background-color:#ccc;
            color:black;
            text-align: right;
            margin-left: auto;
            width:fit-content   ;
        }

        .message.receiver {
            background-color: #e9ecef;
            color: #333;
            text-align: left;
            margin-right: auto;
                    width:fit-content   ;

        }

        input[type="text"] {
            width: calc(100% - 50px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100px;
            padding: 10px;
            
            background-color: rgb(20, 123, 119); 
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: rgb(9, 87, 84);
        }
    </style>
    </head>
    <body>
        <div class="chat-container"style="margin-top: 120px;">
        <span style="font-size:43px; "><img src="logos\TMS_Logo.ico" alt="Logo" style="width: 70px; height: 70px;">&nbsp;Task Management System</span>
        <br><div style="font-size:xx-large; color:darkolivegreen;"><?php echo ucwords(strtolower( $_POST['user']));?></div>
        <div class="messages" id="message-container"></div>
            <form id="message-form">
                <input type="hidden" id="receiver" value="<?php echo $_POST['user']; ?>">
                <input type="text" id="message-input" placeholder="Type your message...">
                <div><br><input type="submit" value="Send"></div>
            </form>
        </div>

        <script>
            function fetchMessages() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("message-container").innerHTML = this.responseText;
                        document.getElementById("message-container").scrollTop = document.getElementById("message-container").scrollHeight;
                    }
                };
                xhttp.open("POST", "fetch_message.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("receiver=<?php echo $_POST['user']; ?>");
            }

            document.getElementById("message-form").addEventListener("submit", function(e) {
                e.preventDefault();
                var message = document.getElementById("message-input").value;
                var receiver = document.getElementById("receiver").value;
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("message-input").value = "";
                        fetchMessages();
                    }
                };
                xhttp.open("POST", "send_message.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("receiver=" + receiver + "&message=" + message);
            });

            fetchMessages();
            setInterval(fetchMessages, 5000); // Fetch messages every 3 seconds
        </script>
    </body>
    </html>
