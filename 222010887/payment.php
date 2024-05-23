<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="mystyle.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>payment</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: yellow;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */

      padding: 8px;
      
    }
    header{
    background-color:skyblue;
}
    section{
    padding:71px;
    border-bottom: 1px solid #ddd;
    }
    footer{
    text-align: center;
    padding: 15px;
    background-color:skyblue;
    }

  </style>
  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
  </head>

  <header>

<body bgcolor="chocolate">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
     <li style="display: inline; margin-right: 10px;">
    <img src="./images/LOGO.jpg" width="90" height="60" alt="Logo">  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Service.html">SERVICE</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./assessments.php">ASSESSMENTS</a>
  </li>
      <li style="display: inline; margin-right: 10px;"><a href="./attendees.php">ATTENDEES</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./certificates.php">CERTIFICATES</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./curriculum.php">CURRICULUM</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./digital marketing resource.php">DIGITAL MARKETING RESOURCE</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./instructors.php">INSTRUCTORS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./payment.php">PAYMENT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./workshops.php">WORKSHOPS</a>
  </li>
   <li style="display: inline; margin-right: 10px;"><a href="./feedback.php">FEEDBACK</a>
  </li>
  
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: yellow; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>

    <h1><u> payment Form </u></h1>
    <form method="post" onsubmit="return confirmInsert();">
            
        <label for="pid">Payment_ID:</label>
        <input type="number" id="pid" name="pid"><br><br>

        <label for="uid">User_ID:</label>
        <input type="number" id="uid" name="uid"><br><br>

        <label for="ap">Amount Paid:</label>
        <input type="number" id="ap" name="ap" required><br><br>

        <label for=pd>Payment Date:</label>
        <input type="date" id="pd" name="pd" required><br><br>

        <input type="submit" name="add" value="Insert">
      

    </form>


<?php
include('database_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO payment(  Payment_ID, User_ID, AmountPaid, PaymentDate) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $pid, $uid, $ap, $pd);
    // Set parameters and execute
    $pid = $_POST['pid'];
    $uid = $_POST['uid'];
    $ap = $_POST['ap'];
    $pd = $_POST['pd'];

      if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>

<?php
include('database_connection.php');

// SQL query to fetch data from the payment table
$sql = "SELECT * FROM payment";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of payment</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of payment</h2></center>
    <table border="5">
        <tr>
            <th>Payment_ID</th>
            <th>User_ID</th>
            <th>Amount Paid</th>
            <th>Payment Date</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
      include('database_connection.php');

        // Prepare SQL query to retrieve all payment
        $sql = "SELECT * FROM payment";
        $result = $connection->query($sql);

        // Check if there are any payment
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $pid = $row['Payment_ID']; // Fetch the Payment_ID
                echo "<tr>
                    <td>" . $row['Payment_ID'] . "</td>
                    <td>" . $row['User_ID'] . "</td>
                    <td>" . $row['AmountPaid'] . "</td>
                    <td>" . $row['PaymentDate'] . "</td>
                    <td><a style='padding:4px' href='delete_payment.php?Payment_ID=$pid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_payment.php?Payment_ID=$pid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
</body>

    </section>


  
<footer>
  <center> 
    <marquee behavior='alternate'>
    <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by: @Rita KAGABE</h2></b>
  </marquee>
  </center>
</footer>
</body>
</html>