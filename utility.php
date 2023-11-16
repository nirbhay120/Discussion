<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
function ExecuteQuery($SQL)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "tech_forum";

    // Create a MySQLi connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query($SQL);

    // Close the connection
    $conn->close();

    return $result;
}

function ExecuteNonQuery($SQL)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "tech_forum";

    // Create a MySQLi connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query($SQL);

    // Close the connection
    $conn->close();

    return $result;
}
?>
