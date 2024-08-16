<?php
// Database connection
include 'db.php';
// SQL Query





$testSql = "
    SELECT urls.url_id As Url_id ,
    urls.case_id As Case_id,
    urls.url_1 AS production_link, 
           urls.url_2 AS uat_link, 
           testcases.status, 
           testcases.time_taken, 
           testcases.error_message, 
           testcases.name,
           testsuites.suite_id, 
           testsuites.name AS suite_name
    FROM urls
    JOIN testcases ON urls.case_id = testcases.case_id
    JOIN testsuites ON testcases.suite_id = testsuites.suite_id
";


$testResult = $conn->query($testSql);

$data = array();

if ($testResult->num_rows > 0) {
    while ($row = $testResult->fetch_assoc()) {
        $data[] = $row;
    }
} 


echo json_encode($data);

$conn->close();
?>
