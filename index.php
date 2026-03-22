<?php
session_start();
include("config/db.php");
$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);
?>

<link rel="stylesheet" href="css/style.css">

<div class="topbar">
  <div class="topbar-content">
    
    <div class="logo">🛒 Loja</div>

    <div class="actions">
      <button class="btn-cart" onclick="toggleCart()">Carrinho</button>
      <a href="login.php" class="login">Login</a>
    </div>

  </div>
</div>

<h1>Perfumes</h1>

<div class="container">

    <?php while ($produto = $result->fetch_assoc()) { ?>

        <div class="card">
            <img src="<?= $produto['imagem'] ?>">
            <h3><?= $produto['nome'] ?></h3>
            <p class="price">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>

            <a href="carrinho.php?add=<?= $produto['id'] ?>">
                <button>Adicionar</button>
            </a>
        </div>

    <?php } ?>
</div>

<div id="cartSidebar" class="cart-sidebar">
    <h2>🛒 Carrinho</h2>

    <?php
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {

        $total = 0;

        foreach ($_SESSION['cart'] as $id => $qtd) {
            $sql = "SELECT nome, preco FROM produtos WHERE id = $id";
            $result = $conn->query($sql);
            $produto = $result->fetch_assoc();

            $total += $produto['preco'] * $qtd;
    ?>

            <div class="cart-item">
                <p><?= $produto['nome'] ?></p>

                <div class="controls">
                    <a href="carrinho.php?decrease=<?= $id ?>">➖</a>
                    <span><?= $qtd ?></span>
                    <a href="carrinho.php?increase=<?= $id ?>">➕</a>
                </div>

                <a href="carrinho.php?remove=<?= $id ?>" class="remove">❌</a>
            </div>

        <?php } ?>

        <hr>
        <p><strong>Total: R$ <?= number_format($total, 2, ',', '.') ?></strong></p>

        <a href="finalizar.php">
            <button>Finalizar compra</button>
        </a>

    <?php } else { ?>

        <p>Carrinho vazio</p>

    <?php } ?>
</div>

<script>
    function toggleCart() {
        document.getElementById("cartSidebar").classList.toggle("open");
    }
</script>