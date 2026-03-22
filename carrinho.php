<?php
session_start();
include("config/db.php");

// criar carrinho
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

// adicionar produto
if (isset($_GET['add'])) {
  $id = $_GET['add'];

  if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]++;
  } else {
    $_SESSION['cart'][$id] = 1;
  }

  header("Location: carrinho.php");
}

// remover produto
if (isset($_GET['remove'])) {
  $id = $_GET['remove'];
  unset($_SESSION['cart'][$id]);
  header("Location: carrinho.php");
}
?>

<h1>🛒 Seu Carrinho</h1>

<?php
$total = 0;

if (empty($_SESSION['cart'])) {
  echo "<p>Carrinho vazio</p>";
} else {

  foreach ($_SESSION['cart'] as $id => $quantidade) {

    $sql = "SELECT * FROM produtos WHERE id = $id";
    $result = $conn->query($sql);
    $produto = $result->fetch_assoc();

    $subtotal = $produto['preco'] * $quantidade;

    echo "
    <div style='border:1px solid #ccc; padding:10px; margin:10px 0;'>
      <strong>{$produto['nome']}</strong><br>
      Quantidade: {$quantidade}<br>
      Subtotal: R$ " . number_format($subtotal, 2, ',', '.') . "<br>
      <a href='carrinho.php?remove={$id}'>❌ Remover</a>
    </div>
    ";

    $total += $subtotal;
  }

  echo "<h3>Total: R$ " . number_format($total, 2, ',', '.') . "</h3>";
}
?>

<br>
<a href="finalizar.php">
  <button>Finalizar compra 💳</button>
</a>

<br><br>
<a href="index.php">⬅ Voltar</a>