<?php
include('database_connection.php');

// Check if Certificate_ID is set
if(isset($_REQUEST['Certificate_ID'])) {
    $cid = $_REQUEST['Certificate_ID'];
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
            $cid = $_POST['cid'];

            // Prepare and execute the DELETE statement
            $stmt = $connection->prepare("DELETE FROM certificates WHERE Certificate_ID=?");
            $stmt->bind_param("i", $cid);

            if ($stmt->execute()) {
                echo "Record deleted successfully. <a href='certificates.php'>Go back to certificates</a>";
            } else {
                echo "Error deleting data: " . $stmt->error;
            }

            $stmt->close();
        }
        ?>
    </body>
    </html>
    <?php
} else {
    echo "Certificate_ID is not set.";
}

$connection->close();
?>

