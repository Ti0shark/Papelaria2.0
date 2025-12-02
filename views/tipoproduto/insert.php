<?php
    require "../../autoload.php";

    // Construir o objeto do Tipo de PRroduto
    $tipoproduto = new Tipoproduto();
    $tipoproduto->setDescricao($_POST['descricao']);

    // Inserir no Banco de Dados
    $dao = new TipoprodutoDAO();
    $dao->create($tipoproduto);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: index.php');