<?php
$localhost = 'localhost';
$username = 'root';
$password = '';
$database = 'rubrica';


$connection = new mysqli($localhost, $username, $password, $database);


if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} else {
    echo "Connected successfully";
}

class Contatto {
    private $nome;
    private $cognome;
    private $email;
    private $telefono;

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function setCognome($cognome): void {
        $this->cognome = $cognome;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setTelefono($telefono): void {
        $this->telefono = $telefono;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCognome() {
        return $this->cognome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefono() {
        return $this->telefono;
    }
}

$contatto = new Contatto();

$contatto->setNome($_POST['nome']);
$contatto->setCognome($_POST['cognome']);
$contatto->setEmail($_POST['email']);
$contatto->setTelefono($_POST['telefono']);


$query = "INSERT INTO rubrica (nome, cognome, email, telefono) VALUES (?, ?, ?, ?)";
$stmt = $connection->prepare($query);

if ($stmt) {
    $stmt->bind_param('ssss',
        $contatto->getNome(),
        $contatto->getCognome(),
        $contatto->getEmail(),
        $contatto->getTelefono()
    );


    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error inserting record: " . $stmt->error;
    }


    $stmt->close();
} else {
    echo "Error preparing statement: " . $connection->error;
}


$connection->close();
?>
