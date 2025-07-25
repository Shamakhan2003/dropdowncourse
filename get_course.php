<?php
$conn = new mysqli("localhost", "root", "", "test");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, course_name FROM course";
$result = $conn->query($sql);

$courses = array();
while ($row = $result->fetch_assoc()) {
    $courses[] = $row;
}

header('Content-Type: application/json');
//show the data from  course 
echo json_encode($courses);

$conn->close();
?>
