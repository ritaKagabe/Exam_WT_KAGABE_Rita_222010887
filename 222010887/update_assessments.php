<?php
include('database_connection.php');

// Check if Assessment_ID is set
if(isset($_REQUEST['Assessment_ID'])) {
    $aid = $_REQUEST['Assessment_ID'];
    
    $stmt = $connection->prepare("SELECT * FROM assessments WHERE Assessment_ID=?");
    $stmt->bind_param("i", $aid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Assessment_ID'];
        $u = $row['Title'];
        $y = $row['Course_ID'];
        $z = $row['Questions'];
    } else {
        echo "assessments not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in assessments</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update customer form -->
    <h2><u>Update Form of assessments</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="tl">Title:</label>
        <input type="text" name="tl" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="cid">Course_ID:</label>
        <input type="number" name="cid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=qs>Questions:</label>
        <input type="text" name="qs" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Title = $_POST['tl'];
    $Course_ID = $_POST['cid'];
    $Questions = $_POST['qs'];
    
    // Update the assessments in the database
    $stmt = $connection->prepare("UPDATE assessments SET Title=?, Course_ID=?, Questions=? WHERE Assessment_ID=?");
    $stmt->bind_param("sssd", $Title,  $Course_ID, $Questions,$aid);
    $stmt->execute();
    
    // Redirect to assessments.php
    header('Location: assessments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
