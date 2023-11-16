<?php
session_start();
require("header.php");
require("checkUser.php")
?>
<script type="text/javascript">
function check(f)
{
 if (f.utos.value == "")
        { 
            document.getElementById("spuid").innerHTML = "Please enter the name of the person that you want to chat...";
            //alert ("Please,Please Enter The Name Of The Person That You Want To Chat With.....");
            f.utos.focus();
            return false;
        }
        else 
        return true;
}
</script>

<form action="" method="post" onsubmit="return check(this)">
    <p>
        Enter name to search 
        <input type="text" name="utos" /><span id='spuid' style="color: red;"></span> 
        <br/>
        <br/>
        <input type="submit" value="Click Me" />
    </p>
</form>

<?php
if (isset($_POST['utos']))
{
    $uto = $_POST['utos'];

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

    $sql = "SELECT * FROM user WHERE fullname LIKE '$uto%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        echo "<table cellpadding='2' cellspacing='2>";

        while ($row = $result->fetch_assoc())
        {
            echo "<tr>";
            echo "<td valign='top'><img src='{$row['uimg']}' alt='' style='height:100px; width:100px;' />";
            echo "<td valign='top'><a href=message.php?id={$row['user_id']}' style='font-weight:bold;'>{$row['fullname']}</a> <br/>";
            echo ($row['gender'] == 1 ? "Male" : "Female")."<br/>";
            echo $row['country'];
            echo "<br/>";
            echo "<br/>";
            echo "<a href=message.php?id={$row['user_id']}' style='font-weight:bold;'><input type='button' value='Send Message'></a>";
            echo "</tr>";
        }

        echo "</table>";
    }

    // Close the connection
    $conn->close();
}
?>

<?php require("footer.php")?>
