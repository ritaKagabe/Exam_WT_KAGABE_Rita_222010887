<?php
include('database_connection.php');

// Check if Attendee_ID is set
if(isset($_REQUEST['Attendee_ID'])) {
    $tid = $_REQUEST['Attendee_ID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM attendees WHERE Attendee_ID=?");
    $stmt->bind_param("i", $tid);
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
            <input type="hidden" name="tid" value="<?php echo $tid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($stmt->execute()) {
                echo "Record deleted successfully.<a href='attendees.php'>Go back to attendees</a>";
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
    echo "Attendee_ID is not set.";
}

$connection->close();
?>
