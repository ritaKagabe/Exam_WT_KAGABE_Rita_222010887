<?php
include('database_connection.php');

// Check if Resource_ID is set
if(isset($_REQUEST['Resource_ID'])) {
    $rid = $_REQUEST['Resource_ID'];
    
    $stmt = $connection->prepare("SELECT * FROM digital_marketing_resource WHERE Resource_ID=?");
    $stmt->bind_param("i", $rid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Resource_ID'];
        $u = $row['Title'];
        $y = $row['Description'];
        $z = $row['URL'];
    } else {
        echo "Digital marketing resource not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in digital marketing resource</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update digital marketing resource form -->
    <h2><u>Update Form of digital marketing resource</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="tl">Title:</label>
        <input type="text" name="tl" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="dn">Description:</label>
        <input type="text" name="dn" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="ul">URL:</label>
        <input type="text" name="ul" value="<?php echo isset($z) ? $z : ''; ?>">
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
    $URL = $_POST['ul'];
    
    // Update the digital marketing resource in the database
    $stmt = $connection->prepare("UPDATE digital_marketing_resource SET Title=?, Description=?, URL=? WHERE Resource_ID=?");
    $stmt->bind_param("sssi", $Title, $Description, $URL, $rid);
    $stmt->execute();
    
    // Redirect to digital marketing resource.php
    header('Location: digital_marketing_resource.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
