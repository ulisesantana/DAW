<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datatables";

$nif = $_POST['nif'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email-check'];
$state = $_POST['prov'];
$town = $_POST['town'];
$address = $_POST['address'];
$phone = $_POST['tel'];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO datatables.hosting (`id`, `nif`, `name`, `surname`, `email`, `state`, `town`, `address`, `phone`, `createdDate`)
VALUES ($nif, $name, $surname, $email, $state, $town, $address, $phone)";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
