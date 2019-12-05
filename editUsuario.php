<?php 
    session_start();
    
    include './includes/header.php';
    include './includes/dbc.php';
    include './includes/validacoes.php';

    $id = $_GET['id'];

    $query = $dbc->prepare("SELECT
                                id,
                                nome,
                                email,
                                senha
                            FROM usuarios
                            WHERE id = :id;");
    $query->execute([':id' => $id]);
    $usuario = $query->fetchAll(PDO::FETCH_ASSOC)[0];

    $nomeCorreto = true;
    $emailCorreto = true;
    $senhaCorreta = true;
    $senhaConfirmadaCorreta = true;

    if ($_POST) {

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $senhaConfirmada = $_POST['senhaConfirmada'];

        $usuario['nome'] = $_POST['nome'];
        $usuario['email'] = $_POST['email'];
        $usuario['senha'] = $_POST['senha'];

        $nomeCorreto = checarNome($_POST['nome']);
        $emailCorreto = checarEmail($_POST['email']);
        $senhaCorreta = checarSenha($_POST['senha']);
        
        if ($senha != $senhaConfirmada) {
            $senhaConfirmadaCorreta = false;
        }

        if ($nomeCorreto && $emailCorreto && $senhaCorreta && $senhaConfirmadaCorreta) {
            $query = $dbc->prepare("UPDATE
                                        usuarios
                                    SET
                                        nome = :nome,
                                        email = :email,
                                        senha = :senha
                                    WHERE id = :id;");
            $funcionou = $query->execute([':id' => $id,
                        ':nome' => $nome,
                        ':email' => $email,
                        ':senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT)]);

            if ($funcionou) {
                header('Location: createUsuario.php');
            } else {
                print_r($query->errorInfo());
                die();
            }   
        }          
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center">
        <h5 class="mb-4 text-center mt-4">Editar usuário</h5>
        <form class="col-6" method="POST">
            <div class="form-group">
                <label for="nome">Nome completo</label>
                <input name="nome" class="form-control <?php if(!$nomeCorreto) { echo ('is-invalid');} ?>" type="text" value="<?= $usuario['nome'] ?>">
                <?php if (!$nomeCorreto) : ?>
                    <div class="invalid-feedback">
                        O nome precisa ter no mínimo três caracteres.
                    </div>
                <?php endif ?>
            </div>
            <div class="form-group">
                <label for="email">Endereço de e-mail</label>
                <input name="email" type="email" class="form-control <?php if(!$emailCorreto) { echo ('is-invalid');} ?>" value="<?= $usuario['email'] ?>">
                <?php if (!$emailCorreto) : ?>
                    <div class="invalid-feedback">
                        O e-mail é obrigatório.
                    </div>
                <?php endif ?>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input name="senha" type="password" class="form-control <?php if(!$senhaCorreta) { echo ('is-invalid');} ?>" value="<?= $usuario['senha'] ?>">
                <?php if (!$senhaCorreta) : ?>
                    <div class="invalid-feedback">
                        A senha precisa ter no mínimo seis caracteres e deve conter números e letras.
                    </div>
                <?php endif ?>
            </div>
            <div class="form-group">
                <label for="senha">Confirme a senha</label>
                <input name="senhaConfirmada" type="password" class="form-control <?php if(!$senhaConfirmadaCorreta) { echo ('is-invalid');} ?>" placeholder="Insira a senha novamente">
                <?php if (!$senhaConfirmadaCorreta) : ?>
                    <div class="invalid-feedback">
                        As senhas não coincidem.
                    </div>
                <?php endif ?>
            </div>

            <input type="hidden" name="id" value="<?= $id ?>">

            <button type="submit" class="btn btn-dark col-12 mt-3">Atualizar cadastro</button>
        </form>

        <form method="POST" action="./includes/deleteUsuario.php">
            <input type="hidden" value="<?= $id ?>" name="id">
            <input class="btn btn-secondary mt-4" type="submit" value="Excluir cadastro">
        </form>
    </div>
</body>
</html>