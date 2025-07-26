
<!DOCTYPE html>
<html>
<head>
    <title>Assignment Form</title>
    <link rel="stylesheet" type="text/css" href="subsel.css">
    <script>
	function message()
{
	const response = "Do you want to add another subject/assignment?";
        if(confirm(response))
{
	window.location.href="ass5.php";
}
	else{
	alert('your checklist is ready!!');
}
}
</script>
</head>
<body>
    <center>
        <form method="post" action="ass2.php">
            <h3>Add your assignments</h3>
            <table>
                <tr>
                    <td>
            <input type="text" name="subject" placeholder="SUBJECT" required><br>
        </td>
    </tr><tr>
        <td>
            <input type="text" name="subject_assignments" placeholder="Assignment" required><br>
        </td>
    </tr>
    <tr>
        <td>
            <input type="date" name="deadlines" required><br>
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
