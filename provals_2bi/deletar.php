<?php
include 'config.php';
session_start();

if (!isset($_SESSION['userid']) || $_SESSION['perfil'] != 1) {
    header("Location: deletar.php");
    exit();
}

$id = $_GET['id'];
$sql = "DELETE FROM usuarios WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: admin.php");
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}
?>
