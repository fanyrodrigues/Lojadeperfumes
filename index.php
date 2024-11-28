<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $usuarioCorreto = 'exemplo@gmail.com';
    $senhaCorreta = md5('123'); 

    $email = $_POST['e-mail'];
    $senha = md5($_POST['senha']); 

    if ($email === $usuarioCorreto && $senha === $senhaCorreta) {

        header('Location: principal.php');
        exit();
    } else {
      
        header('Location: index.php?error=1');
        exit();
    }
}
include ('conexao.php')

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>jesusP</title>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="perfumes/loog.png" alt="Imagem de login" class="capa" style="width: 200px;">
        </div>
        <div class="form-container">
            <h1>Entre na sua conta</h1>
            <form action="index.php" method="post">
                <input type="email" name="e-mail" placeholder="Digite o seu email" required>
                <input type="password" name="senha" placeholder="Digite a sua senha" required>
                <button class="btn-login">Logar</button>
                <?php if (isset($_GET['error'])): ?>
                    <span class="msg_error"> <i class="fas fa-exclamation-circle"></i> Tentativa Inválida</span>
                <?php endif; ?>
            </form>
        </div>
</body>

</html>