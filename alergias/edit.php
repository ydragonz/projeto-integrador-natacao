<?php
if($_SESSION['logado'] && $_SESSION['sts_usuario']) {
    require_once 'config.php';

    $conn = new mysqli($host, $user, $password, $dbname);
    if($conn->connect_error) {
        die("Erro na conexão: ".$conn->connect_error);
    }
    else {
        if($_SERVER["REQUEST_METHOD"] == "POST") { 
          $id_alergia = $_POST['id_alergia'];
          $nom_alergia = $_POST['nom_alergia'];
          $id_atleta = $_POST['id_atleta'];

          $sql = "UPDATE alergias SET nom_alergia='$nom_alergia', id_atleta='$id_atleta'  WHERE id_alergia='$id_alergia'";
          if($conn->query($sql) === TRUE) {
            ?>
            <br>
            <div class="alert alert-success" role="alert">
              <h2>
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
              </svg>  
              Alergia editada com sucesso!</h2>
              clique no botão abaixo para atualizar a página e ver os resultados.
            </div>
            <?php
            echo "<td><a href='main.php?p=alergias/index.php' class='btn btn-secondary'>Atualizar</a></tr>";
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
        else {
            $id = $_GET['id'];
            $sql = "select * from alergias where id_alergia = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $dados = $result->fetch_row() ;
        }
    }

  if(!isset($_POST["id_alergia"])) {
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Editando alergia</h1>
</div>
<form class="body row" action="main.php?p=alergias/edit.php" method="post">
  <div class="col-md-10 mb-3">
    <label for="nom_alergia" class="form-label">Nome da alergia</label>
    <input type="text" class="form-control" id="nom_alergia" name="nom_alergia" maxlength="30" value="<?=$dados[1];?>">
  </div>
  <div class="col-md-2 mb-3">
    <label for="id_atleta" class="form-label">ID do atleta</label>
    <input type="text" class="form-control" id="id_atleta" name="id_atleta" maxlength="6" value="<?=$dados[2];?>">
    <div class="form-text">
        Em caso de dúvidas consultar na página de atletas.
    </div>
  </div>
  <div class="col-md-12 mb-3">
    <button type="submit" name="submit" class="btn btn-success">Salvar</button>
    <a class="btn btn-secondary" href="main.php?p=alergias/index.php" role="button">Cancelar</a>
  </div>
  <div class="mb-3 controle_id">
      <label class="form-label">ID atleta</label>
      <input type="text" class="form-control" name="id_alergia" id="id_alegia" value="<?=$dados[0];?>" readonly>
      <div id="helpIdCurso" class="form-text">
          O ID do curso é gerado automaticamente pelo sistema.
      </div>
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
    Nenhum usuário logado!</h2>
    clique no botão abaixo para redirecionar para a página de login.
  </div>
  <?php
  echo "<td><a href='logout.php' class='btn btn-secondary'>Área de login</a></tr>";
}
?>