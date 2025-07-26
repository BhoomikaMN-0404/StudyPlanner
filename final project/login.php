<?php
session_start();

$con=new mysqli('localhost','root','','organiser');
if(!$con)
{
	die("connection failed");
}
else 
	echo"connected";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the submitted email and password from the login form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare a SQL statement to retrieve the user's data based on the email
    $sql = "SELECT * FROM registration WHERE Email_ID = '$email'";
    $result = mysqli_query($con, $sql);

    // Check if a matching user was found
    if (mysqli_num_rows($result) === 1) {
            $_SESSION['email'] = $email;
        // Fetch the user's data
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if ($password === $user['Password']) {
            $_SESSION['FirstName'] = $user['FirstName'];
        	// Password is valid, redirect the user to the home page
        	echo
        	 "<script>
				alert('Welcome back Homie!!');
				window.location.href='home.php';
			  </script>";
            
            exit();
        }
    }

    // Display an error message if the email or password is invalid
    echo 
    "<script>
    alert('Invalid email or password entered');
    </script>";
}


?>
