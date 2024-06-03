<?php
include('config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT id, nome, senha, perfil_id FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $nome, $hashed_senha, $perfil_id);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($senha, $hashed_senha)) {
            $_SESSION['usuario_id'] = $id;
            $_SESSION['nome'] = $nome;
            $_SESSION['perfil_id'] = $perfil_id;

            if ($perfil_id == 1) {
                header("Location: admin.php");
            } else {
                header("Location: colaborador.php");
            }
        } else {
            echo "<script>alert('Senha incorreta');</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

