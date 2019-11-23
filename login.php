<?php 
    include 'includes/header.php';

    // if ($salvou) {
    //     header(location:)
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center">
        <h5 class="mb-4 text-center mt-4">Login</h5>
        <form action="POST">
            <div class="form-group">
                <label for="email">Endereço de e-mail</label>
                <input style="width:500px;" name="email" type="email" class="form-control" placeholder="Insira seu e-mail">
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input name="senha" type="password" class="form-control" placeholder="Insira a senha">
            </div>
            <button type="submit" class="btn btn-dark col-12 mt-3">Entrar</button>
        </form>
    </div>
</body>
</html>