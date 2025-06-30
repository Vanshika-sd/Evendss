<?php
function insert($server, $uname, $password, $dbname, $tname, $fdef, $fields, $values){
    $conn = mysqli_connect($server, $uname, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $csql = "CREATE TABLE IF NOT EXISTS $tname ($fdef)";
    if ($conn->query($csql) !== TRUE) {
        echo "Error creating table<br>";
    }

    // Convert arrays to comma-separated strings
    $fields_str = implode(", ", $fields);
    $values_str = "'" . implode("', '", $values) . "'";

    $sql = "INSERT INTO $tname ($fields_str) VALUES ($values_str)";
    if ($conn->query($sql) === TRUE) {
        echo "Success";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}

$fdef = "
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20),
    age INT,
    class INT
";

// Use regular strings instead of backticks or array keys
$fields = array("name", "age", "class");
$values = array("john", "16", "10");

insert("localhost", "root", "", "event", "infoex", $fdef, $fields, $values);
?>
