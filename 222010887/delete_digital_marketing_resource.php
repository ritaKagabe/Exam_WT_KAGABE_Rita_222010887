<?php
include('database_connection.php');

// Check if Resource_ID is set
if(isset($_REQUEST['Resource_ID'])) {
    $rid = $_REQUEST['Resource_ID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM digital_marketing_resource WHERE Resource_ID=?");
    $stmt->bind_param("i", $rid);
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
            <input type="hidden" name="rid" value="<?php echo $rid; ?>">
            <input type="submit" name="delete" value="Delete">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
            if ($stmt->execute()) {
                echo "Record deleted successfully. <a href='digital_marketing_resource.php'>Go back to digital marketing resource</a>";
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
    echo "Resource_ID is not set.";
}

$connection->close();
?>

