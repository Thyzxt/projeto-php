<?php
function sanitizar($dado) {
    return htmlspecialchars(strip_tags(trim($dado)));
}

function redirect($url, $tipo = null, $mensagem = null) {
    if ($tipo && $mensagem) {
        $_SESSION[$tipo] = $mensagem;
    }
    header("Location: $url");
    exit();
}

function exibirMensagem() {
    if (isset($_SESSION['sucesso'])) {
        echo '<div class="alert alert-success">' . $_SESSION['sucesso'] . '</div>';
        unset($_SESSION['sucesso']);
    }
    if (isset($_SESSION['erro'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['erro'] . '</div>';
        unset($_SESSION['erro']);
    }
}

function verificarExistenciaUsuario($pdo, $login, $email) {
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE login = ? OR email = ?");
    $stmt->execute([$login, $email]);
    return $stmt->fetch();
}
?>