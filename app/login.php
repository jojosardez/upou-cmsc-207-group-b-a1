<?php
// Start the session for account
session_start();

//  Intitialize value from login form
$input = json_decode(file_get_contents('php://input'), true);
$username = $input['username'];
$password = $input['password'];

?>

<?php
// var con -> establish a connection to database assignment1db
$con =   mysqli_connect('localhost', 'root' ,'', 'assignment1db');
	// test if you can connect to database | if not die
	if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
	}
	// Prepare statement to test if input $username is available in the database
	$sql = "SELECT loginattempts FROM users WHERE username='" . $username . "'";
	
	// result -> is the result of the query of $sql
	$result = mysqli_query($con, $sql);
	
	// test if the $result is not null | Must return one row from database
	if (mysqli_num_rows($result) > 0) {
        echo var_dump($result);
		while($row = mysqli_fetch_assoc($result)) {
			// Test if the user has less than or 3 attempts
			if($row["loginattempts"] < 3) {
				// Prepare a statement to test if the $username and $password is correct
				$sql = "SELECT * FROM users WHERE username='" . $username . "' AND password='" . password_hash($password, PASSWORD_DEFAULT) . "'";
				// result -> is the result of the query
				$result = $con->query($sql);
				// test if the result is not null | Must return one value
				if ($result->num_rows > 0) {
					// print a JSON "true" | will be read by login.js
					print_r(json_encode(array(1,"You have login successfully")));
					// row is the asociated result from db
					// since username in users table was Unique | Max value for $row was 1
					while($row = $result->fetch_assoc()) {
						// set the session for current user | set session "CURRENT_user" as 'id' from table users
						$_SESSION['CURRENT_user']=$row['id'];
					}
				// Username and password is not in the users table
				}else {
					
					// Prepare statement to test if input $username is available in the database
					$sql = "SELECT loginattempts FROM users WHERE username='" . $username . "'";

					// result -> is the result of the query of $sql
					$result = $con->query($sql);

					// test if the $result is not null | Must return one row from database
					
					if ($result->num_rows > 0) {
						$loginattempts = 0;
						while($row = $result->fetch_assoc()) {
							$loginattempts = $row['loginattempts'];
						}
						
						$sql = "UPDATE users SET loginattempts = " . $loginattempts . " WHERE username='" . $username . "'";
						// result -> is the result of the query of $sql
						$result = $con->query($sql);
						
					}
					
					// print a JSON  "false" | will be read by login.js
					print_r(json_encode(array(0,"Username and password invalid.")));
				}
			}
			// login attempts is greater than 3 attempts
			else {
				print_r(json_encode(array(0,"You have login for 3 times.")));
			}
		}
	}
	// Username doesn't exist in the table users
	else {
		// print a JSON "false" | will be read by login.js
		print_r(json_encode(array(0,"Username and password invalid.")));
	}
	
	$con->close();
?>