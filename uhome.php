<?php
session_start();
require("header.php");
require("checkUser.php");

$servername = "localhost";
$username = "root";
$password = "";
$database = "tech_forum"; // Replace with your actual database name

// Create a MySQLi connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM question, user WHERE question.user_id=user.user_id ORDER BY datetime DESC LIMIT 0,5";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<span class='box2'>";
    echo "<span class='head'><a href='questionview.php?qid={$row['question_id']}'>{$row['heading']}</a></span>";
    echo "<table>";
    echo "<tr><td valign='top' width='100px'>
            <img src='{$row['uimg']}' alt='' class='uimg'/>
            <br/>
            {$row['fullname']}
        <td valign='top'>
            {$row['question_detail']}<br/><br/>
            {$row['datetime']}<br/><br/>
        </td></tr>";
    echo "</table></span><div class='h10'></div>";
}

// Close the connection
$conn->close();

require("footer.php");
?>
