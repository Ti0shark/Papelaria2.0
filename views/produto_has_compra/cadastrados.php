<?php
    require "../../autoload.php";

    $dao = new ProdutoCompraDAO();
?>

<h2>Tabela de Cadastrados</h2>
<table class="table table-hover">
    <tr>
        <th>ID do Produto</th>
        
    </tr>
    <?php foreach($dao->read($idCompra) as $compraProduto) : ?>
        <tr>
            <td><?= $produtoCompra->getCompra()->getId() ?></td>
            <td><?= $produtoCompra->getProduto() ?></td>
            <td>
                <a class="link link-danger" href="destroy.php?idCompra=<?= $idCompra ?>&idProduto=<?= $compraProduto->getProduto()->getId() ?>" title="Excluir">
                    <i class="bi bi-trash"></i>
                </a>
            </td>
        </tr>
    <?php endforeach ?>

</table>