<?php
//session_start();



include('dbConnect.php');

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    if ($email == "email" || $password == "password") {
        $errormsg = "Enter both email and password";
        header('location: home.html');
    } else {
        $result = mysqli_query($db, "SELECT * FROM user WHERE email = '" . $email . "' and password = '" . $password . "'");

        if ($row = mysqli_fetch_array($result)) {
            //$_SESSION['uid'] = $row['UId'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];
            header('location: home.html');
        } else {
            $errormsg = "Password or email entered is incorrect";
        }
    }
}
?>

<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
           <link href="css/new.css" rel="stylesheet" type="text/css">

       <link href="css/home.css" rel="stylesheet" type="text/css">
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
    </head>
    <body style="background-image: url(background3.jpg);">
<div>


        <a class="hiddenanchor" id="toregister"></a>
	<a class="hiddenanchor" id="tologin"></a>
	<div id="wrapper">
		<div id="login" class="animate form">

         <div id="settingLogin" style="top:50%">
            <h1>Login</h1>
            <form action="" method="post">
                <div>
                <label for="username"> Email </label>
                <input type="text" name="email" class="username" placeholder="email" required> </div>
                <div>
                    <label for="password"> Password </label>
                <input type="password" name="password" class="Password" size="30" placeholder="password" required><br><br>
                </div>
                <span><?php
                    if (isset($errormsg)) {
                        echo $errormsg;
                    }
                    ?></span><br>
                    <p class="login button">  <a href="home.html"><input type="submit" name="login" value="Login"/></a> </p>

            </form>

        </div></div>

    </body>
