<?php
session_start();
include("config/db.php");

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
?>
<link rel="stylesheet" href="css/finalizar.css">

<div class="checkout-container">
  <div class="checkout-card empty">

    <h2>🛒 Carrinho vazio</h2>
    <p class="subtitle">Adicione produtos antes de finalizar a compra</p>

    <a href="index.php">
      <button>Voltar para loja</button>
    </a>

  </div>
</div>
<?php
exit;
}

$total = 0;
$itens = [];

foreach ($_SESSION['cart'] as $id => $quantidade) {

  $sql = "SELECT nome, preco FROM produtos WHERE id = $id";
  $result = $conn->query($sql);
  $produto = $result->fetch_assoc();

  $subtotal = $produto['preco'] * $quantidade;

  $itens[] = [
    'nome' => $produto['nome'],
    'qtd' => $quantidade,
    'subtotal' => $subtotal
  ];

  $total += $subtotal;
}

$conn->query("INSERT INTO pedidos (usuario_id, total) VALUES (1, $total)");
$pedido_id = $conn->insert_id;

foreach ($_SESSION['cart'] as $produto_id => $quantidade) {
  $conn->query("
    INSERT INTO itens_pedido (pedido_id, produto_id, quantidade)
    VALUES ($pedido_id, $produto_id, $quantidade)
  ");
}

$_SESSION['cart'] = [];
?>

<link rel="stylesheet" href="css/finalizar.css">

<div class="checkout-container">

  <div class="checkout-card">

    <h2>✅ Pedido Confirmado</h2>
    <p class="subtitle">Seu pedido foi realizado com sucesso</p>

    <div class="order-list">
      <?php foreach ($itens as $item): ?>
        <div class="order-item">
          <span><?= $item['nome'] ?> (x<?= $item['qtd'] ?>)</span>
          <span>R$ <?= number_format($item['subtotal'], 2, ',', '.') ?></span>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="order-total">
      Total: R$ <?= number_format($total, 2, ',', '.') ?>
    </div>

    <a href="index.php">
      <button>Voltar para loja</button>
    </a>

  </div>

</div>

<link rel="stylesheet" href="finalizar.css"