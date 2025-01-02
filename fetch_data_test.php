<?php
include 'db.php';

// Get project_id from the request (e.g., query string or POST data)
$projects = 1;

// SQL query to fetch data filtered by project_id
$sql = "SELECT 
            name AS test_name, 
            num_of_pass_test_case AS pass_count, 
            num_of_fail_test_case AS fail_count 
        FROM testsuites
        WHERE project_id = $projects";

$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data = []; // Return an empty array if no results
}

// Close the database connection
$conn->close();

// Return data as JSON
header('Content-Type: application/json'); // Set content type to JSON
echo json_encode($data);
?>
