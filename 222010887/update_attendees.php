<?php
include('database_connection.php');

// Check if Attendee_ID is set
if(isset($_REQUEST['Attendee_ID'])) {
    $aid = $_REQUEST['Attendee_ID']; // Changed variable name to $aid for consistency
    
    $stmt = $connection->prepare("SELECT * FROM attendees WHERE Attendee_ID=?");
    $stmt->bind_param("i", $aid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $u = $row['User_ID'];
        $y = $row['Workshop_ID'];
        $z = $row['RegistrationDate']; // Changed variable name to match database column name
    } else {
        echo "Attendee not found."; // Corrected error message
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Attendees</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update attendees form -->
    <h2><u>Update Form for Attendees</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="uid">User_ID:</label>
        <input type="number" name="uid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="wid">Workshop_ID:</label>
        <input type="number" name="wid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

         <label for="rd">Registration Date:</label>
        <input type="date" name="rd" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $User_ID = $_POST['uid'];
    $Workshop_ID = $_POST['wid'];
    $RegistrationDate = $_POST['rd'];
    
    // Update the attendees in the database
    $stmt = $connection->prepare("UPDATE attendees SET User_ID=?, Workshop_ID=?, RegistrationDate=? WHERE Attendee_ID=?");
    $stmt->bind_param("iisi", $User_ID, $Workshop_ID, $RegistrationDate, $aid);
    $stmt->execute();
    
    // Redirect to attendees.php
    header('Location: attendees.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
