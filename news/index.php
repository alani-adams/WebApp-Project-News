<?php
/*
--Create Database user in phpmyadmin

--use this to make the users table

CREATE TABLE IF NOT EXISTS `users` (
  `name` varchar(50) NOT NULL,
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `password` varchar(20) NOT NULL,
  `moderator` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
)

--use this to hardcode the moderator

INSERT INTO users(name, id, password, Moderator) 
VALUES('admin',NULL,'il9hM4r6MGXyk' ,1)

un-crypted password is 1234
row 92 login message should be changed to going to the article site page. not sure how to 'logout' currently more than one user can be logged in at a time.

/**************************
*
* Database Connections
*
***************************/

$link = new mysqli("localhost","root","","user");


if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}

/**************************
*
* Database interactions
*
***************************/

$loggedin = false;

if(isset($_COOKIE["AppName"]))
{
	$name = $_COOKIE["AppName"];
	$cryptedCookie = $_COOKIE[$name];
	$cryptedName = crypt($name,"ilovecheese");
	if($cryptedCookie == $cryptedName)
		$loggedin = true;
}
else
	$action = "none";

if(isset($_REQUEST["action"]))
	$action = $_REQUEST["action"];
else
	$action = "none";

$message = "";

if($action == "add_user")
{
	$name = $_POST["name"];
	$password = $_POST["password"];

	$name = htmlentities($link->real_escape_string($name));
	$password = htmlentities($link->real_escape_string($password));
	$password = crypt ($password,"ilovecheese");
	$result = $link->query("INSERT INTO users (name, password) VALUES ('$name', '$password')");

	if(!$result)
		die ('Can\'t query users because: ' . $link->error);
	else

		$message = "  User Added";

}



elseif ($action == "login") {

	$name = $_POST["name"];
	$password = $_POST["password"];
	$name = htmlentities($link->real_escape_string($name));

	$password = htmlentities($link->real_escape_string($password));
	$password = crypt ($password,"ilovecheese");
	$result = $link->query("SELECT * FROM users WHERE name='$name'");

	if(!$result)
		die ('Can\'t query users because: ' . $link->error);



	$num_rows = mysqli_num_rows($result);

	if ($num_rows > 0) 
	{

	  $row = $result->fetch_assoc();

	  if($row["password"] == $password)
	  {
		$message = "  User $name Logged in!";
		$cookieValue = crypt($name,"ilovecheese");
		setcookie("AppName", $name, time()+3600);  /* expire in 1 hour */
		setcookie($name, $cookieValue, time()+3600);  /* expire in 1 hour */
		$loggedin = true;
	  }

	  else
		$message = "   Password for user $name incorrect!";
	}

	else {
	  // do something else
	  $message = "   No user $name found!";
	}

}

?>



<html>
	<head>
		<title>Welcome</title>
		<link href='css/login_style.css' type='text/css' rel='stylesheet' />
		<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" />
		<script>

			function validate()
			{	
				var password1=document.getElementById('pass1');
				var password2=document.getElementById('pass2');
				var email=document.getElementById('add_email');
				var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
				var name = document.getElementById("add_name").value;
				if(name == "" || password1=='' || email=='')
					alert("Please fill out all fields.");

				else if(password1.value!=password2.value)
					alert('Passwords do not match');

				else if(email.value.match(mailformat))
					document.forms["add_user"].submit();

				else(alert("Please enter a valid email address."));

				return;
			}

			function check_pass()
			{
				var pass1 = document.getElementById("pass1").value;
				var pass2 = document.getElementById("pass2").value;
				
				if(pass1==pass2)
				{
					document.getElementById("pass_same").innerHTML = "Match";
					document.getElementById("pass_same").style.background = "Green";
					document.getElementById("pass_same").style.color = "White";
				}
				else
				{
					document.getElementById("pass_same").innerHTML = "No Match";
					document.getElementById("pass_same").style.background = "Red";
					document.getElementById("pass_same").style.color = "White";
				}
			}
		</script>
	</head>
	<body>

		<h1> Welcome to I<3 NEWS!</h1>
		<h2>Please login or sign up to continue</h2>
		<?php

			if($loggedin)
				print "Welcome, ". $_COOKIE["AppName"];
			else
				print "Not logged in.";

			if($message != "")

				print $message . "<br/><br/>";

		

		?>
		<div id='form1'>

		New User: 
		<form method="post" action="index.php" name="add_user">
			Username: <input type="text" name="name" id="add_name" /> <br/>
			Email: <input type="text" name="email" id="add_email" /> <br/>
			Password: <input type="text" name="password" id="pass1" /> <br/>
			Password (again): <input type="text" id="pass2" onKeyUp="check_pass()"/>
			
			<div id="pass_same" style="display:inline;">&nbsp;</div>
			<input type="hidden" name="action" value="add_user" /> <br/>
			<input type="Button" value="Go" onClick="validate()" />
		</form>
		</div>

		<div id=form2>

		Login: 
		<form method="post" action="index.php" name="login">
			Username: <input type="text" name="name" /> <br/>
			Password: <input type="text" name="password" /> <br/>
			<input type="hidden" name="action" value="login" />
		</form>

		<form method="LINK" action="news.php">
			<input type="submit" value="Go">
		</form>

		</div>
		<br/>
	</body>
</html>