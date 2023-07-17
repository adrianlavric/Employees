<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {

  $birth_date = $_POST["birth_date"];
  $first_name = $_POST["first_name"];
  $last_name = $_POST["last_name"];
  $gender = $_POST["gender"];
  $hire_date = $_POST["hire_date"];
  $salary = $_POST["salary"];


  $conn = new mysqli('localhost', 'root', '', 'Employees');
  
  if($conn->connect_error) {
    die('error: ' . $conn->connect_error);
  }

  $result = $conn->query("SELECT MAX(emp_no) AS max_id FROM Employees");
  $row = $result->fetch_assoc();
  $next_index = $row['max_id'] + 1;

  $sql = "INSERT INTO Employees (emp_no, birth_date, first_name, last_name, gender, hire_date) VALUES ('$next_index', '$birth_date', '$first_name', '$last_name', '$gender', '$hire_date');";
  $sql2 = "INSERT INTO Salaries (emp_no, salary, from_date, to_date) VALUES ('$next_index', '$salary', '$hire_date', CURDATE());";

  if($conn->query($sql) == TRUE && $conn->query($sql2) == TRUE) {
    echo "employee added successfully";
  } else {
    echo "error: " . $conn->error;
  }

  $conn->close();

}

?>