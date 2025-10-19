<?php
include('config.php');

$message = "";

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    if (!empty($id)) {
        $sql = "DELETE FROM students WHERE id='$id'";
    } elseif (!empty($name)) {
        $sql = "DELETE FROM students WHERE name='$name'";
    } else {
        $message = 'Please enter ID or Name to delete a record.';
    }

    if (isset($sql)) {
        $result = mysqli_query($conn, $sql);
        if (mysqli_affected_rows($conn) > 0) {
            $message = "Student deleted successfully!";
        } else {
            $message = "No student found with the given ID or Name.";
        }
    }
}

$all_students = mysqli_query($conn, "SELECT * FROM students ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Delete Student</title>
<style>
body {
  font-family: Arial, sans-serif;
  background-color: #f4f7fa;
  padding: 40px;
}
.container {
  max-width: 800px;
  margin: auto;
  background: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
}
h2 {
  text-align: center;
  color: #024486;
}
form {
  margin-bottom: 20px;
}
input {
  width: 100%;
  padding: 8px;
  margin: 8px 0;
  box-sizing: border-box;
}
button {
  width: 100%;
  background-color: #024486;
  color: white;
  border: none;
  padding: 10px;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 10px;
}
button:hover {
  background-color: #185adb;
}
a {
  display: inline-block;
  text-decoration: none;
  background-color: #024486;
  color: white;
  padding: 10px 15px;
  border-radius: 5px;
  text-align: center;
  margin-top: 10px;
}
a:hover {
  background-color: #185adb;
}
.message {
  text-align: center;
  color: #b60707ff;
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
  <h2>Delete Student Record</h2>

  <div class="message"><?php echo $message; ?></div>

  <form method="POST" action="">
    <label>Enter Student ID</label>
    <input type="number" name="id" placeholder="Enter Student ID (optional)">
    
    <label>Or Enter Student Name</label>
    <input type="text" name="name" placeholder="Enter Student Name">

    <button type="submit" name="delete">Delete Student</button>
  </form>

  <a href="students.html">Back to Students</a>

  <h2>All Students</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Register No</th>
      <th>Year</th>
      <th>Department</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($all_students)): ?>
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
</div>

</body>
</html>

<?php mysqli_close($conn); ?>
