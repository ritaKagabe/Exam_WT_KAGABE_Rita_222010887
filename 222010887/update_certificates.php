<?php

include('database_connection.php');

// Check if Certificate_ID is set
if(isset($_REQUEST['Certificate_ID'])) {
    $cid = $_REQUEST['Certificate_ID'];
    
    $stmt = $connection->prepare("SELECT * FROM certificates WHERE Certificate_ID=?");
    
    // Check if the prepare() method was successful
    if ($stmt === false) {
        die("Error preparing statement: " . $connection->error);
    }
    
    $stmt->bind_param("i", $cid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Certificate_ID'];
        $u = $row['Course_ID'];
        $y = $row['User_ID'];
        $z = $row['IssueDate'];
    } else {
        echo "Certificate not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update new record in certificates</title>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <h2><u>Update Form of certificates</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="cid">Course_ID:</label>
        <input type="number" name="cid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="uid">User_ID:</label>
        <input type="number" name="uid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="id">Issue Date:</label>
        <input type="date" name="id" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Course_ID = $_POST['cid'];
    $User_ID= $_POST['uid'];
    $IssueDate = $_POST['id'];
    
    // Update the product in the database
    $stmt = $connection->prepare("UPDATE certificates SET Course_ID=?, User_ID=?, IssueDate=? WHERE Certificate_ID=?");
    
    // Check if the prepare() method was successful
    if ($stmt === false) {
        die("Error preparing statement: " . $connection->error);
    }
    
    $stmt->bind_param("iisi", $Course_ID, $User_ID, $IssueDate, $cid);
    
    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }
    
    // Redirect to certificates.php
    header('Location:certificates.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
