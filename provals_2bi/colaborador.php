<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['perfil_id'] != 2) {
    header("Location: login.php");
    exit();
}

include('config.php');

$sql = "SELECT u.id, u.nome, u.email, p.nome AS perfil_nome FROM usuarios u JOIN perfil p ON u.perfil_id = p.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="front/colaborador.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Colaborador</title>
</head>
<body>
    <header>
        <h1>Bem-vindo, Colaborador <?php echo $_SESSION['nome']; ?>!</h1>
        <nav>
        <a href="logout.php">
        <i class="fa-solid fa-right-from-bracket"></i>
            Sair
        </a>
    </nav>
    </header>

    <h1 class="lista">Usuários Cadastrados</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Perfil</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nome'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['perfil_nome'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
