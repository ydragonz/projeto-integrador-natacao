<?php
if($_SESSION['logado'] && $_SESSION['sts_usuario']) {

      require_once 'config.php';

      $conn = new mysqli($host, $user, $password, $dbname);
      if($conn->connect_error) {
          die("Erro na conexão: ".$conn->connect_error);
      }
      else {
          if($_SERVER["REQUEST_METHOD"] == "POST") { 
            $id_atleta = mysqli_real_escape_string($conn, $_POST['id_atleta']);
            $nom_atleta = mysqli_real_escape_string($conn, $_POST['nom_atleta']);
            $dti_atleta = date('Y-m-d', strtotime($_POST['dti_atleta']));
            $dtn_atleta = date('Y-m-d', strtotime($_POST['dtn_atleta']));
            $nat_atleta = mysqli_real_escape_string($conn, $_POST['nat_atleta']);
            $nac_atleta = mysqli_real_escape_string($conn, $_POST['nac_atleta']);
            $rg_atleta = mysqli_real_escape_string($conn, $_POST['rg_atleta']);
            $cpf_atleta = mysqli_real_escape_string($conn, $_POST['cpf_atleta']);
            $sex_atleta = mysqli_real_escape_string($conn, $_POST['sex_atleta']);
            $end_atleta = mysqli_real_escape_string($conn, $_POST['end_atleta']);
            $bai_atleta = mysqli_real_escape_string($conn, $_POST['bai_atleta']);
            $cep_atleta = mysqli_real_escape_string($conn, $_POST['cep_atleta']);
            $cid_atleta = mysqli_real_escape_string($conn, $_POST['cid_atleta']);
            $uf_atleta = mysqli_real_escape_string($conn, $_POST['uf_atleta']);
            $mae_atleta = mysqli_real_escape_string($conn, $_POST['mae_atleta']);
            $pai_atleta = mysqli_real_escape_string($conn, $_POST['pai_atleta']);
            $clb_atleta = mysqli_real_escape_string($conn, $_POST['clb_atleta']);
            $trb_atleta = mysqli_real_escape_string($conn, $_POST['trb_atleta']);
            $anx_foto_atleta = $_FILES['anx_foto_atleta'];
            $anx_rg_atleta = $_FILES['anx_rg_atleta'];
            $anx_cpf_atleta = $_FILES['anx_cpf_atleta'];
            $anx_atm_atleta = $_FILES['anx_atm_atleta'];
            $anx_cpr_atleta = $_FILES['anx_cpr_atleta'];
            $id_convenio = mysqli_real_escape_string($conn, $_POST['id_convenio']);

            $sql = "UPDATE atletas SET 
            nom_atleta='$nom_atleta', 
            dti_atleta='$dti_atleta',
            dtn_atleta='$dtn_atleta',
            nat_atleta='$nat_atleta',
            nac_atleta='$nac_atleta',
            rg_atleta='$rg_atleta',
            cpf_atleta='$cpf_atleta',
            sex_atleta='$sex_atleta',
            end_atleta='$end_atleta',
            bai_atleta='$bai_atleta',
            cep_atleta='$cep_atleta',
            cid_atleta='$cid_atleta',
            uf_atleta='$uf_atleta',
            mae_atleta='$mae_atleta',
            pai_atleta='$pai_atleta',
            clb_atleta='$clb_atleta',
            trb_atleta='$trb_atleta',
            anx_foto_atleta='$anx_foto_atleta',
            anx_rg_atleta='$anx_rg_atleta',
            anx_cpf_atleta='$anx_cpf_atleta',
            anx_atm_atleta='$anx_atm_atleta',
            anx_cpr_atleta='$anx_cpr_atleta',
            id_convenio='$id_convenio',
            WHERE id_atleta = '$id_atleta'";

            if($conn->query($sql) === TRUE) {
              ?>
              <br>
              <div class="alert alert-success" role="alert">
                <h2>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg> 
                Atleta editado com sucesso!</h2>
                clique no botão abaixo para atualizar a página e ver os resultados.
              </div>
              <?php
              echo "<td><a href='main.php?p=atletas/index.php' class='btn btn-secondary'>Atualizar</a></tr>";
            }
            else {
              ?>
              <br>
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
              $sql = "SELECT * FROM atletas WHERE id_atleta = ?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("s", $id);
              $stmt->execute();
              $result = $stmt->get_result();
              
              $dados = $result->fetch_row() ;
              
          }

      }

    if(!isset($_POST["id_atleta"])) {
  ?>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Editando atleta</h1>
  </div>
  <form class="body row" method="post" action="main.php?p=atletas/edit.php">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Visualizando atletas</h1>
  </div>
  <form class="body row" action="main.php?p=atletas/detalhes.php" method="POST">
  <div class="col-md-6 mb-3">
    <label for="nom_atleta" class="form-label">Nome do atleta</label>
    <input type="text" required="" class="form-control" id="nom_atleta" name="nom_atleta" maxlength="50" value="<?=$dados[1];?>">
  </div>
  <div class="col-md-3 mb-3">
      <label for="dti_atleta" class="form-label">Data de inicio</label>
          <input type="date" required="" class="form-control" id="dti_atleta" name="dti_atleta" value="<?=$dados[2];?>">
  </div>
  <div class="col-md-3 mb-3">
      <label for="dtn_atleta" class="form-label">Data de nascimento</label>
          <input type="date" required="" class="form-control" id="dtn_atleta" name="dtn_atleta" value="<?=$dados[3];?>">
  </div>
  <div class="col-md-6 mb-3">
    <label for="nat_atleta" class="form-label">Naturalidade</label>
    <input type="text" required="" class="form-control" id="nat_atleta" name="nat_atleta" maxlength="50" value="<?=$dados[4];?>">
  </div>
  <div class="col-md-6 mb-3">
    <label for="nac_atleta" class="form-label">Nacionalidade</label>
    <input type="text" required="" class="form-control" id="nac_atleta" name="nac_atleta" maxlength="20" value="<?=$dados[5];?>">
  </div>
  <div class="col-md-5 mb-3">
    <label for="rg_atleta" class="form-label">RG</label>
    <input type="text" required="" class="form-control" id="rg_atleta" name="rg_atleta" maxlength="12" value="<?=$dados[6];?>">
  </div>
  <div class="col-md-5 mb-3">
    <label for="cpf_atleta" class="form-label">CPF</label>
    <input type="text" required="" class="form-control" id="cpf_atleta" name="cpf_atleta" maxlength="11" value="<?=$dados[7];?>">
  </div>
  <div class="col-md-2 mb-3">
  <label for="sex_atleta" class="form-label">Sexo</label>
    <select class="form-select" id="sex_atleta" name="sex_atleta" value="<?=$dados[8];?>">
        <option value="M">M</option>
        <option value="F">F</option>
    </select>
  </div>
  <div class="col-md-8 mb-3">
    <label for="end_atleta" class="form-label">Endereço</label>
    <input type="text" required="" class="form-control" id="end_atleta" name="end_atleta" maxlength="50" value="<?=$dados[9];?>">
  </div>
  <div class="col-md-4 mb-3">
    <label for="bai_atleta" class="form-label">Bairro</label>
    <input type="text" required="" class="form-control" id="bai_atleta" name="bai_atleta" maxlength="25" value="<?=$dados[10];?>">
  </div>
  <div class="col-md-4 mb-3">
    <label for="cep_atleta" class="form-label">Cep</label>
    <input type="text" required="" class="form-control" id="cep_atleta" name="cep_atleta" maxlength="10" value="<?=$dados[11];?>">
  </div>  
  <div class="col-md-6 mb-3">
    <label for="cid_atleta" class="form-label">Cidade</label>
    <input type="text" required="" class="form-control" id="cid_atleta" name="cid_atleta" maxlength="35" value="<?=$dados[12];?>">
  </div>
  <div class="col-md-2 mb-3">
    <label for="uf_atleta" class="form-label">UF</label>
    <input type="text" required="" class="form-control" id="uf_atleta" name="uf_atleta" maxlength="2" value="<?=$dados[13];?>">
  </div>
  <div class="col-md-6 mb-3">
    <label for="mae_atleta" class="form-label">Nome da mãe do atleta</label>
    <input type="text" required="" class="form-control" id="mae_atleta" name="mae_atleta" maxlength="50" value="<?=$dados[14];?>">
  </div>
  <div class="col-md-6 mb-3">
    <label for="pai_atleta" class="form-label">Nome do pai do atleta</label>
    <input type="text" class="form-control" id="pai_atleta" name="pai_atleta" maxlength="50" value="<?=$dados[15];?>">
  </div>
  <div class="col-md-10 mb-3">
    <label for="clb_atleta" class="form-label">Clb do atleta</label>
    <input type="text" class="form-control" id="clb_atleta" name="clb_atleta" maxlength="30" value="<?=$dados[16];?>">
  </div>
  <div class="col-md-2 mb-3">
    <label for="trb_atleta" class="form-label">Trb do atleta</label>
    <input type="text" class="form-control" id="trb_atleta" name="trb_atleta" maxlength="2" value="<?=$dados[17];?>">
  </div>
  <div class="col-md-4 mb-3">
    <label for="anx_foto_atleta" class="form-label">Foto do atleta</label>
    <input type="file" class="form-control" id="anx_foto_atleta" name="anx_foto_atleta" value="<?=$dados[18];?>">
  </div>
  <div class="col-md-4 mb-3">
    <label for="anx_rg_atleta" class="form-label">RG do atleta</label>
    <input type="file" class="form-control" id="anx_rg_atleta" name="anx_rg_atleta" value="<?=$dados[19];?>">
  </div>
  <div class="col-md-4 mb-3">
    <label for="anx_cpf_atleta" class="form-label">CPF do atleta</label>
    <input type="file" class="form-control" id="anx_cpf_atleta" name="anx_cpf_atleta" value="<?=$dados[20];?>">
  </div>
  <div class="col-md-4 mb-3">
    <label for="anx_atm_atleta" class="form-label">Atestado médico do atleta</label>
    <input type="file" class="form-control" id="anx_atm_atleta" name="anx_atm_atleta" value="<?=$dados[21];?>">
  </div>
  <div class="col-md-4 mb-3">
    <label for="anx_cpr_atleta" class="form-label">Cpr do atleta</label>
    <input type="file" class="form-control" id="anx_cpr_atleta" name="anx_cpr_atleta" value="<?=$dados[22];?>">
  </div> 
  <div class="col-md-4 mb-3">
    <label class="form-label">Código Convenio</label>
    <input type="text" class="form-control" id="id_convenio" name="id_convenio" maxlength="8" value="<?=$dados[23];?>">
    <div class="form-text">
        Em caso de dúvidas consultar na página de convênios.
    </div>
  </div>
  <div class="col-md-4 mb-3">
  <button type="submit" class="btn btn-success">Salvar</button>
  <?php echo "<td><a href='main.php?p=atletas/detalhes.php&id=".$dados[0]."' class='btn btn-secondary'>Cancelar</a></tr>" ?>
  </div>
  </form>
  <br><br><br>

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
      clique no botão abaixo para redirecionar para a página de login.
  </div>
  <?php
  echo "<td><a href='logout.php' class='btn btn-secondary'>Área de login</a></tr>";
}
?>