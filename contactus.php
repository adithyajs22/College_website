<?php

$servername = "localhost";
$username = "root";        
$password = "";            
$dbname = "contact";   

$conn = new mysqli($servername, $username, $password, $dbname);
$name = $_POST['name'];
$email = $_POST['mail'];
$message = $_POST['msg'];
if ($conn->connect_error) {
    die("<p style='color:red;'>Connection failed: " . $conn->connect_error . "</p>");
}
$sql = "INSERT INTO contactus (name, email, message) VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
echo "<div style='
    border: 1px solid #ccc;
    padding: 15px;
    margin: 20px 0;
    border-radius: 8px;
    background-color: #f9f9f9;
    font-family: Arial, sans-serif;
'>";
echo "<p style='
    color: #006400; /* Dark Green */
    font-size: 1.1em;
    font-weight: bold;
    background-color: #e6ffe6; /* Light Green */
    padding: 10px;
    border-radius: 5px;
'>Your message is successfully submitted...<br></p>";

echo "<p style='
    color: #cc0000; 
    font-size: 1.2em;
    font-weight: bold;
    margin-top: 15px;
    border-bottom: 2px solid #eee;
    padding-bottom: 5px;'>Your submitted details are :</p>";

echo "<p style='margin-bottom: 5px;'>
    <strong><span style='color: #333;'>Your name:</span> </strong><span style='color: #00008b; font-weight: 500;'>".$name."</span>
</p>";
echo "<p style='margin-bottom: 5px;'>
    <strong><span style='color: #333;'>Your email:</span> </strong><span style='color: #00008b; font-weight: 500;'>".$email."</span>
</p>";

echo "<p style='
    color: #333;
    font-weight: bold;
    margin-top: 15px;
    margin-bottom: 5px;
'>Your message:</p>";
echo "<div style='
    border-left: 4px solid #007bff; /* Blue border for emphasis */
    padding: 10px;
    background-color: #ffffff;
    white-space: pre-wrap; /* Preserves formatting of the message */
    font-style: italic;
    color: #555;
'>".$message."</div>";
echo "</div>";
echo"<a href='students.html' style='color:white;display:inline-block;text-decoration:none;background-color:#024486 ;padding:9px 10px;border-radius: 5px;transition: background-color 0.3s;'>Go to Home</a>";

}
else {
    echo "<p style='color:red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
}

$conn->close();
?>