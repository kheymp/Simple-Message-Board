<?php 
    $servername = "";
    $username = "";
    $password = "";
    $dbname = "";

    try {
        // Create a new mysqli instance
        $mysqli = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($mysqli->connect_errno) {
            throw new Exception("Failed to connect to MySQL: " . $mysqli->connect_error);
        }
    } catch (Exception $e) {
        // Catch any exceptions (errors) and handle them
        echo "Connection failed: " . $e->getMessage();
    }
?>

