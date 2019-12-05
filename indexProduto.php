<?php
    session_start();

    include './includes/dbc.php';
    include './includes/header.php';

    $query = $dbc->prepare("SELECT *
                                FROM produtos;");
    $query->execute();
    $produtos = $query->fetchAll(PDO::FETCH_ASSOC);

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
    <main class="container">
        <h5 class="mb-4 text-center mt-4">Produtos cadastrados</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME DO PRODUTO</th>
                    <th>DESCRIÇÃO</th>
                    <th>PREÇO</th>
                    <th>AÇÃO</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto) : ?>
                    <tr>
                        <td><?= $produto['id'] ?></td>
                        <td><?= $produto['nome'] ?></td>
                        <td><?= $produto['descricao'] ?></td>
                        <td><?= $produto['preco'] ?></td>
                        <td><a href="showProduto.php?id=<?= $produto['id'] ?>" class="btn btn-dark">Ver produto</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>