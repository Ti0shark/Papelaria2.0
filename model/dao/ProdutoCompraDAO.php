<?php
    class ProdutoCompraDAO {
        public function create($produtoCompra) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO produto_has_compra(Produto_id_produto, compra_id_compra) 
                     VALUES (:p, :c)"
                );
                
                // Bind para as chaves estrangeiras
                $query->bindValue(':p',$produtoCompra->getProduto()->getId(), PDO::PARAM_INT);
                $query->bindValue(':c',$produtoCompra->getCompra()->getId(), PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #1: " . $e->getMessage();
            }
        }

        // Método read deverá filtrar produtos a partir de um id de compra
        public function read($idCompra) {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM produto_has_compra WHERE Produto_id_compra = :c");
                $query->bindValue(':c',$idCompra, PDO::PARAM_INT);                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $produtoCompras = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    // Para a associação com o Produto
                    $daoProduto = new ProdutoDAO();
                    $produto = $daoProduto->find($linha['Produto_id_produto']);  
                    $compra = new Compra();
                    $compra->setId($idCompra);                  

                    // Construindo um objeto do compra
                    $produtoCompra = new ProdutoCompra();
                    $produtoCompra->setProduto($produto);                    
                    $produtoCompra->setCompra($compra);

                    array_push($produtoCompras,$produtoCompra);
                }

                return $produtoCompras;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }

        // Método destroy irá apagar um registro a partir da combinação das duas chaves primárias
        public function destroy($idProduto, $idCompra) {
            try {
                $query = BD::getConexao()->prepare(
                    "DELETE FROM produto_has_compra 
                     WHERE id_produto = :p and id_compra = :c"
                );
                $query->bindValue(':p',$idProduto, PDO::PARAM_INT);
                $query->bindValue(':c',$idCompra, PDO::PARAM_INT);
                
                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #5: " . $e->getMessage();
            }
        }
    }