<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "perfumaria";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="car.css">
    <title>Carrinho de Compras</title>
</head>
<body>
    <h1>Carrinho de Compras</h1>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Preço</th>
                </tr>
            </thead>
            <tbody>
            <?php

            foreach ($_COOKIE as $cookieName => $cookieValue) {
                $nomeProdutoCookie = str_replace(' ', '', strtolower($cookieName));
                $sql = "SELECT nomeProduto, preco, nomeImagem FROM produto WHERE LOWER(REPLACE(nomeProduto, ' ', '')) = '$nomeProdutoCookie'";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $total += $row['preco'];
                        echo "<tr>
                            <td><img src='perfumes/" . htmlspecialchars($row['nomeImagem']) . "' alt='" . htmlspecialchars($row['nomeProduto']) . "' height='100' width='100'></td>
                            <td>" . htmlspecialchars($row['nomeProduto']) . "</td>
                            <td>R$ " . number_format($row['preco'], 2, ',', '.') . "</td>
                        </tr>";
                    }
                }
            }
            ?>
            <tr>
                <td></td>
                <td><strong>Total:</strong></td>
                <td><strong>R$ <?php echo number_format($total, 2, ',', '.'); ?></strong></td>
            </tr>
            </tbody>
        </table>
    </div>
    <form method="post" action="principal.php">
        <button type="submit">Voltar</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
