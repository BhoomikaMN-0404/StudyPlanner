<?php
$con = new mysqli('localhost','root','','organiser');
if(!$con)
{
	die("connection failed");
}
else
echo "connected";

$FName = $_POST['fname'];
$LName = $_POST['lname'];
$Contact = $_POST['phone'];
$Email = $_POST['email'];
$PW = $_POST['password1'];
$Confirm_PW = $_POST['password2'];

$sql1 = "SELECT * FROM registration WHERE Email_ID = '$Email'";
$result = mysqli_query($con, $sql1);
// Check if a matching user was found
if (mysqli_num_rows($result) === 1) 
{

	echo "<script>
	alert('user already exists');
	window.location.href='SignUp.html';
	</script>";
}
if($PW === $Confirm_PW)
{
		$sql = "INSERT INTO registration VALUES ('$FName', '$LName', '$Contact','$Email', '$PW')";

 		$rs = mysqli_query($con, $sql);

		if($rs)
		{
			echo "<script>
			alert('Registered Successfully');
			window.location.href='login.html';
			</script>";
	
		}
		else 
			echo"couldn't insert record";

}
else
{
	echo "<script>
    alert('Password does not match');
    window.location.href='SignUp.html';
    </script>";
}

?>