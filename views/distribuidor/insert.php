<?php
    require "../../autoload.php";

    // Construir o objeto do Distribuidor
    $distribuidor = new Distribuidor();
    $distribuidor->setCnpj($_POST['cnpj']);
    $distribuidor->setEndereco($_POST['endereco']);
    $distribuidor->setTelefone($_POST['telefone']);

    // Inserir no Banco de Dados
    $dao = new DistribuidorDAO();
    $dao->create($distribuidor);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: index.php');