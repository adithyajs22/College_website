<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$date_of_birth = $_POST['dob'];
$gender = $_POST['gender'];
$department = $_POST['department'];
$agree_terms = isset($_POST['condition']) ? 1 : 0;


$check_sql = "SELECT * FROM students WHERE email = '$email'";
$result = $conn->query($check_sql);

if ($result->num_rows > 0) {
   
    echo "<h3 style='color:#ff0048;'>Error: This email is already registered!</h3><br>";
    echo "<a href='login_students.html' style='
        display:inline-block;
        background-color:#c40239;
        color:white;
        padding:8px 15px;
        border-radius:5px;
        text-decoration:none;
        font-weight:bold;'>Go Back</a>";
} else {
   
    $sql = "INSERT INTO students (name, email, date_of_birth, gender, department, agree_terms)
            VALUES ('$name', '$email', '$date_of_birth', '$gender', '$department', '$agree_terms')";

    if ($conn->query($sql) === TRUE) {
        echo "<h3 style='color:#0712eb;'>Student registered successfully!</h3><br>";
        echo "<a href='view_students.php' style='
            display:inline-block;
            background-color:#0f0f5b;
            color:white;
            padding:8px 15px;
            border-radius:5px;
            text-decoration:none;
            font-weight:bold;'>View Students</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
