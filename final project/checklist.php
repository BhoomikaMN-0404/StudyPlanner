<html>
<head>
    <title>Your checklist</title>
    <link rel="stylesheet" type="text/css" href="checklist.css">
</head>
    <body>
        <?php
        session_start();
        if (!isset($_SESSION['email'])) {
        // If the user is not logged in, redirect them to the login page
        header("Location: login.html");
        exit();
        }
        $email = trim($_SESSION['email']);

        $con = new mysqli('localhost', 'root', '', 'organiser');
        if (!$con) {
        die("connection failed");
        }
// Retrieve assignments, deadlines, and subject names from the database
$query = "SELECT assignments.assignment, assignments.Deadline, subjects.Subject_ID, subjects.Subname
          FROM assignments
          INNER JOIN subjects ON assignments.Subject_ID = subjects.Subject_ID
          WHERE assignments.Email_ID = '$email'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $assignmentsBySubject = array();

    // Group assignments by subject ID
    while ($row = mysqli_fetch_assoc($result)) {
        $subjectId = $row['Subject_ID'];
        $assignment = $row['assignment'];
        $deadline = $row['Deadline'];
        $subname = $row['Subname'];

        if (!isset($assignmentsBySubject[$subjectId])) {
            $assignmentsBySubject[$subjectId] = array(
                'subject' => $subname,
                'assignments' => array()
            );
        }

        $assignmentsBySubject[$subjectId]['assignments'][] = array(
            'assignment' => $assignment,
            'deadline' => $deadline
        );
    }

    // Display assignments checklist
    foreach ($assignmentsBySubject as $subjectId => $subjectData) {
        $subject = $subjectData['subject'];
        $assignments = $subjectData['assignments'];

        echo "<h3>$subject</h3>";
        echo "<ul class='checklist'>";

        foreach ($assignments as $assignmentData) {
            $assignment = $assignmentData['assignment'];
            $deadline = $assignmentData['deadline'];

            echo "<li>";
            echo "<label>";
            echo "<input type='checkbox'>";
            echo "<span>$assignment</span>";
            echo "</label>";
            echo "<span class='deadline'>$deadline</span>";
            echo "</li>";
        }

        echo "</ul>";
    }
} else {
    echo "No assignments found.";
}
?>
</body>
</html>