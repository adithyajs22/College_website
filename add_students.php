<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $date_of_birth = mysqli_real_escape_string($conn, $_POST['dob']);
    $regno = mysqli_real_escape_string($conn, $_POST['Regno']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $agree_terms = isset($_POST['condition']) ? 1 : 0;

   
    $check_sql = "SELECT * FROM students WHERE email = '$email'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        echo "<h3 style='color:#ff0048;'>Error: This email is already registered!</h3><br>";
        echo "<a href='add_students.html' style='
            display:inline-block;
            background-color:#c40239;
            color:white;
            padding:8px 15px;
            border-radius:5px;
            text-decoration:none;
            font-weight:bold;'>Go Back</a>";
    } else {
        $sql = "INSERT INTO students (name, email, dob, regno, year, department, condition_agreed)
                VALUES ('$name', '$email', '$date_of_birth', '$regno', '$year', '$department', '$agree_terms')";

        if ($conn->query($sql) === TRUE) {
            echo "<h3 style='color:#0712eb;justify-content:center;box: shadox 2px;'>Student registered successfully!</h3><br>";
            echo "<a href='view_students.php' style='
                display:inline-block;
                background-color:#0f0f5b;
                color:white;
                padding:8px 15px;
                border-radius:5px;
                text-decoration:none;
                font-weight:bold;'>View Students</a>";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    $conn->close();
}
?>
