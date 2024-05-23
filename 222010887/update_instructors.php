<?php
include('database_connection.php');

// Check if Instructor_ID is set
if(isset($_REQUEST['Instructor_ID'])) {
    $iid = $_REQUEST['Instructor_ID'];
    
    $stmt = $connection->prepare("SELECT * FROM instructors WHERE Instructor_ID=?");
    $stmt->bind_param("i", $iid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Instructor_ID'];
        $u = $row['FullName'];
        $y = $row['Expertise'];
        $z = $row['Bio'];
    } else {
        echo "instructors not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in instructors</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update instructors form -->
    <h2><u>Update Form of instructors</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="fn">Full Name:</label>
        <input type="text" name="fn" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="ex">Expertise:</label>
        <input type="text" name="ex" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="bo">Bio:</label>
        <input type="text" name="bo" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $FullName = $_POST['fn'];
    $Expertise= $_POST['ex'];
    $Bio= $_POST['bo'];
    // Update the instructors in the database
    $stmt = $connection->prepare("UPDATE instructors SET FullName=?, Expertise=?,  Bio=? WHERE Instructor_ID=?");
    $stmt->bind_param("ssss", $FullName, $Expertise,$Bio, $iid);
    $stmt->execute();
    
    // Redirect to instructors.php
    header('Location: instructors.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
