<?php
// PROJETO INTEGRADOR TERCEIRA ETAPA 2021/2

// Integrantes:
// -Leonardo Bernardes de Oliveira  
// -Sara Ferreira Fernandes  
// -João Carneiro da Cunha  

    session_start();

    if(isset($_GET['p'])) {
        $arquivo = $_GET['p'];    
    }
    else {
        $arquivo = 'home.php';
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
        <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables_themeroller.css">
        <script type="text/javascript" charset="utf8" src="js/dashboard.js"></script>
        <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/jquery.dataTables.min.js"></script>
        <link rel="icon" href="imagens/unaerp_icon_mini.png">
        <title>Natação Unaerp</title>
    </head>
    <body>

        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="main.php"><img src="imagens/unaerp_icon.png"> Natação Unaerp</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>

            </button>
            
            <?php
            if($_SESSION['logado'] == 1) {
            ?>
            <div class="navbar-nav">

                <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="logout.php">Sair </a>
                </div>
            </div>
            <?php 
            }
            else{
            ?>
            <div class="navbar-nav">
                <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="index.php">Login </a>
                </div>
            </div>
            <?php 
            }
            ?>
        </header>

        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                <?php 
                    include('menu.php');
                ?>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <?php
                    include($arquivo);
                ?>

                </main>
            </div>
        </div>
    </body>
</html>

<script>
$(document).ready( function () {
    $('#tabela_usuarios').DataTable();
    $('#tabela_alunos').DataTable();
    $('#tabela_convenios').DataTable();
    $('#tabela_provas').DataTable();
    $('#tabela_exames_paciente').DataTable();
} );
</script>

