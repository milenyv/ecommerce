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
    exit;
}

// remover produto
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
    header("Location: carrinho.php");
    exit;
}

// aumentar quantidade
if (isset($_GET['increase'])) {
    $id = $_GET['increase'];
    $_SESSION['cart'][$id]++;
    header("Location: carrinho.php");
    exit;
}

// diminuir quantidade
if (isset($_GET['decrease'])) {
    $id = $_GET['decrease'];

    if ($_SESSION['cart'][$id] > 1) {
        $_SESSION['cart'][$id]--;
    } else {
        unset($_SESSION['cart'][$id]);
    }

    header("Location: carrinho.php");
    exit;
}
?>

<link rel="stylesheet" href="css/carrinho.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<h1 style="text-align:center;">🛒 Seu Carrinho</h1>

<div class="cart-container">

  <div class="cart-items">

<?php
$total = 0;

if (empty($_SESSION['cart'])) {
    echo "<p style='text-align:center;'>Carrinho vazio</p>";
} else {

    foreach ($_SESSION['cart'] as $id => $quantidade) {

        $sql = "SELECT * FROM produtos WHERE id = $id";
        $result = $conn->query($sql);
        $produto = $result->fetch_assoc();

        $subtotal = $produto['preco'] * $quantidade;

        echo "
<div class='cart-card'>
  <img src='{$produto['imagem']}' class='cart-img'>

  <div class='cart-info'>
    <h3>{$produto['nome']}</h3>

    <div class='cart-controls'>
      <a href='carrinho.php?decrease={$id}' class='btn-qtd'>
        <i class='fa-solid fa-minus'></i>
      </a>

      <span class='qtd'>{$quantidade}</span>

      <a href='carrinho.php?increase={$id}' class='btn-qtd'>
        <i class='fa-solid fa-plus'></i>
      </a>
    </div>

    <p class='subtotal'>
      R$ " . number_format($subtotal, 2, ',', '.') . "
    </p>

    <a href='carrinho.php?remove={$id}' class='remove'>
      <i class='fa-solid fa-trash'></i>
    </a>
  </div>
</div>
";

        $total += $subtotal;
    }
}
?>

  </div> <!-- FIM cart-items -->

  <div class="cart-summary">
    <h2>Total</h2>
    <h3>R$ <?= number_format($total, 2, ',', '.') ?></h3>

    <a href="finalizar.php">
      <button>Finalizar compra 💳</button>
    </a>

    <a href="index.php" class="back">⬅ Voltar</a>
  </div>

</div>