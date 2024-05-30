<?php
$hosting = "localhost";
$user = "root";
$password = "";
$database = "rubrica";

$connection = mysqli_connect($hosting, $user, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['opzione'])) {
    $email = $_POST['opzione'];

    $query = "DELETE FROM rubrica WHERE email = '$email'";

    if (mysqli_query($connection, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($connection);
    }
} else {
    echo "Email not provided.";
}

mysqli_close($connection);
?>
