<?php
require_once 'includes/conexao.php';
require_once 'includes/funcoes.php';

if(isset($_SESSION['usuario_id'])){
    redirect('dashboard.php');}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $login = sanitizar($_POST['login']);
    $senha = sanitizar($_POST['senha']);

    if(empty($login) || empty($senha)){
        redirect('index.php', 'erro', 'Preencha todos os campos');}

    try{
        $stmt = $pdo->prepare("SELECT id, login, senha FROM usuarios WHERE login = ?");
        $stmt->execute([$login]);
        $usuario = $stmt->fetch();

        if($usuario && password_verify($senha, $usuario['senha'])){
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_login'] = $usuario['login'];
            redirect('dashboard.php', 'sucesso', 'Login realizado com sucesso!');} 
            
        else{
            redirect('index.php', 'erro', 'Login ou senha incorretos');}} 
            
        catch(PDOException $e){
            redirect('index.php', 'erro', 'Erro ao realizar login');}}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Livros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-4">Login</h1>
                <?php exibirMensagem(); ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="login" class="form-label">Login</label>
                        <input type="text" class="form-control" id="login" name="login" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </form>
                <div class="mt-3 text-center">
                    Não tem conta? <a href="cadastro.php">Cadastre-se</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>