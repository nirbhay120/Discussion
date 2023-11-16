<?php
session_start();
require("header.php");

if ($_SESSION["fn"] == null) {
    header("location:unreg.php");
    exit();
}

require("checkUser.php");

?>

<script type="text/javascript">
    document.getElementById("aforum").className = "active";
</script>

<?php
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

$topic_query = "SELECT * FROM topic";
$topic_result = $conn->query($topic_query);

while ($r1 = $topic_result->fetch_assoc()) {
    echo "<div class='heading'>" . $r1['topic_name'] . "</div>";

    $subtopic_query = "SELECT * FROM subtopic WHERE topic_id=" . $r1['topic_id'];
    $subtopic_result = $conn->query($subtopic_query);

    while ($r2 = $subtopic_result->fetch_assoc()) {
        echo "<div class='box'>";
        echo "<div class='sub-heading'>
                <a href='questions.php?id=" . $r2['subtopic_id'] . "'>" . $r2['subtopic_name'] . "</a>
            </div>";
        echo "<p>" . $r2['subtopic_description'] . "</p>";
        echo "</div>";
    }
}

// Close the connection
$conn->close();

?>

<?php require("footer.php"); ?>
