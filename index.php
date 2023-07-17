<?php

  $conn = new mysqli('localhost', 'root', '', 'Employees');
  
  if ($conn->connect_error) {

    die('error: ' . $conn->connect_error);
  
  }

  $sql = 'SELECT emp_no, birth_date, first_name, last_name, gender, hire_date FROM employees';
  $sal = 'SELECT emp_no, salary, to_date FROM salaries';

  $result = $conn->query($sql);
  $result2 = $conn->query($sal);

  $conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employees</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  
  <h1>Employees</h1>

  <table>

    <tr>

      <th>ID</th>
      <th>Birth Date</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Gender</th>
      <th>Work Period</th>
      <th>Salary</th>

    </tr>

    <?php
  
      if($result->num_rows > 0 && $result2->num_rows > 0) {


        while($row = $result->fetch_assoc()) {

          $row2 = $result2->fetch_assoc();

          echo '<tr>';

          echo '<td>' . $row['emp_no'] . '</td>'; 
          echo '<td>' . $row['birth_date'] . '</td>'; 
          echo '<td>' . $row['first_name'] . '</td>'; 
          echo '<td>' . $row['last_name'] . '</td>'; 
          echo '<td>' . $row['gender'] . '</td>'; 
          echo '<td>' . $row['hire_date'] . ' - ' . $row2['to_date'] . '</td>'; 
          echo '<td>' . $row2['salary'] . '</td>';

          echo '</tr>';

        }

      } else {

        echo "<tr> <td colspan='6'>Nu exista niciun angajat.</td> </tr>";

      }
      
    ?>

  </table>


  <h1>Add employee</h1>

  <form action='adauga.php' method='POST'>

    <label for='birth_date'>Birth Date:</label>
    <input type='date' id='birth_date' name='birth_date' required> <br>

    <label for='first_name'>First Name:</label>
    <input type="text" id='first_name' name='first_name' required> <br>

    <label for="last_name">Last Name: </label>
    <input type="text" id='last_name' name='last_name' required> <br>

    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
      <option value="M">Male</option>
      <option value="F">Female</option>
    </select> <br>

    <label for="hire_date">Hire Date:</label>
    <input type="date" id="hire_date" name="hire_date" required> <br>

    <label for="salary">Salary: </label>
    <input type="number" id='salary' name='salary' required> <br>

    <input type="submit" value='Add employee'>

  </form>


  <h1>Modify employee salary</h1>
  
  <form action="modifica.php" method="POST">
    <label for="emp_no">Employee Number:</label>
    <select name="emp_no">
        <?php foreach ($employees as $emp_no) : ?>
            <option value="<?php echo $emp_no; ?>"><?php echo $emp_no; ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="salary">Salary:</label>
    <input type="number" name="salary"><br><br>

    <input type="submit" value="Modify Salary">
</form>
  
</body>
</html>