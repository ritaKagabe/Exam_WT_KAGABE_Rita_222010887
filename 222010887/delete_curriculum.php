<?php
include('database_connection.php');

// Check if Course_ID is set
if(isset($_REQUEST['Course_ID'])) {
    $cid = $_REQUEST['Course_ID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM curriculum WHERE Course_ID=?");
    $stmt->bind_param("i", $cid);
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
            <input type="hidden" name="cid" value="<?php echo $cid; ?>">
            <input type="submit" name="delete" value="Delete">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
            if ($stmt->execute()) {
                echo "Record deleted successfully. <a href='curriculum.php'>Go back to curriculum</a>";
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
    echo "Course_ID is not set.";
}

$connection->close();
?>
