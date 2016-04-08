<?php

/**
 * Created by PhpStorm.
 * User: mars
 * Date: 4/6/16
 * Time: 8:47 AM
 */
require_once 'inc/db/connect.php';

//if (isset($_POST['submit'])) {
//$address = $_POST['address'];
// Sanitize the search term to prevent injection attacks
$sanitized = $mysqli->real_escape_string('juja');
//Run the query
$query = $mysqli->query("SELECT lat,lng from csvtbl where csv_name='$sanitized'");
//check results
if (!$query->num_rows) {
    return false;
}

// Loop and fetch objects
while ($row = $query->fetch_object()) {
    $data[] = $row;
}

// Build our return result
$response["area"] = $sanitized;
$response["data"] = $data;
echo json_encode($response);
//} else {
//    echo "No search input found";
//}