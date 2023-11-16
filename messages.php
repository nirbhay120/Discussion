<?php
session_start();
require("header.php");
require("checkUser.php");
?>
<script type="text/javascript">
    document.getElementById("amessage").className = "active";
</script>

<a href="search.php">Send New Message</a>
<hr/>

<?php
// Create a MySQLi connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "tech_forum"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// First, fetch chats where you have sent messages
$sql = "SELECT chat_id, user_id_from, user_id_to, fullname FROM Chatmaster, user WHERE chatmaster.user_id_to=user.user_id AND chatmaster.user_id_from=$_SESSION[uid]";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<a href='readmsg.php?id={$row['chat_id']}'>{$row['fullname']}</a>";

    // Fetch the latest chat message for this chat
    $chatrow = $conn->query("SELECT * FROM chat WHERE chat_id={$row['chat_id']} ORDER BY cdatetime DESC")->fetch_assoc();

    if ($chatrow) {
        echo "<br/><br/>{$chatrow['message']}<br/>";
        echo "{$chatrow['cdatetime']}";
    }

    echo "<hr style='border-top:1px solid #c3c3c3; border-bottom:1px solid white'/>";
}

// Now, fetch chats where you have received messages
$sql = "SELECT chat_id, user_id_from, user_id_to, fullname FROM Chatmaster, user WHERE chatmaster.user_id_from=user.user_id AND chatmaster.user_id_to=$_SESSION[uid]";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<a href='readmsg.php?id={$row['chat_id']}'>{$row['fullname']}</a>";

    // Fetch the latest chat message for this chat
    $chatrow = $conn->query("SELECT * FROM chat WHERE chat_id={$row['chat_id']} ORDER BY cdatetime DESC")->fetch_assoc();

    if ($chatrow) {
        echo "<br/><br/>{$chatrow['message']}<br/>";
        echo "{$chatrow['cdatetime']}";
    }

    echo "<hr style='border-top:1px solid #c3c3c3; border-bottom:1px solid white'/>";
}

// Close the connection
$conn->close();

require("footer.php");
?>
