<?php
require_once 'database.php';

$id = $_POST['id'];

$sql = "SELECT * FROM students WHERE id = {$id}";

$result = mysqli_query($mysql_conn, $sql) or die("SQL query failed");
$output = "";


if (mysqli_num_rows($result) > 0) {

    while ($raw = mysqli_fetch_assoc($result)) {
        $output .= "

            <tr>
                <td>First Name</td>
                <td><input type='text' id='edit-fname' value='{$raw['first_name']}'></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td><input type='text' id='edit-lname' value='{$raw['last_name']}'></td>
            </tr>
            <tr>
                <td></td>
                <td><input type='submit' id='edit-submit' value='Save'></td>
            </tr>
            ";
    }
    $output .= "";
    mysqli_close($mysql_conn);

    echo $output;
} else {
    echo '<h2>No Record Found!</h2>'; 
}
