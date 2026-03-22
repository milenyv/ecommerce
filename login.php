<link rel="stylesheet" href="css/login.css">
<?php
session_start();
include("config/db.php");

$erro = "";

if ($_POST) {
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email=? AND senha=?");
  $stmt->bind_param("ss", $email, $senha);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $_SESSION['user'] = $email;
    header("Location: index.php");
    exit;
  } else {
    $erro = "Email ou senha inválidos";
  }
}
?>

<div class="login-container">
  <form method="POST" class="login-card">
    <h2>Login</h2>

    <?php if($erro): ?>
      <p class="erro"><?= $erro ?></p>
    <?php endif; ?>

    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="senha" placeholder="Senha" required>

    <button type="submit">Entrar</button>
  </form>
</div>