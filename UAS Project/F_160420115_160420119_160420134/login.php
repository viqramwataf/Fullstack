<?php
session_start();
if (isset($_SESSION["id"])) {
    header("Location:http://kenhosting.ddns.net/index.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
    <div class="login-container">
        <div style="font-size:larger; font-weight:bold">Login To Meme</div>
        <br>
        <div class="form">
            <label for="username">Username: </label>
            <input type="text" name="username" id="username">
            <label for="password">Password: </label>
            <input type="password" name="password" id="password">
            <button class="login">Login</button>
        </div>
        <br>
        <div class="wrong-cred" hidden>Username atau password Anda salah!</div>
    </div>


    <script>
        $(".login").on("click", function() {
            $.ajax({
                type: "POST",
                url: "http://kenhosting.ddns.net/ajax/loginajax.php",
                data: {
                    "username": $("#username").val(),
                    "password": $("#password").val()
                },
                success: function(response) {
                    var result = JSON.parse(response)
                    // console.log(result);
                    if (result["result"] == "success") {
                        location.href = "http://kenhosting.ddns.net/index.php"
                    }
                    else if (result["result"] == "error"){
                        $(".wrong-cred").show().delay(2000).fadeOut();
                    }
                }
            });
        });
    </script>
</body>

</html>