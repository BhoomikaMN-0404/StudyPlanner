<?php
// Start the session
session_start();
if (!isset($_SESSION['email'])) {
    // If the user is not logged in, redirect them to the login page
    header("Location: login.php");
    exit();
}
$email=$_SESSION['email'];

$con=new mysqli('localhost','root','','organiser');
if(!$con)
{
    die("connection failed");
}
else 
    echo"connected";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if (isset($_POST['subject'])){
    // Assuming you have a database connection established
    $selectedSubjects = $_POST['subject'];

    // Store the selected subjects in a session variable for later use
    $_SESSION['subject'] = $selectedSubjects;

    // Fetch the subject IDs for the selected and custom subjects
        $query = "SELECT Subject_ID FROM subjects WHERE Subname = '$selectedSubjects'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            // Subject already exists, fetch the subject ID
            $row = mysqli_fetch_assoc($result);
            $subjectId = $row['Subject_ID'];
        } else {
            // Subject doesn't exist, insert it into the subjects table
         $maxSubjectIdQuery = "SELECT MAX(Subject_ID) AS max_id FROM subjects";
             $maxSubjectIdResult = mysqli_query($con, $maxSubjectIdQuery);
             $maxSubjectIdRow = mysqli_fetch_assoc($maxSubjectIdResult);
             $nextSubjectId = $maxSubjectIdRow['max_id'] + 1;

            $insertQuery = "INSERT INTO subjects (Subject_ID,Subname) VALUES($nextSubjectId,'$selectedSubjects')";
            mysqli_query($con, $insertQuery);

            // Get the newly inserted subject ID
            $subjectId = mysqli_insert_id($con);
        }

        $subjectIds = $subjectId;
    }

    // Store the subject IDs in a session variable for later use
    $_SESSION['subject_ids'] = $subjectIds;

    // Redirect to the next page
    header("Location: ass5.php");
    exit();
}
elseif (isset($_POST['custom_subjects']) && trim($_POST['custom_subjects']) !== '') {

    // code...
        
        $customSubjects = explode("\n", $_POST['custom_subjects']);
     
    if(!empty($customSubjects))
    {
        $allSubjects =  $customSubjects;
    }
    else{
        echo 'No subjects were provided please select or type a subject';
    }
        
    // Store the selected subjects in a session variable for later use
    $_SESSION['subject'] = $allSubjects;

    // Fetch the subject IDs for the selected and custom subjects
    $subjectIds = array();
    foreach ($allSubjects as $subject) {
        // Check if the subject already exists in the subjects table
        $query = "SELECT Subject_ID FROM subjects WHERE Subname = '$subject'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
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

        $subjectIds[] = $subjectId;
    }

    // Store the subject IDs in a session variable for later use
    $_SESSION['subject_ids'] = $subjectIds;

    // Redirect to the next page
    header("Location: ass5.php");
    exit();
}

else
{
    echo "<script>
        alert('No subjects provided. Please select or type atleast one subject');
        window.location.href='subsel.html';
        </script>";
}

?>


