<?php
include('database_connection.php');

// Check if Workshop_ID is set
if(isset($_REQUEST['Workshop_ID'])) {
    $wid = $_REQUEST['Workshop_ID'];
    
    $stmt = $connection->prepare("SELECT * FROM workshops WHERE Workshop_ID=?");
    $stmt->bind_param("i", $wid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Workshop_ID'];
        $u = $row['Title'];
        $y = $row['Description'];
        $z = $row['Date'];
    } else {
        echo "Workshop not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in workshops</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update workshops  form -->
    <h2><u>Update Form of workshops</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="tl">Title:</label>
        <input type="text" name="tl" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="dn">Description:</label>
        <input type="text" name="dn" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=dt> Date:</label>
        <input type="date" name="dt" value="<?php echo isset($z) ? $z : ''; ?>">
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
    $date = $_POST['dt'];
    
    // Update the workshops in the database
    $stmt = $connection->prepare("UPDATE workshops SET  Title=?, Description=?, Date=? WHERE  Workshop_ID=?");
    $stmt->bind_param("ssdii", $Title, $Description, $Date, $wid);
    $stmt->execute();
    
    // Redirect to workshops.php
    header('Location: workshops.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
