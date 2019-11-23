<?php

    include('./includes/dbc.php');

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
    <title><?= $produto['nome'] ?></title>
</head>
<body>
    <main class="container">
        <h2><?= $produto['nome']?></h2>
        <img src="./assets/img/uploads/<?= $id_filme ?>.png" alt="...">
		
        <section>
			<div>
				<h5>Descrição do produto</h5>
				<div><?= $produto['descricao']?></div>
			</div>

			<div>
				<h5>Preço</h5>
				<div><?= $produto['preco']?></div>
			</div>
			
			<div>
                <a href="#" class="btn btn-primary">Excluir produto</a>
			</div>
		</section>
    </main>
</body>
</html>