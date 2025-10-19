<?php
include('config.php');

$search = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT * FROM students 
            WHERE name LIKE '%$search%' 
            OR email LIKE '%$search%' 
            OR regno LIKE '%$search%' 
            OR department LIKE '%$search%'
            ORDER BY id ASC";
} else {
    $sql = "SELECT * FROM students ORDER BY id ASC";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>View Students</title>
<style>
body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background-color: #f0f4f8;
    padding: 40px;
    margin: 0;
}
.container {
    max-width: 950px;
    margin: auto;
    background: white;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    padding: 25px;
}
h2 {
    text-align: center;
    color: #024486;
    margin-bottom: 25px;
}
.search-box {
    text-align: center;
    margin-bottom: 20px;
}
.search-box input[type="text"] {
    padding: 10px 15px;
    width: 60%;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
}
.search-box button {
    padding: 10px 18px;
    background-color: #024486;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    margin-left: 5px;
    transition: all 0.3s ease;
}
.search-box button:hover {
    background-color: #185adb;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
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
tr:nth-child(even) { background-color: #f9f9f9; }
.message {
    text-align: center;
    font-size: 18px;
    margin: 30px 0;
}
a {
    display: inline-block;
    padding: 10px 20px;
    margin: 10px;
    text-decoration: none;
    color: white;
    background-color: #024486;
    border-radius: 6px;
    font-weight: bold;
}
a:hover { opacity: 0.9; }
.add-btn { background-color: #0264d6; }
.home-btn { background-color: #042e4d; }
</style>
</head>
<body>

<div class="container">
    <h2>Registered Students</h2>

    <form class="search-box" method="GET" action="">
        <input type="text" name="search" placeholder="Search by name, email, regno, or department" 
               value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Search</button>
        <?php if (!empty($search)): ?>
            <a href="view_students.php" style="background-color:#999;">Reset</a>
        <?php endif; ?>
    </form>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Register Number</th>
                <th>Year</th>
                <th>Department</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['regno']); ?></td>
                <td><?php echo htmlspecialchars($row['year']); ?></td>
                <td><?php echo htmlspecialchars($row['department']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <div class="message">
            <?php if (!empty($search)): ?>
                <p>No students found matching "<strong><?php echo htmlspecialchars($search); ?></strong>".</p>
            <?php else: ?>
                <p>No students found yet!</p>
                <a href="add_students.html" class="add-btn">Add New Student</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div style="text-align:center;">
        <a href="students.html" class="home-btn">Back to Menu</a>
    </div>
</div>

</body>
</html>

<?php mysqli_close($conn); ?>
