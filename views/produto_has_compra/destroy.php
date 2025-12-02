<?php
    require "../../autoload.php";

    // Excluir do Banco de Dados
    $dao = new ProdutoCompraDAO();
    $dao->destroy($_GET['idProduto'],$_GET['idCompra']);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: create.php?id=' . $_GET['idProduto']);