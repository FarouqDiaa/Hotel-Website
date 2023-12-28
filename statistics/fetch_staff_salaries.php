<?php
include '../tools/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['position'])) {
        $position = $_POST['position'];

        $salaryQuery = "SELECT position, SUM(salary) AS total_salary FROM staff WHERE position = '$position' GROUP BY position";
        $result = $conn->query($salaryQuery);

        $salaryData = array();
        while ($row = $result->fetch_assoc()) {
            $salaryData[] = $row;
        }

        echo json_encode($salaryData);
    } else {
        echo json_encode(array('error' => 'Position not provided'));
    }
} else {
    echo json_encode(array('error' => 'Invalid request method'));
}

$conn->close();
?>
