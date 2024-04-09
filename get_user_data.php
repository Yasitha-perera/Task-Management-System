<?php
include('./database.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedUser = mysqli_real_escape_string($conn, $_POST['user']);

    $query = "SELECT status, count(*) as number FROM tasks WHERE uid = '$selectedUser' GROUP BY status";
    $result = mysqli_query($conn, $query);

    // Prepare data in an array for JSON response
    $data = array();
    $data[0] = ['status', 'Number'];


    $count=1;
    while ($row = mysqli_fetch_array($result)) {
    
        $data[$count] = [$row["status"], (int)$row["number"]];
        $count++;
    }
    
    // Send the JSON response
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Handle invalid requests
    http_response_code(400);
    echo "Invalid request.";
}
?>

