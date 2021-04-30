<?php
include('dbConnect.php');

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
       <link href="css/home.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/new.css" rel="stylesheet" type="text/css">
    <header> </header>
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>//
    </head>
    <body class="background2">
        <div>
        <a class="hiddenanchor" id="toregister"></a>
	<a class="hiddenanchor" id="tologin"></a>
	<div id="wrapper">
		<div id="login" class="animate form">

         <div id="setting">
                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="registerform">
                        <h1>SignUp Here</h1>
                        <div>
                           First Name:<input type="text" width=200px class="text" name="firstname" size="37"placeholder="Enter First Name"  id="active" />
                        <p style="color: #FF0000; font-weight: bold; font-size: 24px"><?php if (isset($firstname_error)) echo $fname_error; ?></p>
                        </div>
                        <div>
                            Last Name:<input type="text" width=200px  class="text" name="lastname" size="37" placeholder="Enter Last Name" />
                            <p style="color: #FF0000; font-weight: bold; font-size: 24px"><?php if (isset($lastname_error)) echo $lname_error; ?></p>
                        </div>
                       <div> Email:<input type="text"  width=200px class="text" name="email" placeholder="Enter Valid Email" />
                            <p style="color: #FF0000; font-weight: bold; font-size: 24px" /><?php if (isset($email_error)) echo $email_error; ?></p>
                             </div>
                        <div>
                             Phone Number:<input type="text"  width=200px class="text" name="phone" size="37" placeholder="Enter Phone Number" />
                             <p style="color: #FF0000; font-weight: bold; font-size: 24px"><?php if (isset($phone_error)) echo $phone_error; ?></p>
                        </div>
                             <div>  Address: <input type="text"  width=200px class="text" name="address" size="37" placeholder="Enter address" />
                            <p style="color: #FF0000; font-weight: bold; font-size: 24px"><?php if (isset($address_error)) echo $address_error; ?></p>
                             </div>

                        <div> Password:<input type="password"  width=200px class="text" name="password" size="37" placeholder="Enter Password" >
                            <p style="color: #FF0000; font-weight: bold; font-size: 24px"><?php if (isset($password_error)) echo $password_error; ?></p>
                             </div>
                        <div>  Confirm Password:<input type="password" width=200px  class="text" size="37" name="cpassword" placeholder="Enter Confirm Passwords" >
                            <p style="color: #FF0000; font-weight: bold; font-size: 24px"><?php if (isset($cpassword_error)) echo $cpassword_error; ?> </p>
                        </div>
                        <p class="login button">
                        <input type="submit"  style="font-size:20px; font-weight: bold; " name="register" value="Create"/>

                        </p>

                                    <div>
                                        <span style="color: white;" ><?php
                                            if (isset($successmsg)) {
                                                echo $successmsg;
                                            }
                                            ?></span>
                                        <span style="color: #FF0000;"><?php
                                            if (isset($errormsg)) {
                                                echo $errormsg;
                                            }
                                            ?></span>
                                    </div>
                                    </form>

         </div></div></div></div>
                                    </body>
                                    </html>
