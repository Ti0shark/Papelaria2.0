<?php
    require "../../autoload.php";

    
    // Construir um objeto do Produto
    $produto = new Produto();
    $produto->setId($_POST['id']);
    
    // Construir um objeto do Produto
    $compra = new Compra();
    $compra->setId($_POST['compra']);

    // Definir o compra e Produto (objetos das associações) na classe CompraProduto
    $produtoCompra->setCompra($compra);
    $produtoCompra->setProduto($produto);

    // Inserir no Banco de Dados
    $dao = new ProdutoCompraDAO();
    $dao->create($produtoCompra);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: create.php?id=' . $produto->getId());