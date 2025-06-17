<?php
require_once 'includes/conexao.php';
require_once 'includes/funcoes.php';

if (isset($_SESSION['usuario_id'])) {
    redirect('dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = sanitizar($_POST['login']);
    $email = sanitizar($_POST['email']);
    $senha = sanitizar($_POST['senha']);
    $confirmar_senha = sanitizar($_POST['confirmar_senha']);

    if (empty($login) || empty($email) || empty($senha) || empty($confirmar_senha)) {
        redirect('cadastro.php', 'erro', 'Todos os campos são obrigatórios');
    }

    if ($senha !== $confirmar_senha) {
        redirect('cadastro.php', 'erro', 'As senhas não coincidem');
    }

    if (strlen($senha) < 6) {
        redirect('cadastro.php', 'erro', 'A senha deve ter pelo menos 6 caracteres');
    }

    if (verificarExistenciaUsuario($pdo, $login, $email)) {
        redirect('cadastro.php', 'erro', 'Login ou email já cadastrado');
    }

    try {
        $hash_senha = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO usuarios (login, email, senha) VALUES (?, ?, ?)");
        $stmt->execute([$login, $email, $hash_senha]);
        
        redirect('index.php', 'sucesso', 'Cadastro realizado com sucesso! Faça login para continuar');
    } catch (PDOException $e) {
        redirect('cadastro.php', 'erro', 'Erro ao cadastrar usuário');
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Sistema de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-4">Cadastro</h1>
                <?php exibirMensagem(); ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="login" class="form-label">Login</label>
                        <input type="text" class="form-control" id="login" name="login" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmar_senha" class="form-label">Confirmar Senha</label>
                        <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                </form>
                <div class="mt-3 text-center">
                    Já tem conta? <a href="index.php">Faça login</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>