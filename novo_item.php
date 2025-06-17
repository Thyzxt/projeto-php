<?php
require_once 'includes/conexao.php';
require_once 'includes/funcoes.php';
verificaLogin();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $titulo = sanitizar($_POST['titulo']);
    $descricao = sanitizar($_POST['descricao']);
    $usuario_id = $_SESSION['usuario_id'];

    if(empty($titulo)){
        redirect('novo_item.php', 'erro', 'O título é obrigatório');}

    try{
        $stmt = $pdo->prepare("INSERT INTO itens (usuario_id, titulo, descricao) VALUES (?, ?, ?)");
        $stmt->execute([$usuario_id, $titulo, $descricao]);
        
        redirect('itens.php', 'sucesso', 'Produto cadastrado com sucesso!');} 
        
    catch(PDOException $e){
        redirect('novo_item.php', 'erro', 'Erro ao cadastrar produto');}}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Produto - Sistema de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Adicionar Novo Livro</h1>
        
        <?php exibirMensagem(); ?>
        
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título*</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="itens.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>