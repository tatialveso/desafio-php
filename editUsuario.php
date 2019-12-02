<?php 
    session_start();
    
    include './includes/header.php';
    include './includes/dbc.php';

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

    if ($_POST) {
        
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $query = $dbc->prepare("UPDATE
                                    usuarios
                                SET
                                    nome = :nome,
                                    email = :email
                                WHERE id = :id;");
        $query->execute([':id' => $id,
                        ':nome' => $nome,
                        ':email' => $email,
                        ':senha' => $senha]);

        header('Location: createUsuario.php');

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
                <input name="nome" class="form-control" type="text" value="<?= $usuario['nome'] ?>">
            </div>
            <div class="form-group">
                <label for="email">Endereço de e-mail</label>
                <input name="email" type="email" class="form-control" value="<?= $usuario['email'] ?>">
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input name="senha" type="password" class="form-control" value="<?= $usuario['senha'] ?>">
            </div>
            <div class="form-group">
                <label for="senha">Confirme a senha</label>
                <input name="senhaConfirmada" type="password" class="form-control" placeholder="Insira a senha novamente">
            </div>

                <input type="hidden" name="id" value="<?= $id ?>">

                <button type="submit" class="btn btn-dark col-12 mt-3">Atualizar cadastro</button>
        </form>
    </div>
</body>
</html>