<?php
include('database_connection.php');

// Check if Instructor_ID is set
if(isset($_REQUEST['Instructor_ID'])) {
    $iid = $_REQUEST['Instructor_ID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM instructors WHERE Instructor_ID=?");
    $stmt->bind_param("i", $iid);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="iid" value="<?php echo $iid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($stmt->execute()) {
        echo "Record deleted successfully.<a href='instructors.php'>Go back to instructors</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
}
?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "Instructor_ID is not set.";
}

$connection->close();
?>
