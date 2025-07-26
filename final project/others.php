<!DOCTYPE html>
<html>
<head>
    <title>other tasks</title>
    <link rel="stylesheet" type="text/css" href="subsel.css">
    <script>
	function message()
{
	const response = "Do you want to add another task?";
        if(confirm(response))
{
	window.location.href="others.php";
}
	else{
	alert('your checklist is ready!!');
    
}
}
</script>
</head>
<body>
    <center>
        <form method="post" action="others.php">
            <h3>Add your assignments</h3>
            <table>
                <tr>
                    <td>
            <input type="text" name="task" placeholder="Enter task" required><br>
        </td>
    </tr>
    <tr>
        <td><label>Add deadline:</label><br>
            <input type="date" name="deadlines"><br>
        </td>
    </tr>
    <tr>
        <td>
            <center><button type="submit" onclick="message()">Next</button></center>
        </td>
    </tr>
</table>
        </form>
    </center>

   
</body>
</html>
<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
$email = trim($_SESSION['email']);

$con = new mysqli('localhost', 'root', '', 'organiser');
if (!$con) {
    die("connection failed");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['task']) && isset($_POST['deadlines'])) {
        $task = $_POST['task'];
        $deadlines = $_POST['deadlines'];
        $query = "INSERT INTO tasks (Email_ID, task, Deadline) VALUES ('$email', '$task', '$deadlines')";
             $insert = mysqli_query($con, $query);
        if(!$insert){
        echo "Query error: " . mysqli_error($con);
        echo "couldn't insert tasks";
    }
    
}
else{
echo "tasks not provided";
}
}
?>

