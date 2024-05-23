<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="mystyle.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Certificates</title>
  <style>
    /* Styling links */
    a {
      padding: 10px;
      color: white;
      background-color: greenyellow;
      text-decoration: none;
      margin-right: 15px;
    }

    a:visited {
      color: purple;
    }

    a:link {
      color: brown;
    }

    a:hover {
      background-color: white;
    }

    a:active {
      background-color: red;
    }

    /* Styling for the search form */
    .form-control {
      padding: 8px;
      margin-top: 4px;
    }

    .btn {
      margin-top: 4px;
    }

    /* Header styling */
    header {
      background-color: skyblue;
      padding: 20px;
    }

    /* Navigation styling */
    .nav-list {
      list-style-type: none;
      padding: 0;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }

    .nav-list li {
      margin: 0 10px;
    }

    /* Section styling */
    section {
      padding: 20px;
      border-bottom: 1px solid #ddd;
    }

    /* Footer styling */
    footer {
      text-align: center;
      padding: 15px;
      background-color: skyblue;
    }

    /* Table styling */
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
      background-color: greenyellow;
    }
  </style>

  <!-- JavaScript validation and content load for insert data-->
  <script>
    function confirmInsert() {
      return confirm('Are you sure you want to insert this record?');
    }
  </script>
</head>
<body>
  <header>
    <form class="d-flex" role="search" action="search.php" style="display: flex; justify-content: flex-end;">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <ul class="nav-list">
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
      <li><a href="./feedback.php">FEEDBACK</a></li><br><br><br><br>
      <li class="dropdown">
        <a href="#" style="padding: 10px; color: white; background-color: greenyellow; text-decoration: none; margin-right: 15px;">Settings</a>
        <div class="dropdown-contents">
          <a href="login.html">Login</a>
          <a href="register.html">Register</a>
          <a href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </header>

  <section>
    <h1><u>Certificates Form</u></h1>
    <form method="post" onsubmit="return confirmInsert();">
      <label for="fid">Certificate_ID</label>
      <input type="number" id="fid" name="fid"><br><br>

      <label for="cid">Course_ID:</label>
      <input type="number" id="cid" name="cid"><br><br>

      <label for="uid">User_ID:</label>
      <input type="number" id="uid" name="uid" required><br><br>

      <label for="id">Issue Date:</label>
      <input type="date" id="id" name="id" required><br><br>

      <input type="submit" name="add" value="Insert">
    </form>

    <?php
    include('database_connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $stmt = $connection->prepare("INSERT INTO certificates(Certificate_ID, Course_ID, User_ID, IssueDate) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $fid, $cid, $uid, $id);

        $fid = $_POST['fid'];
        $cid = $_POST['cid'];
        $uid = $_POST['uid'];
        $id = $_POST['id'];

        if ($stmt->execute() == TRUE) {
            echo "New record has been added successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    $connection->close();
    ?>
  </section>

  <section>
    <h2><center>Table of Certificates</center></h2>
    <table>
      <tr>
        <th>Certificate_ID</th>
        <th>Course_ID</th>
        <th>User_ID</th>
        <th>Issue Date</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
      include('database_connection.php');

      $sql = "SELECT * FROM certificates";
      $result = $connection->query($sql);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $fid = $row['Certificate_ID'];
              echo "<tr>
                  <td>" . $row['Certificate_ID'] . "</td>
                  <td>" . $row['Course_ID'] . "</td>
                  <td>" . $row['User_ID'] . "</td>
                  <td>" . $row['IssueDate'] . "</td>
                  <td><a style='padding:4px' href='delete_certificates.php?Certificate_ID=$fid'>Delete</a></td>
                  <td><a style='padding:4px' href='update_certificates.php?Certificate_ID=$fid'>Update</a></td>
              </tr>";
          }
      } else {
          echo "<tr><td colspan='6'>No data found</td></tr>";
      }
      $connection->close();
      ?>
    </table>
  </section>

  <footer>
    <center>
      <marquee behavior="alternate">
        <b><h2>UR CBE BIT &copy; 2024 &reg; Designer by: @Rita KAGABE</h2></b>
      </marquee>
    </center>
  </footer>
</body>
</html>
