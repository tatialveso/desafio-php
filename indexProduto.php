<?php include('./createProduto.php') ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Nome do produto</th>
                <th>Descrição</th>
                <th>Preço</th>
            <tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto) : ?>
            <tr>
                <td><?= $produto['nome'] ?></td>
                <td><?= $produto['descricao'] ?></td>
                <td><?= $produto['preco'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>