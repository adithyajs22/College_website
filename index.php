<?php
$name = $_POST['name'];
$email = $_POST['mail'];
$message = $_POST['msg'];
$servername = "localhost";
$username = "root";        
$password = "";            
$dbname = "contact_us";   

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("<p style='color:red;'>Connection failed: " . $conn->connect_error . "</p>");
}
if ($conn->query($sql) === TRUE) {
$sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";
echo"<p style='color: blue; font-size:16px;'>Your message is successfully submitted...<br></p>";
echo"<p style='color: red; font-size: 18px;'>Your submitted details are :</p>";
echo"<strong>Your name: </strong>".$name."<br>";
echo"<strong>Your email: </strong>".$email."<br>";
echo"<strong>Your message: "."<br></strong>".$message;
}
else {
    echo "<p style='color:red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
}

$conn->close();
?>