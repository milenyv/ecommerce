<?php
session_start();
include("config/db.php");

if ($_POST) {
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  $sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $_SESSION['user'] = $email;
    header("Location: index.php");
  } else {
    echo "❌ Login inválido";
  }
}
?>

<h2>Login</h2>

<form method="POST">
  <input type="email" name="email" placeholder="Email" required><br><br>
  <input type="password" name="senha" placeholder="Senha" required><br><br>
  <button>Entrar</button>
</form>