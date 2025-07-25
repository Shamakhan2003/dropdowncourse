<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name = $_POST["student_name"];
    $age = $_POST["student_age"];
    $gender = $_POST["gender"];
    $course_id = $_POST["course_name"]; // This is actually the ID

    // Connect to database
    $conn = new mysqli("localhost", "root", "", "test");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (!is_numeric($course_id)) {
        die("Invalid course selected.");
    }

    $stmt = $conn->prepare("INSERT INTO students (s_name, s_age, gender, course_id) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sisi", $Name, $age, $gender, $course_id);

    if ($stmt->execute()) {
        echo "Student registration successful.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
