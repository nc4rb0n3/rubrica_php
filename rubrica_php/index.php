<?php
$host = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'rubrica';


$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
} else {

}


$query = "SELECT * FROM rubrica";


$result = mysqli_query($connection, $query);


if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Address Book</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>

        .address-book {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .address-book th, .address-book td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .address-book th {
            background-color: #f2f2f2;
        }

        .address-book tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .address-book tr:hover {
            background-color: #e9e9e9;
        }

        .inserimento, .elimina {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<table class="address-book">
    <thead>
    <tr>
        <th>Nome</th>
        <th>Cognome</th>
        <th>Email</th>
        <th>Telefono</th>
    </tr>
    </thead>
    <tbody>
    <?php

    while ($row = mysqli_fetch_assoc($result)) {

        echo "<tr>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['cognome'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['telefono']. "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
<form action="inserimento.php" method="POST" name="inserimento" class="inserimento">
    <label for="nome">Nome</label>
    <input type="text" id='nome' name="nome">
    <label for="cognome">Cognome</label>
    <input type="text" id='cognome' name="cognome">
    <label for="email">Email</label>
    <input type="text" id='email' name="email">
    <label for="telefono">Telefono</label>
    <input type="text" id='telefono' name="telefono">
    <button type="submit">Submit</button>
</form>
<form action="elimina.php" method="POST" name="elimina" class="elimina">
    <select class="menu" name="opzione">
        <?php
        foreach ($result as $row) {
            echo "<option value='" . $row['email'] . "'>" . $row['email'] . "</option>";
        }
        ?>
    </select>
    <button type="submit">Elimina</button>
</form>
</body>
</html>

<?php

mysqli_free_result($result);


mysqli_close($connection);
?>
