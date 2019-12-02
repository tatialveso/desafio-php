<?php
    include('./includes/validacoes.php');
    include('./includes/header.php');

    include('./includes/dbc.php');

    $query = $dbc->prepare("SELECT
                                id,
                                nome
                            FROM usuarios;");
    $query->execute();
    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

    $nomeCorreto = true;
    $emailCorreto = true;
    $senhaCorreta = true;

    if ($_POST) {
        
        $nomeCorreto = checarNome($_POST['nome']);

        $nome = $_POST['nome'];

        $emailCorreto = checarEmail($_POST['email']);

        $email = $_POST['email'];

        $senhaCorreta = checarSenha($_POST['senha']);

        $senha = $_POST['senha'];

    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro Usuário</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h5 class="mb-4 text-center mt-4">Usuários cadastrados</h5>
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>NOME DO USUÁRIO</th>
                                    <th>AÇÕES</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($usuarios as $usuario) : ?>
                                <tr>
                                    <td class="text-center"><?= $usuario['nome'] ?></td>
                                    <td class="text-center">
                                        <a href="editUsuario.php?id=<?=$usuario['id']?>"><button class="btn btn-dark">Editar</button></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
            </div>

            <div class="col-6">
                <main class="d-flex flex-column justify-content-center align-items-center">
                    <h5 class="mb-4 text-center mt-4">Cadastro do usuário</h5>
                    <form method="POST">
                        <div class="form-group">
                            <label for="nome">Nome completo</label>
                            <input name="nome" style="width: 500px;" class="form-control <?php if(!$nomeCorreto) { echo ('is-invalid');} ?>" type="text" placeholder="Insira seu nome completo">
                            <?php if (!$nomeCorreto) : ?>
                                <div class="invalid-feedback">
                                    O nome precisa ter no mínimo três caracteres.
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label for="email">Endereço de e-mail</label>
                            <input name="email" type="email" class="form-control <?php if(!$emailCorreto) { echo ('is-invalid');} ?>" placeholder="Insira seu e-mail">
                            <?php if (!$emailCorreto) : ?>
                                <div class="invalid-feedback">
                                    O e-mail é obrigatório.
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input name="senha" type="password" class="form-control <?php if(!$senhaCorreta) { echo ('is-invalid');} ?>" placeholder="Insira a senha">
                            <?php if (!$senhaCorreta) : ?>
                                <div class="invalid-feedback">
                                    A senha precisa ter no mínimo seis caracteres e deve conter números e letras.
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label for="senha">Confirme a senha</label>
                            <input name="senhaConfirmada" type="password" class="form-control" placeholder="Insira a senha novamente">
                        </div>
                        <a href="">
                            <button type="submit" class="btn btn-dark col-12 mt-3">Cadastrar</button>
                        </a>
                    </form>
                </main>
            </div>
        </div>
    </div>
</body>
</html>