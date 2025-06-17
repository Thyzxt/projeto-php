<?php
require_once 'includes/conexao.php';
require_once 'includes/funcoes.php';
verificaLogin();

if(!isset($_GET['id'])){
    header('Location: itens.php');
    exit();}

$produto_id = $_GET['id'];
$usuario_id = $_SESSION['usuario_id'];

try{
    $stmt = $pdo->prepare("SELECT id FROM itens WHERE id = ? AND usuario_id = ?");
    $stmt->execute([$produto_id, $usuario_id]);
    
    if($stmt->rowCount() === 1){
        $stmt = $pdo->prepare("DELETE FROM itens WHERE id = ?");
        $stmt->execute([$produto_id]);
        
        $_SESSION['sucesso'] = 'Produto excluído com sucesso!';} 
        
    else{
        $_SESSION['erro'] = 'Produto não encontrado ou você não tem permissão para excluí-lo.';}} 
        
    catch (PDOException $e){
        $_SESSION['erro'] = 'Erro ao excluir produto: ' . $e->getMessage();}

header('Location: itens.php');
exit();
?>