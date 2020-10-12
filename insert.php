<?php
require_once 'config.php';

if (isset($_POST['name'])) {
    //$message = $_POST['message'];
    $name = $_POST['name'];
    $city = $_POST['city'];
    $occupation = $_POST['occupation'];
   // mysqli_query($conn, "insert into messages(message) values ('$message')");
    mysqli_query($conn, "INSERT INTO `formdata`(`name`, `city`, `occupation`) VALUES ('$name','$city','$occupation')");
    
} else {
    echo "Message is empty";
}
$sql = mysqli_query($conn, "SELECT * FROM formdata order by id desc");
$result = mysqli_fetch_array($sql);
//echo 'c' . $result['message'] . '</div>';
$new_row = '<tr><td>' . $result['name'] . '</td>';
$new_row .= '<td>' . $result['city'] . '</td>';
$new_row .= '<td>' . $result['occupation'] . '</td></tr>';
echo $new_row;
?>
