<?php
    require "../../autoload.php";

    // Construir o objeto do tipoproduto
    $tipoproduto = new Tipoproduto();
    $tipoproduto->setDescricao($_POST['descricao']);
    $tipoproduto->setId($_POST['id']);

    // Atualizar registro no Banco de Dados
    $dao = new TipoprodutoDAO();
    $dao->update($tipoproduto);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: index.php');