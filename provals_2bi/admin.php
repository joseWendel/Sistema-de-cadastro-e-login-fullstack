<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['perfil_id'] != 1) {
    header("Location: login.php");
    exit();
}

include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['create'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
        $perfil_id = $_POST['perfil_id'];
        $sql = "INSERT INTO usuarios (nome, email, senha, perfil_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nome, $email, $senha, $perfil_id);
        $stmt->execute();
        $stmt->close();
    }
}

$sql = "SELECT u.id, u.nome, u.email, p.nome AS perfil_nome FROM usuarios u JOIN perfil p ON u.perfil_id = p.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="front/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Administrador</title>
</head>
<body>
    <header>
        <h1>Bem-vindo, Administrador <?php echo $_SESSION['nome']; ?>!</h1>

        <nav>
        <a href="logout.php">
        <i class="fa-solid fa-right-from-bracket"></i>
            Sair
        </a>
    </nav>
    </header>
    
    <h2 class="lista">Usuários Cadastrados</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Perfil</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nome'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['perfil_nome'] ?></td>
                    <td>
                    <a href="editar.php?id=<?=$row['id']; ?>" style="text-decoration:none;">
                                <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='blue' class='bi bi-pencil-square' viewBox='0 0 20 16'>
                                    <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                    <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
                                </svg>
                                </a>
                    

                        <form method="post" style="display:inline-block;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" name="delete" style="border:transparent; background-color: white;">
                            <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='red' class='bi bi-trash3-fill' viewBox='0 0 20 16'>
                                    <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5'/>
                                </svg>  
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <h2 class="create">Criar Usuário</h2>
    <form method="post" class="criar">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <select name="perfil_id" required>
            <option value="1">Administrador</option>
            <option value="2">Colaborador</option>
        </select>
        <button type="submit" name="create">Criar</button>
    </form>
</body>
</html>

