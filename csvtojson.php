<?php
if (($handle = fopen('uploads/juja.csv', 'r')) === false) {
    die('Error opening file');
}

$headers = fgetcsv($handle, 1024, ',');
$complete = array();

while ($row = fgetcsv($handle, 1024, ',')) {
    $complete[] = array_combine($headers, $row);
}

fclose($handle);

echo json_encode($complete);
?>


