<!DOCTYPE html>
<html>
<head>
    <title>Assignment Form</title>
    <link rel="stylesheet" type="text/css" href="subsel.css">
    <script src="next1.js">
 </script>
</head>
<body>
    <center>
        <form method="post" action="ass2.php">
             <?php
        session_start();
        if (isset($_SESSION['subjects']) && isset($_SESSION['subject_ids'])) {
            $subjects = $_SESSION['subjects'];
            $subjectIds = $_SESSION['subject_ids'];

            if (!isset($_SESSION['current_subject_index'])) {
                $_SESSION['current_subject_index'] = 0;
            }

            $currentSubjectIndex = $_SESSION['current_subject_index'];
            $currentSubject = $subjects[$currentSubjectIndex];
            $currentSubjectId = $subjectIds[$currentSubjectIndex];

            echo '<h3>Assignments for ' . htmlspecialchars($currentSubject) . '</h3>';
            echo '<div id="' . htmlspecialchars($currentSubject) . '_assignments">
            </div>';
            echo '<div id="' . htmlspecialchars($currentSubject) . '_deadlines">
            </div>';

            echo '<button type="button" onclick="addAssignment(\'' . htmlspecialchars($currentSubject) . '\', \'' . htmlspecialchars($currentSubject) . '_assignments\', \'' . htmlspecialchars($currentSubject) . '_deadlines\')">Add Assignment</button><br><br>';

            if ($currentSubjectIndex < count($subjects) - 1) {
                echo '<br><input type="submit" name="next" value="Next">';
            } else {
                echo '<input type="submit" name="finish" value="Finish">';
            }

            $_SESSION['current_subject_id'] = $currentSubjectId;
            $_SESSION['subject_ids'] = $subjectIds;

        } else {
            echo "No subjects were provided. Please go back.";
        }
        ?>
                </form>
    </center>
</body>
</html>
