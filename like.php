<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "tech_forum");

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$id = $_GET['id'];
$r = $id;

// Fetch the current like count
$sql = "SELECT `like` FROM `answer` WHERE `answer_id` = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $r);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $row4 = $result->fetch_assoc()) {
    $currentLike = $row4['like'];

    // Increment the like count
    $m = $currentLike + 1;

    // Update the like count in the database
    $updateSql = "UPDATE `answer` SET `like` = ? WHERE `answer_id` = ?";
    $updateStmt = $mysqli->prepare($updateSql);
    $updateStmt->bind_param("ii", $m, $r);

    if ($updateStmt->execute()) {
        header("location: questionview.php?qid=14");
    } else {
        echo "Error updating like count: " . $mysqli->error;
    }
} else {
    echo "Error fetching current like count: " . $mysqli->error;
}

$mysqli->close();
?>
