<?php
$conn = new mysqli('localhost', 'root', '', 'Employees');

if ($conn->connect_error) {
    die("Error: " . $conn->connect_error);
}

$sql = "SELECT emp_no FROM Employees";
$result = $conn->query($sql);
$employees = array();

$i = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[$i++] = $row['emp_no'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emp_no = $_POST['emp_no'];
    $salary = $_POST['salary'];

    $sql = "UPDATE Salaries SET salary='$salary' WHERE emp_no='$emp_no'";

    if ($conn->query($sql) === TRUE) {
        echo "Salary updated successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>