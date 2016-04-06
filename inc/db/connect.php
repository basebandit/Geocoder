<?php
/**
 * Created by PhpStorm.
 * User: mars
 * Date: 4/5/16
 * Time: 11:09 PM
 */
$mysqli = new mysqli('localhost', 'root', '', 'geocoder');

if ($mysqli->connect_error) {
    die('Could not connect to MySQL: ' . $mysqli->connect_error);
} else {
    /* echo "connection successful";*/ //tampers with the json result submitted to javascript by search.php
}
