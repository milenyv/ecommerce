<?php
include("config/db.php");
$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);
?>

<link rel="stylesheet" href="css/style.css">

<div class="topbar">
  <h2>🛒 Loja</h2>
  <div>
    <a href="carrinho.php">Carrinho</a> |
    <a href="login.php">Login</a>
  </div>
</div>

<h1>Perfumes</h1>

<div class="container">

<?php while($produto = $result->fetch_assoc()) { ?>

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