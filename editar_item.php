<?php
require_once 'includes/conexao.php';
require_once 'includes/funcoes.php';
verificaLogin();

if(!isset($_GET['id'])){
    redirect('itens.php');}

$item_id = $_GET['id'];
$usuario_id = $_SESSION['usuario_id'];

try{
    $stmt = $pdo->prepare("SELECT * FROM itens WHERE id = ? AND usuario_id = ?");
    $stmt->execute([$item_id, $usuario_id]);
    $item = $stmt->fetch();
    
    if (!$item){
        redirect('itens.php', 'erro', 'Livro não encontrado ou você não tem permissão para editá-lo');}} 
        
    catch(PDOException $e){
            
        redirect('itens.php', 'erro', 'Erro ao carregar livro');}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $titulo = sanitizar($_POST['titulo']);
    $descricao = sanitizar($_POST['descricao']);

    if(empty($titulo)){
        redirect("editar_item.php?id=$item_id", 'erro', 'O título é obrigatório');}

    try{
        $stmt = $pdo->prepare("UPDATE itens SET titulo = ?, descricao = ? WHERE id = ?");
        $stmt->execute([$titulo, $descricao, $item_id]);
        
        redirect('itens.php', 'sucesso', 'Livro atualizado com sucesso!');} 
        
    catch(PDOException $e){
        redirect("editar_item.php?id=$item_id", 'erro', 'Erro ao atualizar livro');}}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto - Sistema de Livros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
</head>
<body>
    
    
    <div class="container mt-5">
        <h1>Editar Livro</h1>
        
        <?php exibirMensagem(); ?>
        
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título*</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($item['titulo']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3"><?php echo htmlspecialchars($item['descricao']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="itens.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>