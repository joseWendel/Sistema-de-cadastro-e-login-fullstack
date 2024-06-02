<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="front/style.css">
    <title>Prova | Sistema de login e cadastro fullstack</title>
    <style>
        .titulo{
            padding-bottom: 40px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.458);
        }
    </style>
</head>
<body>

    <h1 class="titulo">Sistema</h1>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="register.php" method="post">
                <h1>Criar uma Conta</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>ou use seu e-mail para registro</span>
                <input type="text" name="nome" placeholder="Nome">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="senha" placeholder="Senha">
                <input class="inputSubmit" type="submit" name="submit" id="submit" value="Inscrever-se">
            </form>



        </div>
        <div class="form-container sign-in">
            <form action="login.php" method="post">
                <h1>Entrar</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>ou use sua senha e e-mail</span>
                <input type="email"  name="email" placeholder="Email">
                <input type="password" name="senha" placeholder="Senha">
                <a href="#">Esqueceu sua senha?</a>
                <input class="inputSubmit" type="submit" name="submit" id="submit" value="Entrar">
            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bem vindo de volta!</h1>
                    <p>Insira seus dados pessoais para acessar sua conta</p>
                    <button class="hidden" id="login">Entrar</button>
                </div>

                <div class="toggle-panel toggle-right">
                    <h1>Olá! Ainda não tem uma conta?</h1>
                    <p>Registre-se com seus dados pessoais para criar sua conta</p>
                    <button class="hidden" id="register">Inscrever-se</button>
                </div>

            </div>
        </div>
    </div>
    <script src="front/index.js"></script>
</body>
</html>