<?php
require_once 'includes/conexao.php';
require_once 'includes/funcoes.php';
verificaLogin();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Livros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
</head>
<body>

    
    <div class="container mt-5">
        <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_login']); ?>!</h1>
        <?php exibirMensagem(); ?>
        
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Meus Livros</h5>
                        <p class="card-text">Visualize e gerencie seus livros cadastrados.</p>
                        <a href="itens.php" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Adicionar Livro</h5>
                        <p class="card-text">Cadastre um novo livro no sistema.</p>
                        <a href="novo_item.php" class="btn btn-success">Adicionar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>