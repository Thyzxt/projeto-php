<?php
require_once 'includes/conexao.php';
require_once 'includes/funcoes.php';
verificaLogin();

$usuario_id = $_SESSION['usuario_id'];

try{
    $stmt = $pdo->prepare("SELECT * FROM itens WHERE usuario_id = ? ORDER BY data_criacao DESC");
    $stmt->execute([$usuario_id]);
    $itens = $stmt->fetchAll();} 
    
catch(PDOException $e){
    redirect('dashboard.php', 'erro', 'Erro ao carregar itens');}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Itens - Sistema de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Meus Livros</h1>
            <a href="novo_item.php" class="btn btn-success">Adicionar Livro</a>
        </div>
        
        <?php exibirMensagem(); ?>
        
        <?php if (count($itens) > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Descrição</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($itens as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['titulo']); ?></td>
                                <td><?php echo htmlspecialchars($item['descricao']); ?></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($item['data_criacao'])); ?></td>
                                <td>
                                    <a href="editar_item.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                                    <a href="excluir_item.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">Você ainda não cadastrou nenhum livro.</div>
        <?php endif; ?>
    </div>
</body>
</html>