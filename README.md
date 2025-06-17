# Sistema de Gerenciamento de Livros

Um aplicativo web em PHP para gerenciar sua coleção de livros.

<br>

Alunos: Thyago Almeida Paulo e Rafael Fernandes

## Visão Geral

Este sistema permite que usuários cadastrados:
* **Façam Login/Cadastro**: Acessem a plataforma com segurança.
* **Gerenciem Livros**: Adicionem, visualizem, editem e excluam livros.
* **Controle de Acesso**: Cada usuário gerencia apenas seus próprios livros.

Desenvolvido com PHP, MySQL/MariaDB e Bootstrap.

## Acesso de Teste

Após a instalação, cadastre um novo usuário pelo próprio sistema.
* **Exemplo de Credenciais (após cadastro):**
    * **Login:** `teste`
    * **Senha:** `123456`
    * **Email:** `teste@example.com`

## Instalação Rápida

1.  **Servidor Web**: Tenha XAMPP (ou similar) instalado e com os módulos Apache e MySQL/MariaDB **iniciados**.

2.  **Banco de Dados**:
    * Acesse `http://localhost/phpmyadmin/`.
    * Na aba "SQL", execute o conteúdo do arquivo `criar_banco.sql`.
    * **Problemas no phpMyAdmin?** Se a conexão falhar, edite `C:\xampp\phpMyAdmin\config.inc.php` e garanta que `$cfg['Servers'][$i]['port']` esteja como `3306`.

3.  **Configuração da Aplicação**:
    * Edite `includes/conexao.php`.
    * Verifique se `$username` é `root` e `$password` é `''` (vazio) ou a senha do seu MySQL.

4.  **Executar**:
    * Copie todos os arquivos do projeto para `C:\xampp\htdocs\sistema_livros\` (ou equivalente).
    * Abra `http://localhost/sistema_livros/index.php` no seu navegador.
