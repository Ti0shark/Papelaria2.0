<?php
    require "../../autoload.php";

    // Construir o objeto do Produto
    $produto = new Produto();
    $produto->setNome($_POST['nome_produto']);
    $produto->setQuantidade($_POST['quant_produto']);
    $produto->setPreco($_POST['preco']);
    $produto->setDescricao($_POST['descricao']);

    // Construir um objeto do Tipoproduto
    $tipoproduto = new Tipoproduto();
    $tipoproduto->setId($_POST['tipoproduto']);

    // Definir o tipoproduto (objeto da associação) na classe Produto
    $produto->setTipoproduto($tipoproduto);

    // Inserir no Banco de Dados
    $dao = new ProdutoDAO();
    $dao->create($produto);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: index.php');