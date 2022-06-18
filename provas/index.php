<?php

if($_SESSION['logado']) {
    require_once 'config.php';

    $conn = new mysqli($host, $user, $password, $dbname);

    if($conn->connect_error){
        die("Erro na conexão: ".$conn->connect_error);
    }

    
    $sql = "SELECT * FROM provas ORDER BY dt_prova";
    $res = $conn->query($sql);
    ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Provas</h1>
        <?php
        if($_SESSION['sts_usuario'] && $_SESSION['per_usuario']) {
            ?>
            <a href="main.php?p=provas/new.php" type="button" class="btn btn-success">Cadastrar</a>
            <?php
        }
        ?>
        
    </div>

    <?php
    if(!$_SESSION['sts_usuario']) {
        ?>
        <div class="alert alert-warning d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <div>
                Seu usuário está inativo.
            </div>
        </div>
        <?php
    }
    if($res->num_rows>0){
        ?>
        <div class="table-responsive">
            <table class="table table-striped table-sm" id="tabela_provas">
                <thead>
                    <tr>
                        <th>Nome prova</th>
                        <th>Data prova</th>
                        <th>Hora prova</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody> 

                    <?php
                    while($row = $res->fetch_assoc()){
                        echo "<tr>
                            <td>".$row['nom_prova']."</td>
                            <td>".$row['dt_prova']."</td>
                            <td>".$row['hor_prova']."</td>";
                            if($_SESSION['sts_usuario'] && $_SESSION['per_usuario']) {
                            echo "<td><a href='main.php?p=provas/detalhes.php&id=".$row['id_prova']."' class='btn btn-secondary btn-sm'>Detalhes</a></td></tr>";
                        }
                        else {
                            echo "<td></td></tr>";
                        }
                    }
                    ?>
                
                </tbody>
            </table>
        </div>
    <?php
    }
    else {
        ?>
        <div class="alert alert-warning d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <div>
                Não foram encontrados dados nesta tabela.
            </div>
        </div>
        <?php
    }
    $conn->close();

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

