<?php
include('config.php');

$student = null;
$message = "";

if (isset($_POST['fetch'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    if (!empty($id)) {
        $sql = "SELECT * FROM students WHERE id='$id'";
    } elseif (!empty($name)) {
        $sql = "SELECT * FROM students WHERE name='$name'";
    } else {
        $sql = "";
    }

    if (!empty($sql)) {
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $student = mysqli_fetch_assoc($result);
        } else {
            $message = "No student found!";
        }
    } else {
        $message = "Please enter ID or Name to fetch details.";
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id_hidden'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $regno = $_POST['Regno'];
    $year = $_POST['year'];
    $department = $_POST['department'];

    $sql = "UPDATE students SET 
                name='$name',
                email='$email',
                regno='$regno',
                year='$year',
                department='$department'
            WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        $message = "Student updated successfully!";
    } else {
        $message = "Error updating record!";
    }
}

$sql_all = "SELECT * FROM students ORDER BY id ASC";
$result_all = mysqli_query($conn, $sql_all);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Update Student</title>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f7fa;
    padding: 40px;
}
.container {
    max-width: 900px;
    margin: auto;
    background: white;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    padding: 20px;
}
h2 {
    text-align: center;
    color: #024486;
}
form {
    margin-bottom: 20px;
}
label {
    font-weight: bold;
    display: block;
    margin-top: 10px;
}
input, select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    box-sizing: border-box;
}
button {
    background-color: #024486;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px ;
    width:80%;
}
button:hover {
    background-color: #185adb;
}
a {
    display: inline-block;
    text-decoration: none;
    color: white;
    background-color: #024486;
    padding: 10px 15px;
    border-radius: 5px;
    margin: 10px ;
}
a:hover {
    background-color: #185adb;
}
.message {
    text-align: center;
    color: #138509ff;
    font-weight: bold;
    margin-bottom: 15px;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}
th {
    background-color: #024486;
    color: white;
}
tr:nth-child(even) {
    background-color: #f9f9f9;
}
</style>
</head>
<body>

<div class="container">
  <h2>Update Student Details</h2>

  <div class="message"><?php echo $message; ?></div>

  <form method="POST" action="">
      <label>Enter Student ID</label>
      <input type="number" name="id" placeholder="Enter ID">

      <label>OR Enter Student Name</label>
      <input type="text" name="name" placeholder="Enter Name">

      <button type="submit" name="fetch">Fetch Details</button>
  </form>

  <a href="students.html">Back to Students</a>

  <?php if ($student): ?>
  <form method="POST" action="">
      <input type="hidden" name="id_hidden" value="<?php echo $student['id']; ?>">

      <label>Name</label>
      <input type="text" name="name" value="<?php echo $student['name']; ?>" required>

      <label>Email</label>
      <input type="email" name="email" value="<?php echo $student['email']; ?>" required>

      <label>Register Number</label>
      <input type="text" name="Regno" value="<?php echo $student['regno']; ?>" required>

      <label>Year</label>
      <select name="year" required>
          <option value="1" <?php if($student['year']=='1') echo 'selected'; ?>>1</option>
          <option value="2" <?php if($student['year']=='2') echo 'selected'; ?>>2</option>
          <option value="3" <?php if($student['year']=='3') echo 'selected'; ?>>3</option>
          <option value="4" <?php if($student['year']=='4') echo 'selected'; ?>>4</option>
      </select>

      <label>Department</label>
      <input type="text" name="department" value="<?php echo $student['department']; ?>" required>

      <button type="submit" name="update">Update Student</button>
  </form>
  <?php endif; ?>

  <h2>All Students</h2>
  <?php if (mysqli_num_rows($result_all) > 0): ?>
      <table>
          <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Register No</th>
              <th>Year</th>
              <th>Department</th>
          </tr>
          <?php while ($row = mysqli_fetch_assoc($result_all)): ?>
          <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <td><?php echo $row['regno']; ?></td>
              <td><?php echo $row['year']; ?></td>
              <td><?php echo $row['department']; ?></td>
          </tr>
          <?php endwhile; ?>
      </table>
  <?php else: ?>
      <p>No students found!</p>
  <?php endif; ?>
</div>

</body>
</html>

<?php mysqli_close($conn); ?>
