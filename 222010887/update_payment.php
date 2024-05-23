<?php
include('database_connection.php');

// Check if Payment_ID is set
if(isset($_REQUEST['Payment_ID'])) {
    $pid = $_REQUEST['Payment_ID'];
    
    $stmt = $connection->prepare("SELECT * FROM payment WHERE Payment_ID=?");
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Payment_ID'];
        $u = $row['User_ID'];
        $y = $row['AmountPaid'];
        $z = $row['PaymentDate'];
    } else {
        echo "payment not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in payment</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update customer form -->
    <h2><u>Update Form of payment</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="uid">User_ID:</label>
        <input type="number" name="uid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="ap">AmountPaid:</label>
        <input type="number" name="ap" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=pd>PaymentDate:</label>
        <input type="date" name="pd" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $User_ID = $_POST['uid'];
    $AmountPaid = $_POST['ap'];
    $PaymentDate = $_POST['pd'];
    
    // Update the payment in the database
    $stmt = $connection->prepare("UPDATE payment SET User_ID=?, AmountPaid=?, PaymentDate=? WHERE Payment_ID=?");
    $stmt->bind_param("sssd", $User_ID, $AmountPaid,$PaymentDate, $pid);
    $stmt->execute();
    
    // Redirect to payment.php
    header('Location: payment.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
