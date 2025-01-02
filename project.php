<?php
include 'db.php';

// SQL query to fetch project details
$sql = "SELECT 
            project_id, 
            name, 
            logo, 
            link 
        FROM 
            projects";

$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
