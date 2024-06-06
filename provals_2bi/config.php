<?php

$host = 'localhost';
$usuario = 'root';
$senha = 'admin06';
$bdnome = 'sistema_login';

$conn = new mysqli($host, $usuario, $senha, $bdnome);

/*if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>*/
