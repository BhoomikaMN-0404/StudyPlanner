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
    if (isset($_POST['subject']) && isset($_POST['subject_assignments']) && isset($_POST['deadlines'])) {
        $assignments = $_POST['subject_assignments'];
        $deadlines = $_POST['deadlines'];
        $subject = $_POST['subject'];
         $query = "SELECT Subject_ID FROM subjects WHERE Subname = '$subject'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) === 1) {
            // Subject already exists, fetch the subject ID
            $row = mysqli_fetch_assoc($result);
            $subjectId = $row['Subject_ID'];
        } else {
            // Subject doesn't exist, insert it into the subjects table
         $maxSubjectIdQuery = "SELECT MAX(Subject_ID) AS max_id FROM subjects";
             $maxSubjectIdResult = mysqli_query($con, $maxSubjectIdQuery);
             $maxSubjectIdRow = mysqli_fetch_assoc($maxSubjectIdResult);
             $nextSubjectId = $maxSubjectIdRow['max_id'] + 1;

            $insertQuery = "INSERT INTO subjects (Subject_ID,Subname) VALUES($nextSubjectId,'$subject')";
            mysqli_query($con, $insertQuery);

            // Get the newly inserted subject ID
            $subjectId = mysqli_insert_id($con);
        }
        
            $query = "INSERT INTO assignments (Email_ID, Subject_ID, assignment, Deadline) VALUES ('$email', '$subjectId', '$assignments', '$deadlines')";
             $insert = mysqli_query($con, $query);
        
        if($insert){
        
    echo "Assignments added successfully!";
    }
    else
    {
        echo "couldn't insert assignments";
    }
}
echo "assignments not provided";
}
?>

