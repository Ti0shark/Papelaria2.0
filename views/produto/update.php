<?php
    require "../../autoload.php";

    // Construir o objeto do Produto
    $produto = new Produto();
    $produto->setNome($_POST['nome_produto']);
    $produto->setQuantidade($_POST['quant_produto']);
    $produto->setPreco($_POST['preco']);
    $produto->setDescricao($_POST['descricao']);
    $produto->setId($_POST['id']);

    // Construir um objeto do Tipoproduto
    $tipoproduto = new Tipoproduto();
    $tipoproduto->setId($_POST['tipo_produto']);

    // Definir o tipoproduto (objeto da associação) na classe Produto
    $produto->setTipoproduto($tipoproduto);

    // Atualizar registro no Banco de Dados
    $dao = new ProdutoDAO();
    $dao->update($produto);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: index.php');