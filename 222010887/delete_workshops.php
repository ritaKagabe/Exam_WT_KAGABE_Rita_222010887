<?php
include('database_connection.php');

// Check if Workshop_ID is set
if(isset($_REQUEST['Workshop_ID'])) {
    $wid = $_REQUEST['Workshop_ID']; // Correct variable name
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM workshops WHERE Workshop_ID=?");
    $stmt->bind_param("i", $wid); // Correct variable name
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
            <input type="hidden" name="Workshop_ID" value="<?php echo $wid; ?>"> <!-- Correct hidden input name -->
            <input type="submit" value="Delete">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if ($stmt->execute()) {
                echo "Record deleted successfully.<a href='workshops.php'>Go back to workshops</a>";
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
    echo "Workshop_ID is not set.";
}

$connection->close();
?>

