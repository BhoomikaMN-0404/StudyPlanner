<?php
// Start the session
session_start();
if (!isset($_SESSION['email'])) {
    // If the user is not logged in, redirect them to the login page
    header("Location: login.php");
    exit();
}
$email=trim($_SESSION['email']);

$con=new mysqli('localhost','root','','organiser');
if(!$con)
{
    die("connection failed");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a database connection established

    // Retrieve the assignments, deadlines, and user's email from the form
    if(isset($_POST['subject_assignments'])){
    $assignments = $_POST['subject_assignments'];
    $deadlines = $_POST['deadlines'];
  
     // Retrieve the selected subjects and subject IDs from the session
    $subjectIds = $_SESSION['subject_ids'];

    // Insert the assignments into the assignments table
    

        // Insert the assignment, deadline, subject ID, and email into the assignments table
        $query = "INSERT INTO assignments (Email_ID, Subject_ID, assignment, Deadline) VALUES ('$email', '$assignmentString', '$subjectId', '$deadline')";
        mysqli_query($con, $query);
    }
    
    // Clear the session variables

    unset($_SESSION['subject_ids']);

    echo "Assignments added successfully!";

}
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Assignment Form</title>
    <link rel="stylesheet" type="text/css" href="subsel.css">
    <script src="next1.js"></script>
</head>
<body><center>
    <form method="post" action="assignments.php">
        <?php
        if (isset($_SESSION['subjects'])) {

            $subjects = $_SESSION['subjects'];
            foreach ($subjects as $subject) {
                $subject = htmlspecialchars($subject); // Prevent XSS attacks
                echo '<h3>Assignments for ' . $subject . '</h3>';
                echo '<div id="' . $subject . '_assignments"></div>';
                echo '<div id="' . $subject . '_deadlines"></div>';

                echo '<button type="button" onclick="addAssignment(\'' . $subject . '\')">Add Assignment</button><br><br>';
                
           }
    }
        else
        echo "No subjects were provided . please go back"
         ?>
         <input type="submit" value="Submit"></center>
    </form>
</body>
</html>

