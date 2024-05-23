<?php
include('database_connection.php');

// Check if Feedback_ID is set
if(isset($_REQUEST['Feedback_ID'])) {
    $bid = $_REQUEST['Feedback_ID']; // Changed variable name to $bid for consistency
    
    $stmt = $connection->prepare("SELECT * FROM feedback WHERE Feedback_ID=?");
    $stmt->bind_param("i", $bid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $u = $row['Course_ID'];
        $y = $row['User_ID'];
        $z = $row['Rating'];
    } else {
        echo "Feedback not found."; // Corrected error message
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Feedback</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update feedback form -->
    <h2><u>Update Form for Feedback</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="cid">Course_ID:</label>
        <input type="number" name="cid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="uid">User_ID:</label>
        <input type="text" name="uid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        
        <label for="rt">Rating:</label>
        <input type="text" name="rt" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Course_ID = $_POST['cid'];
    $User_ID = $_POST['uid'];
    $Rating = $_POST['rt'];
    
    // Update the feedback in the database
    $stmt = $connection->prepare("UPDATE feedback SET Course_ID=?, User_ID=?, Rating=? WHERE Feedback_ID=?");
    $stmt->bind_param("ssdi", $Course_ID, $User_ID, $Rating, $bid);
    $stmt->execute();
    
    // Redirect to feedback.php
    header('Location: feedback.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
