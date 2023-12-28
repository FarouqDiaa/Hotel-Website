<?php
include '../tools/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['guestId'])) {
        $guestId = $_POST['guestId'];

        $bookingQuery = "SELECT Booking_ID, staff_ID FROM booking WHERE guest_ID = ?";
        $stmt = $conn->prepare($bookingQuery);
        $stmt->bind_param("s", $guestId);
        $stmt->execute();
        $result = $stmt->get_result();

        $bookingData = array();
        while ($row = $result->fetch_assoc()) {
            $bookingData[] = $row;
        }

        echo json_encode($bookingData);
    } else {
        echo json_encode(array('error' => 'Guest ID not provided'));
    }
} else {
    echo json_encode(array('error' => 'Invalid request method'));
}

$conn->close();
?>
