<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
    $perfil_id = 2; // Perfil padrão: Colaborador

    $sql = "INSERT INTO usuarios (nome, email, senha, perfil_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nome, $email, $senha, $perfil_id);

    if ($stmt->execute()) {
        echo "Registro concluído com sucesso.";
    } else {
        echo "Erro ao registrar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

