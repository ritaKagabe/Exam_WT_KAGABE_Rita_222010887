<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {
include('database_connection.php');


    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'assessments' => "SELECT Questions FROM assessments WHERE Questions  LIKE '%$searchTerm%'",
        'attendees' => "SELECT RegistrationDate FROM attendees WHERE RegistrationDate LIKE '%$searchTerm%'",
        'certificates' => "SELECT IssueDate FROM certificates WHERE IssueDate LIKE '%$searchTerm%'",
        'curriculum' => "SELECT Level FROM curriculum WHERE Level LIKE '%$searchTerm%'",
        'digital_marketing_resource' => "SELECT Title FROM digital_marketing_resource WHERE Title LIKE '%$searchTerm%'",
        'payment' => "SELECT AmountPaid FROM payment WHERE AmountPaid LIKE '%$searchTerm%'",
        'workshops' => "SELECT  Description FROM workshops WHERE Description LIKE '%$searchTerm%'"
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
