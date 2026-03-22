<?php
session_start();
include("config/db.php");

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}

$total = 0;

foreach ($_SESSION['cart'] as $id => $quantidade) {

  $sql = "SELECT preco FROM produtos WHERE id = $id";
  $result = $conn->query($sql);
  $produto = $result->fetch_assoc();

  $total += $produto['preco'] * $quantidade;
}

$conn->query("INSERT INTO pedidos (usuario_id, total) VALUES (1, $total)");

$_SESSION['cart'] = [];

echo "<h2>✅ Compra finalizada!</h2>";
echo "<a href='index.php'>Voltar</a>";