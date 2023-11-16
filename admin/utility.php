<?php
error_reporting(1);

// Function to execute a query and return the result
function ExecuteQuery($SQL)
{
    $con = new mysqli("localhost", "root", "", "tech_forum");

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $result = $con->query($SQL);

    $con->close();

    return $result;
}

// Function to execute a non-query (e.g., INSERT, UPDATE, DELETE)
function ExecuteNonQuery($SQL)
{
    $con = new mysqli("localhost", "root", "", "tech_forum");

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $result = $con->query($SQL);

    $con->close();

    return $result;
}
?>
