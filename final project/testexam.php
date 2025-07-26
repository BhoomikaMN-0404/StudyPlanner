<!DOCTYPE html>
<html>
<head>
    <title>test/exam</title>
    <link rel="stylesheet" type="text/css" href="subsel.css">
    <script>
	function message()
{
	const response = "Do you want to add another test/exam?";
        if(confirm(response))
{
	window.location.href="testexam.php";
}
	else{
	alert('your checklist is ready!!');
    
}
}
</script>
</head>
<body>
    <center>
        <form method="post" action="testexam.php">
            <h3>Add Upcoming test or exams</h3>
            <table>
                <tr>
                    <td>
            <input type="text" name="subject" placeholder="SUBJECT" required><br>
        </td>
    </tr>
    <tr>
        <td><label>Add Date:</label><br>
            <input type="date" name="date" required><br>
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
    if (isset($_POST['subject']) && isset($_POST['date'])) {
        $date = $_POST['date'];
        $subject = $_POST['subject'];
         $query = "SELECT Subject_ID FROM subjects WHERE Subname = '$subject'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) === 1) {
            // Subject already exists, fetch the subject ID
            $row = mysqli_fetch_assoc($result);
            $subjectId = $row['Subject_ID'];
        } else {
            // Subject doesn't exist, insert it into the subjects table
         $put = "INSERT INTO subjects (Subname) VALUES ('$subject')";
         $res = mysqli_query($con, $put);

        if ($res) {
        // Get the newly inserted subject ID using the mysqli_insert_id() function
        $subjectId = mysqli_insert_id($con);
        } 
        else {
        echo "Error inserting subject: " . mysqli_error($con);
            }
        }
        
            $query = "INSERT INTO exam (Email_ID, Subject_ID, test_date) VALUES ('$email', '$subjectId', '$date')";
             $insert = mysqli_query($con, $query);
        if(!$insert){
        echo "Query error: " . mysqli_error($con);
        echo "couldn't insert assignments";
    }
    
}
else{
echo "test/exam not provided";
}
}
?>

