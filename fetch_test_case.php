<?php
include 'db.php';

// Hardcoded project_id
$project_id = 1;

// SQL query to fetch the most recent record for project_id = 2
$sql = "SELECT 
            total_test_no_of_case AS total,
            num_of_pass_test_case AS passed,
            num_of_fail_test_case AS failed,
            total_time_to_run_test_case AS total_time_taken,
            current_date_and_time AS Date_take
        FROM testsuites
        WHERE project_id = $project_id
        ORDER BY suite_id DESC
        LIMIT 1";

$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
} else {
    $data = []; // Ensure $data is an empty array if no results
}

// Calculate percentages
$total = isset($data['total']) ? $data['total'] : 0;
$passed = isset($data['passed']) ? $data['passed'] : 0;
$failed = isset($data['failed']) ? $data['failed'] : 0;

$passedPercentage = ($total > 0) ? ($passed / $total) * 100 : 0;
$failedPercentage = ($total > 0) ? ($failed / $total) * 100 : 0;

// Add the calculated percentages to the data array
$data['passedPercentage'] = $passedPercentage;
$data['failedPercentage'] = $failedPercentage;

// Return data as JSON
header('Content-Type: application/json'); // Set content type to JSON
echo json_encode($data);

$conn->close();
?>
