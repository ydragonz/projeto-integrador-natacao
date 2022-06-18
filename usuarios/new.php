<?php
if($_SESSION['logado'] && $_SESSION['sts_usuario'] && $_SESSION['per_usuario']) {
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      require_once 'config.php';

      $conn = new mysqli($host, $user, $password, $dbname);
      
      if($conn->connect_error){
        die("Erro de conexão: ".$conn->connect_error);
      }
      else {
        $nom_usuario = mysqli_real_escape_string($conn, $_POST['nom_usuario']);
        $dtn_usuario = date('Y-m-d', strtotime($_POST['dtn_usuario']));
        $log_usuario = mysqli_real_escape_string($conn, $_POST['log_usuario']);
        $sen_usuario = mysqli_real_escape_string($conn, $_POST['sen_usuario']);
        $per_usuario = mysqli_real_escape_string($conn, $_POST['per_usuario']);
        $sts_usuario = mysqli_real_escape_string($conn, $_POST['sts_usuario']);

        $sql = "insert into usuarios (
          nom_usuario, 
          dtn_usuario, 
          log_usuario, 
          sen_usuario, 
          per_usuario, 
          sts_usuario) 
          values (
          '$nom_usuario', 
          '$dtn_usuario', 
          '$log_usuario', 
          MD5('$sen_usuario'), 
          '$per_usuario', 
          '$sts_usuario')";

        if($conn->query($sql) === TRUE) {
          ?>
          <br>
          <div class="alert alert-success" role="alert">
            <h2>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>  
            Usuário criado com sucesso!</h2>
            clique no botão abaixo para atualizar a página e ver os resultados.
            </div>
            <?php
            echo "<td><a href='main.php?p=usuarios/index.php' class='btn btn-secondary'>Atualizar</a></tr>";
        }
        else {
          ?>
          <div class="alert alert-danger" role="alert">
            <?php
            echo "Falha: ".$sql."\n".$conn->error;
            ?>
          </div>
          <?php
        }
      }
    }
    if(!isset($_POST["enviar"])) {
  ?>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Novo usuário</h1>
  </div>
  <form class="body row" action="main.php?p=usuarios/new.php" method="post">
    <div class="col-md-8 mb-3">
      <label for="nom_usuario" class="form-label">Nome do usuário</label>
      <input type="text" required="" class="form-control" id="nom_usuario" name="nom_usuario" maxlength="60">
    </div>
    <div class="col-md-4 mb-3">
      <label for="dtn_usuario" class="form-label">Data de nascimento</label>
          <input type="date" required="" class="form-control" id="dtn_usuario" name="dtn_usuario">
    </div>
    <div class="col-md-8 mb-3">
      <label for="log_usuario" class="form-label">E-mail do usuário</label>
      <input type="email" required="" class="form-control" id="log_usuario" name="log_usuario" maxlength="60">
    </div>
    <div class="col-md-4 mb-3">
      <label for="sen_usuario" class="form-label">Senha</label>
      <input type="password" required="" class="form-control" id="sen_usuario" name="sen_usuario" maxlength="20">
    </div>
    <div class="col-md-6 mb-3">
      <label for="per_usuario" class="form-label">Função</label>
      <select class="form-select" id="per_usuario" name="per_usuario">
          <option selected value="0">Aluno</option>
          <option value="1">Professor</option>
      </select>
    </div>
    <div class="col-md-6 mb-3">
      <label for="sts_usuario" class="form-label">Status</label>
      <select class="form-select" id="sts_usuario" name="sts_usuario">
          <option selected value="0">Inativo</option>
          <option value="1">Ativo</option>
      </select>
    </div>
    <div class="col-md-6 mb-3">
    <button type="submit" class="btn btn-success" name="enviar">Cadastrar</button>
    <a class="btn btn-secondary" href="main.php?p=usuarios/index.php" role="button">Voltar</a>
    </div>
  </form>

<?php
  }
}
else {
  ?>
  <br>
  <div class="alert alert-danger" role="alert">
      <h2>
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-octagon-fill" viewBox="0 0 16 16">
          <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
      </svg>
      Acesso negado!</h2>
      clique no botão abaixo para voltar.
  </div>
  <?php
  echo "<td><a href='main.php?p=usuarios/index.php' class='btn btn-secondary'>Área de login</a></tr>";
}
?>