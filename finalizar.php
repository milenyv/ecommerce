<?php
session_start();
include("config/db.php");

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}

// valida carrinho
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
  echo "Carrinho vazio!";
  exit;
}

$total = 0;

// calcular total
foreach ($_SESSION['cart'] as $id => $quantidade) {

  $sql = "SELECT preco FROM produtos WHERE id = $id";
  $result = $conn->query($sql);
  $produto = $result->fetch_assoc();

  $total += $produto['preco'] * $quantidade;
}

// salvar pedido
$conn->query("INSERT INTO pedidos (usuario_id, total) VALUES (1, $total)");

$pedido_id = $conn->insert_id;

// salvar itens do pedido
foreach ($_SESSION['cart'] as $produto_id => $quantidade) {
  $conn->query("
    INSERT INTO itens_pedido (pedido_id, produto_id, quantidade)
    VALUES ($pedido_id, $produto_id, $quantidade)
  ");
}

// limpar carrinho
$_SESSION['cart'] = [];

echo "<h2>✅ Compra finalizada!</h2>";
echo "<a href='index.php'>Voltar</a>";
?>