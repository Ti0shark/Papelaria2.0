<?php
    require "../../autoload.php";

    // Construir o objeto da Compra
    $compra = new Compra();
    $compra->setData($_POST['data_compra']);
    $compra->setId($_POST['id']);

    // Construir um objeto do Distribuidor
    $distribuidor = new Distribuidor();
    $distribuidor->setId($_POST['distribuidor']);

    // Definir o distribuidor (objeto da associação) na classe Compra
    $compra->setDistribuidor($distribuidor);

    // Atualizar registro no Banco de Dados
    $dao = new CompraDAO();
    $dao->update($compra);

    // Redirecionar para o index (Comentar quando não funcionar)
     header('Location: index.php');