<?php

    session_start();

    if (isset($_SESSION['userlogin'])) {
        echo $_SESSION['userlogin'];
        header("Location: feedpage.php");
    }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Block Talk|Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
          crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>


<div id="login_form_wrapper">

        <h1>User Login</h1>
        </br></br>
        <div class="input_container">
            <i class="fas fa-user"></i>
            <input placeholder="Username" type="username" name="username" id="username" class='input_field'>
        </div>
        </br></br>
        <div class="input_container">
            <i class="fas fa-lock"></i>
            <input  placeholder="Password" type="password" name="password" id="password" class='input_field'>
        </div>
        </br></br>
        <input type="submit" value="Login" id='input_submit' class='input_field'>

        </br></br>
        <span id='create_account'>
                New to Block Talk?</br> <a href="registration.php"> Create your account &#x27A1; </a>
            </span>

</div>

<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

<script>
    $(function(){
        $('#input_submit').click(function(e){

            let username = $('#username').val();
            let password = $('#password').val();

            $.ajax({
                type: 'POST',
                url: 'jslogin.php',
                data: {username:username, password:password},
                success: function(data) {
                    //alert(data);
                    if($.trim(data)=='Login Successful'){
                        alert("Login Successful");
                        setTimeout('window.location.href = "feedpage.php"',1000);
                    }
                },
                error: function(data){
                    alert("There are errors");
                }
            });


        });

    });
</script>

<br><br>

</body>

</html>
