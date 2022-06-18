<?php
require_once 'config.php';
$conn = new mysqli($host, $user, $password, $dbname);

session_start();

if(isset($_POST['login_enviar'])) {
  $login = mysqli_escape_string($conn, $_POST['cod_login']);
  $senha = mysqli_escape_string($conn, $_POST['senha_login']);

  if(empty($login) || empty($senha)) {
    ?>
    <div class="alert alert-danger" role="alert">
      <h1>Campos não preenchidos!</h1>
      verifique e tente novamente, contate um administrador caso o problema persista.
    </div>
    <?php
  }
  else {
    $sql = "SELECT log_usuario FROM usuarios WHERE log_usuario = '$login'";
    $resultado = mysqli_query($conn, $sql);

    if(mysqli_num_rows($resultado) > 0) {
      $sql = "SELECT * FROM usuarios WHERE log_usuario = '$login' AND sen_usuario = MD5('$senha')";
      $resultado = mysqli_query($conn, $sql);

      if(mysqli_num_rows($resultado) == 1) {
        $dados = mysqli_fetch_array($resultado);
        $_SESSION['logado'] = true;
        $_SESSION['cod_usuario'] = $dados['cod_usuario'];
        $_SESSION['per_usuario'] = $dados['per_usuario'];
        $_SESSION['sts_usuario'] = $dados['sts_usuario'];
        header('Location: main.php');
      }
      else {
        ?>
        <div class="alert alert-danger" role="alert">
          <h1>Usuário e/ou senha inválidos!</h1>
          verifique e tente novamente, contate um administrador caso o problema persista.
        </div>
        <?php
      }
    }
    else {
      ?>
      <div class="alert alert-danger" role="alert">
        <h1>Usuário e/ou senha inválidos!</h1>
        verifique e tente novamente, contate um administrador caso o problema persista.
      </div>
      <?php
    }
  }
}


?>

<!doctype html>
<html lang="pt-br">
  <head>
  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Site desenvolvido para o Projeto Integrador da terceira etapa de Engenharia de Software da UNAERP de 2021/2">
        <meta name="author" content="Leonardo Bernardes de Oliveira, Sara Ferreira Fernandes e João Carneiro da Cunha">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
        <link href="css/dashboard.css" rel="stylesheet">
        <link rel="icon" href="imagens/unaerp_icon_mini.png">
        <title>Área de login</title>
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <main class="form-signin">
      <img class="mb-4" src="imagens/unaerp_extended.png" alt="Logo da UNAERP" width="144" height="70">
      <h1 class="h3 mb-3 fw-normal">Faça login</h1>
      <form class="body row" action="index.php" method="POST">
        <div class="form-floating col-md-4 mb-3"></div>
        <div class="form-floating col-md-4 mb-3">
          <input name="cod_login" type="text" class="form-control" id="floatingInput" maxlength="60">
          <label for="floatingInput">E-mail</label>
        </div>
        <div class="form-floating col-md-4 mb-3"></div>
        <div class="form-floating col-md-4 mb-3"></div>
        <div class="form-floating col-md-4 mb-3">
          <input name="senha_login" type="password" class="form-control" id="floatingPassword" placeholder="Sua senha" maxlength="10">
          <label for="floatingPassword">Senha</label>
        </div>
        <div class="form-floating col-md-4 mb-3"></div>
        <div class="form-floating col-md-4 mb-3"></div>
        <div class="form-floating col-md-4 mb-3">
          <button name="login_enviar" class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
        </div>
        <div class="form-floating col-md-4 mb-3"></div>
      </form>
    </main>
  </body>
</html>

