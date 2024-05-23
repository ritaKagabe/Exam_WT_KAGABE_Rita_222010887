<?php
include('database_connection.php');

// Check if Assessment_ID is set
if(isset($_REQUEST['Assessment_ID'])) {
    $aid = $_REQUEST['Assessment_ID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM assessments WHERE Assessment_ID=?");
    $stmt->bind_param("i", $aid);
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
            <input type="hidden" name="aid" value="<?php echo $aid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($stmt->execute()) {
                echo "Record deleted successfully.<a href='assessments.php'>Go back to assessments</a>";
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
    echo "Assessment_ID is not set.";
}

$connection->close();
?>
