<?php
    class ProdutoDAO {
        public function create($produto) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO produto(nome_produto,quant_produto,preco,descricao,tipoproduto_id_tipoproduto) 
                     VALUES (:n, :q, :p, :d, :t)"
                );
                $query->bindValue(':n',$produto->getNome(), PDO::PARAM_STR);
                $query->bindValue(':q',$produto->getQuantidade(), PDO::PARAM_STR);
                $query->bindValue(':p',$produto->getPreco(), PDO::PARAM_STR);
                $query->bindValue(':d',$produto->getDescricao(), PDO::PARAM_STR);
                // Bind para a chave estrangeira
                $query->bindValue(':t',$produto->getTipoproduto()->getId(), PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #1: " . $e->getMessage();
            }
        }

        public function read() {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM produto");                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $produtos = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    // Para a associação com o Tipoproduto
                    $daoProduto = new TipoprodutoDAO();
                    $tipoproduto = $daoProduto->find($linha['tipoproduto_id_tipoproduto']);

                    // Construindo um objeto do Produto
                    $produto = new Produto();
                    $produto->setId($linha['id_produto']);
                    $produto->setNome($linha['nome_produto']);
                    $produto->setQuantidade($linha['quant_produto']);
                    $produto->setPreco($linha['preco']);
                    $produto->setDescricao($linha['descricao']);
                    // Definir o atributo (objeto) Tipoproduto
                    $produto->setTipoproduto($tipoproduto);

                    array_push($produtos,$produto);
                }

                return $produtos;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }
        
        public function find($id) {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM produto WHERE id_produto = :i");
                $query->bindValue(':i',$id,PDO::PARAM_INT);                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $linha = $query->fetch(PDO::FETCH_ASSOC);
                // Para a associação com o Tipoproduto
                $daoProduto = new TipoprodutoDAO();
                $tipoproduto = $daoProduto->find($linha['tipoproduto_id_tipoproduto']);

                // Construindo um objeto do Produto
                $produto = new Produto();
                $produto->setId($linha['id_produto']);
                $produto->setNome($linha['nome_produto']);
                $produto->setQuantidade($linha['quant_produto']);
                $produto->setPreco($linha['preco']);
                $produto->setDescricao($linha['descricao']);
                // Definir o atributo (objeto) Tipoproduto
                $produto->setTipoproduto($tipoproduto);

                return $produto;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }

        public function update($produto) {
            try {
                $query = BD::getConexao()->prepare(
                    "UPDATE produto 
                     SET nome_produto = :n , quant_produto = :q, preco = :p, descricao = :d
                     WHERE id_produto = :i"
                );
                $query->bindValue(':n',$produto->getNome(), PDO::PARAM_STR);
                $query->bindValue(':q',$produto->getQuantidade(), PDO::PARAM_STR);
                $query->bindValue(':p',$produto->getPreco(), PDO::PARAM_STR);
                $query->bindValue(':d',$produto->getDescricao(), PDO::PARAM_STR);
                $query->bindValue(':i',$produto->getId(), PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #4: " . $e->getMessage();
            }
        }

        public function destroy($id) {
            try {
                $query = BD::getConexao()->prepare(
                    "DELETE FROM produto 
                     WHERE id_produto = :i"
                );
                $query->bindValue(':i',$id, PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #5: " . $e->getMessage();
            }
        }
    }