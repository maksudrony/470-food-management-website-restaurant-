<?php
session_start();

$firstname = "";
$lastname = "";
$phone = "";
$address  = "";
$email = "";
$password = "";
$cpassword = "";

$db = mysqli_connect('localhost','root','','aspm');

//registration user

if (isset($_POST['register'])) {
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $phone= mysqli_real_escape_string($db, $_POST['phone']);
    $address= mysqli_real_escape_string($db, $_POST['address']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $cpassword = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($firstname)) { array_push($errors, "FirstName is required"); }
    if (empty($lastname)) { array_push($errors, "LastName is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($address)) { array_push($errors, "Address is required"); }
    if (empty($phone)) { array_push($errors, "phone no is required"); }
    if (empty($password)) { array_push($errors, "password1"); }
    if ($password != $cpassword) {
    	array_push($errors, "The two passwords do not match");
      }


    if (!$error) {
        if (mysqli_query($db, "INSERT INTO user(email, firstName, lastName, phone, address, password) VALUES('" . $email . "', '" . $firstname . "', '" . $lastname . "','" . $phone . "','" . $address . "', '" . $password . "')")) {
            $successmsg = "You have signed in successfully.  <a href= 'login.php'>Click here to login</a>.";
        } else {
            $errormsg = "Error occurred while signing up. Please try again later.";
        }
    }

    // first check the database to make sure
      // a user does not already exist with the same username and/or email
      $user_check_query = "SELECT * FROM users WHERE username='$firstname' OR email='$email' LIMIT 1";
      $result = mysqli_query($db, $user_check_query);
      $user = mysqli_fetch_assoc($result);

    if ($firstname) { // if user exists
    if ($user['username'] === $firstname) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (firstname, lastname, phone, address, email, password)
  			  VALUES('$firstname', '$lastname', '$phone', '$address', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $firstname;
  	$_SESSION['success'] = "You are now logged in";
    $result = mysqli_query($db,"SELECT `user_id` FROM `users` WHERE `username` = '$firstname'") or die($query."<br/><br/>".mysqli_error($db));
      $row = mysqli_fetch_array($result);
      $_SESSION['user_id'] = $row[0];
  	header('location: index.php');
  }
}





?>
