<?php
if($_SESSION['logado'] && $_SESSION['sts_usuario']) {
      require_once 'config.php';

      $conn = new mysqli($host, $user, $password, $dbname);
      if($conn->connect_error) {
          die("Erro na conexão: ".$conn->connect_error);
      }
      else {
          if(isset($_GET['del'])) {
            $id = $_GET['del'];
            $conn->query("DELETE FROM exames WHERE num_exame=$id");
            ?>
            <br>
            <div class="alert alert-success" role="alert">
              <h2>
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
              </svg>
              Exame excluído com sucesso!</h2>
              clique no botão abaixo para atualizar a página e ver os resultados.
            </div>
            <?php
            echo "<td><a href='main.php?p=exames/index.php' class='btn btn-secondary'>Atualizar</a></tr>";
          }

          if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM exames WHERE num_exame = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $dados = $result->fetch_row() ;
          }
      }
      if(!isset($_GET['del'])) {
  ?>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Visualizando exame</h1>
  </div>
  <form action="main.php?p=exames/detalhes.php" method="POST">
  <div class="mb-3">
    <label class="form-label">Número do exame</label>
    <input type="text" class="form-control" id="num_exame" name="num_exame" value="<?=$dados[0];?>" readonly>
    <div class="form-text">
        O número do do exame é gerado automaticamente pelo sistema.
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">Código paciente</label>
    <input type="text" class="form-control" id="cod_paciente" name="cod_paciente" value="<?=$dados[1];?>" readonly>
    <div class="form-text">
        Em caso de dúvidas consultar a tabela na página de pacientes.
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">Código usuário</label>
    <input type="text" class="form-control" id="cod_usuario" name="cod_usuario" value="<?=$dados[2];?>" readonly>
  </div>
  <div class="mb-3">
    <label class="form-label">Data do exame</label>
    <input type="date" class="form-control" id="dta_exame" name="dta_exame" value="<?=$dados[3];?>" readonly>
  </div>
  <div class="mb-3">
    <label class="form-label">Pressão arterial diastólica</label>
    <input type="text" class="form-control" id="pad_exame" name="pad_exame" value="<?=$dados[4];?>" readonly>
  </div>
  <div class="mb-3">
    <label class="form-label">Pressão arterial sistólica</label>
    <input type="text" class="form-control" id="pas_exame" name="pas_exame" value="<?=$dados[5];?>" readonly>
  </div>
  <div class="mb-3">
    <label class="form-label">Glicemia</label>
    <input type="text" class="form-control" id="gli_exame" name="gli_exame" value="<?=$dados[6];?>" readonly>
  </div>
  <div class="mb-3">
    <label class="form-label">Colesterol</label>
    <input type="text" class="form-control" id="col_exame" name="col_exame" value="<?=$dados[7];?>" readonly>
  </div>

    <a class="btn btn-secondary" href="main.php?p=exames/index.php" role="button">Voltar</a>
  </form>

<br>
<?php
  } 
}
else {
  ?>
  <div class="alert alert-danger" role="alert">
    <h2>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-octagon-fill" viewBox="0 0 16 16">
      <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </svg>
    Nenhum usuário logado!</h2>
    clique no botão abaixo para redirecionar para a página de login.
  </div>
  <?php
  echo "<td><a href='logout.php' class='btn btn-secondary'>Área de login</a></tr>";
}
?>

<br><br><br>