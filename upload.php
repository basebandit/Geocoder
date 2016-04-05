<?php
require_once('inc/db/connect.php');
define("BASE_PATH", dirname(__FILE__));
define("UPLOAD_DIR", BASE_PATH . "/uploads/");
header('Content-type: application/json');

$valid_exts = array('csv'); // valid extensions
$max_size = 200 * 1024; // max file size (200kb)
$path = BASE_PATH . "/uploads/"; // upload directory
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (@is_uploaded_file($_FILES['image']['tmp_name'])) {
        // ensure a safe filename
        $name = preg_replace("/[^A-Z0-9._-]/i", "_", $_FILES['image']['name']);
        // don't overwrite an existing file
        $i = 0;
        $parts = pathinfo($name);
        while (file_exists(UPLOAD_DIR . $name)) {
            $i++;
            $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
        }

        // get uploaded file extension
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        // looking for format and size validity
        if (in_array($ext, $valid_exts) AND $_FILES['image']['size'] < $max_size) {
            // unique file path
            //$path = $path . uniqid() . '.' . $ext;
            // move uploaded file from temp to uploads directory
            if (move_uploaded_file($_FILES['image']['tmp_name'], $path . $name)) {
                $status = 'Image successfully uploaded!';
                chmod($path . $name, 0777);
                if (($handle = fopen($path . $name, "r")) !== FALSE) {
                    fgetcsv($handle);
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $num = count($data);
                        for ($c = 0; $c < $num; $c++) {
                            $col[$c] = $data[$c];
                        }
                        $col1 = $col[0];
                        $col2 = $col[1];
                        $col3 = $parts['filename'];

                        // SQL Query to insert data into DataBase
                        $query = "INSERT INTO csvtbl(lat,lng,csv_name) VALUES('" . $col1 . "','" . $col2 . "','" . $col3 . "')";
                        $mysqli->query($query);
                    }
                    fclose($handle);
                }

                echo "File data successfully imported to database!!";
                $mysqli->close();
            } else {
                $status = 'Upload Fail: Unknown error occurred!';
            }
        } else {
            $status = 'Upload Fail: Unsupported file format or It is too large to upload!';
        }
    } else {
        $status = 'Upload Fail: File not uploaded!';
    }
} else {
    $status = 'Bad request!';
}

// echo out json encoded status
echo json_encode(array('status' => $status));
?>