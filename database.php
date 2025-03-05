<?php
$HOST = "127.0.0.1";
$USER = "root";
$PASSWORD = "1234";
$DB = "ajax_test";
$mysql_conn = mysqli_connect($HOST, $USER, $PASSWORD, $DB);



if ($mysql_conn->connect_error) {
    die("Connection failed: " . $mysql_conn->connect_error);
}
