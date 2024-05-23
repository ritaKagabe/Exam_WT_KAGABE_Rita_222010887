<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="mystyle.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Assessments</title>
  <style>
    body {
      background-color: pink;
    }

    /* Navigation links */
    a {
      padding: 10px;
      color: white;
      background-color: yellow;
      text-decoration: none;
      margin-right: 15px;
      border-radius: 5px;
    }

    a:visited {
      color: purple;
    }

    a:link {
      color: brown; /* Changed to lowercase */
    }

    a:hover {
      background-color: white;
      color: black;
    }

    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }

    /* Extend margin left for search input */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */
      padding: 8px;
    }

    header {
      background-color: skyblue;
      padding: 15px;
    }

    section {
      padding: 71px;
      border-bottom: 1px solid #ddd;
    }

    footer {
      text-align: center;
      padding: 15px;
      background-color: skyblue;
    }

    /* Navigation list styling */
    ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    li {
      display: inline;
      margin-right: 10px;
    }

    .dropdown-contents {
      display: none;
      position: absolute;
      background-color: white;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }

    .dropdown-contents a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown:hover .dropdown-contents {
      display: block;
    }
  </style>
  <!-- JavaScript validation and content load for insert data -->
  <script>
    function confirmInsert() {
      return confirm('Are you sure you want to insert this record?');
    }
  </script>
</head>
<body>
  <header>
    <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <ul>
      <li><img src="./images/LOGO.jpg" width="90" height="60" alt="Logo"></li>
      <li><a href="./home.html">HOME</a></li>
      <li><a href="./about.html">ABOUT</a></li>
      <li><a href="./contact.html">CONTACT</a></li>
      <li><a href="./service.html">SERVICE</a></li>
      <li><a href="./assessments.php">ASSESSMENTS</a></li>
      <li><a href="./attendees.php">ATTENDEES</a></li>
      <li><a href="./certificates.php">CERTIFICATES</a></li>
      <li><a href="./curriculum.php">CURRICULUM</a></li>
      <li><a href="./digital_marketing_resource.php">DIGITAL MARKETING RESOURCE</a></li>
      <li><a href="./instructors.php">INSTRUCTORS</a></li>
      <li><a href="./payment.php">PAYMENT</a></li>
      <li><a href="./workshops.php">WORKSHOPS</a></li>
      <li><a href="./feedback.php">FEEDBACK</a></li>
      <li class="dropdown">
        <a href="#">Settings</a>
        <div class="dropdown-contents">
          <a href="login.html">Login</a>
          <a href="register.html">Register</a>
          <a href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </header>
  <section>
    <h1><u>Assessments Form</u></h1>
    <form method="post" onsubmit="return confirmInsert();">
      <label for="aid">Assessment_ID:</label>
      <input type="number" id="aid" name="aid"><br><br>

      <label for="tl">Title:</label>
      <input type="text" id="tl" name="tl"><br><br>

      <label for="cid">Course_ID:</label>
      <input type="number" id="cid" name="cid" required><br><br>

      <label for="qs">Questions:</label>
      <input type="text" id="qs" name="qs" required><br><br>

      <input type="submit" name="add" value="Insert">
    </form>

    <?php
    include('database_connection.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Prepare and bind the parameters
      $stmt = $connection->prepare("INSERT INTO assessments(Assessment_ID, Title, Course_ID, Questions) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("isis", $aid, $tl, $cid, $qs);
      // Set parameters and execute
      $aid = $_POST['aid'];
      $tl = $_POST['tl'];
      $cid = $_POST['cid'];
      $qs = $_POST['qs'];

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
    $sql = "SELECT * FROM assessments";
    $result = $connection->query($sql);
    ?>

    <center><h2>Table of Assessments</h2></center>
    <table border="5">
      <tr>
        <th>Assessment_ID</th>
        <th>Title</th>
        <th>Course_ID</th>
        <th>Questions</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
      include('database_connection.php');

      // Prepare SQL query to retrieve all assessments
      $sql = "SELECT * FROM assessments";
      $result = $connection->query($sql);

      // Check if there are any assessments
      if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
          $aid = $row['Assessment_ID']; // Fetch the Assessment_ID
          echo "<tr>
            <td>" . $row['Assessment_ID'] . "</td>
            <td>" . $row['Title'] . "</td>
            <td>" . $row['Course_ID'] . "</td>
            <td>" . $row['Questions'] . "</td>
            <td><a style='padding:4px' href='delete_assessments.php?Assessment_ID=$aid'>Delete</a></td> 
            <td><a style='padding:4px' href='update_assessments.php?Assessment_ID=$aid'>Update</a></td> 
          </tr>";
        }
      } else {
        echo "<tr><td colspan='6'>No data found</td></tr>";
      }
      // Close the database connection
      $connection->close();
      ?>
    </table>
  </section>

  <footer>
    <center>
      <marquee behavior='alternate'>
        <b><h2>UR CBE BIT &copy; 2024 &reg; Designer by: @Rita KAGABE</h2></b>
      </marquee>
    </center>
  </footer>
</body>
</html>
