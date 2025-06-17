<?php
require_once 'includes/conexao.php';
require_once 'includes/funcoes.php';

session_unset();
session_destroy();

redirect('index.php', 'sucesso', 'Você saiu do sistema com sucesso');
?>