<?php
include('database_connection.php');

// Check if Course_ID is set
if(isset($_REQUEST['Course_ID'])) {
    $cid = $_REQUEST['Course_ID'];
    
    $stmt = $connection->prepare("SELECT * FROM curriculum WHERE Course_ID=?");
    $stmt->bind_param("i", $cid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Course_ID'];
        $u = $row['Title'];
        $y = $row['Description'];
        $z = $row['Level'];
    } else {
        echo "curriculum not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update new record in curriculum</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update curriculum form -->
    <h2><u>Update Form of curriculum</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="tl">Title</label>
        <input type="text" name="tl" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="dn">Description:</label>
        <input type="text" name="dn" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=lv>Level:</label>
        <input type="text" name="lv" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Title = $_POST['tl'];
    $Description = $_POST['dn'];
    $Level = $_POST['lv'];
    
    
    // Update the curriculum in the database
    $stmt = $connection->prepare("UPDATE curriculum SET Title=?, Description=?, Level=? WHERE   Course_ID=?");
    $stmt->bind_param("sssi", $Title, $Description, $Level,  $cid);
    $stmt->execute();
    
    // Redirect to curriculum.php
    header('Location: curriculum.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
