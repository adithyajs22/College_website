<?php
$conn = new mysqli("localhost", "root", "", "student");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM students WHERE id = $delete_id");
    header("Location: view_students.php"); 
    exit();
}

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";

if ($keyword != "") {
    $sql = "SELECT * FROM students 
            WHERE name LIKE '%$keyword%' 
               OR email LIKE '%$keyword%' 
               OR department LIKE '%$keyword%'";
} else {
    $sql = "SELECT * FROM students";
}

$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
    <link rel="stylesheet"type="text/css" href="view_students.css">
</head>
<body>
    <h2>Student List</h2>
    <a class="home-but" href = login_students.html>Home</a>
    <form method="get" action="view_students.php">
        <input type="text" name="keyword" placeholder="Search by name, email or department" 
               value="<?php echo htmlspecialchars($keyword); ?>">
        <button type="submit">Search</button>
       
        <a href="view_students.php">Reset</a>
    </form>
    <br>

    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='8'>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Department</th>
                      <th>Action</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row['id']."</td>
                    <td>".$row['name']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['date_of_birth']."</td>
                    <td>".$row['gender']."</td>
                    <td>".$row['department']."</td>
                     <td>
                <a href='view_students.php?delete_id=".$row['id']."' 
                   onclick=\"return confirm('Are you sure you want to delete this student?');\">
                   Delete
                </a>
            </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No students found.";
    }

    $conn->close();
    ?>
</body>
</html>
