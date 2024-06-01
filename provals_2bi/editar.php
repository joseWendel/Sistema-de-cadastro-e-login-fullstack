<?php
include 'config.php';
session_start();

if ($_SESSION['perfil_id'] != 1) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";
    $result = $conn->query($sql);
    $usuario = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    if (!empty($_POST['senha'])) {
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET nome='$nome', email='$email', senha='$senha' WHERE id='$id'";
    } else {
        $sql = "UPDATE usuarios SET nome='$nome', email='$email' WHERE id='$id'";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="front/editar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
<header>
        <h1>Editar Usuário</h1>
        <nav>
        <a href="admin.php">
        <i class="fa-solid fa-right-from-bracket"></i>
            Sair
        </a>
    </nav>
    </header>

    <main>
        <div class="container">
            <div class="form-container atualizar">
                <h1 class="titulo">Usuário</h1>
                    <form action="editar.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                        <input type="text" name="nome" value="<?php echo $usuario['nome']; ?>" required>
                        <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required>
                        <input type="password" name="senha" placeholder="Nova Senha (opcional)">
                        <input class="update" type="submit" value="Atualizar">
                    </form>
            </div>
        </div>
    </main>
</body>
</html>
