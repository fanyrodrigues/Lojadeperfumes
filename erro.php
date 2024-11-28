<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <?php
        // Exibe a mensagem passada pela URL
        if (isset($_GET['mensagem'])) {
            echo "<p class='error-message'>" . htmlspecialchars($_GET['mensagem']) . "</p>";
        } else {
            echo "<p class='error-message'>Ocorreu um erro inesperado.</p>";
        }
        ?>
        <a href="principal.php" class="btn">Voltar</a>
    </div>
 
</body>

</html>
