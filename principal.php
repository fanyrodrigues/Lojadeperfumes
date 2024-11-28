<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica se há produtos selecionados
    if (isset($_POST['produtos']) && !empty($_POST['produtos'])) {
        foreach ($_POST['produtos'] as $produto) {
            list($nome, $preco) = explode(':', $produto);
            $cookieName = strtolower(str_replace(' ', '', $nome));
            setcookie($cookieName, $preco, time() + 120, "/"); // Duração de 2 minutos
        }

        // Redireciona para a página do carrinho
        header("Location: carrinho.php");
        exit();
    } else {
        // Redireciona para uma página de erro com mensagem
        $mensagem = urlencode("Nenhum produto foi selecionado. Por favor, escolha ao menos um produto.");
        header("Location: erro.php?mensagem=$mensagem");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfumaria</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="logo">
            <img src="perfumes/loog.png" alt="Imagem de login" class="capa" style="width: 200px;">
        </div>
        <h1>Florência</h1>
    </header>

    <?php
    // Conexão com o banco de dados
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "perfumaria";

    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    // Consulta para buscar os produtos
    $sql = "SELECT idProduto, nomeProduto, preco, nomeImagem FROM produto";
    $result = $conn->query($sql);
    ?>

    <form action="" method="post">
        <div class="container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="fragrancias">
                        <img src="perfumes/<?php echo htmlspecialchars($row['nomeImagem']); ?>"
                            alt="<?php echo htmlspecialchars($row['nomeProduto']); ?>" class="capa">
                        <h2><?php echo htmlspecialchars($row['nomeProduto']); ?></h2>
                        <p>R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></p>
                        <input type="checkbox" name="produtos[<?php echo htmlspecialchars($row['idProduto']); ?>]"
                            value="<?php echo htmlspecialchars($row['nomeProduto']); ?>:<?php echo htmlspecialchars($row['preco']); ?>">
                        Adicionar ao Carrinho
                    </div>
                    <?php
                }
            } else {
                echo "<p>Nenhum produto encontrado.</p>";
            }
            ?>
        </div>
        <button type="submit">Adicionar Selecionados ao Carrinho</button>
    </form>

    <?php
    $conn->close();
    ?>

    <footer>
        <p>&copy; Florência. Todos os direitos reservados.</p>
    </footer>

</body>

</html>