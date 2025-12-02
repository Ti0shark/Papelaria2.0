<?php
    class TipoprodutoDAO {
        public function create($tipoProduto) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO tipoproduto(descricao) 
                     VALUES (:d)"
                );
                $query->bindValue(':d',$tipoProduto->getDescricao(), PDO::PARAM_STR);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #1: " . $e->getMessage();
            }
        }

        public function read() {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM tipoproduto");
                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $tipoprodutos = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    $tipoproduto = new Tipoproduto();
                    $tipoproduto->setId($linha['id_tipoproduto']);
                    $tipoproduto->setDescricao($linha['descricao']);

                    array_push($tipoprodutos,$tipoproduto);
                }

                return $tipoprodutos;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }

        public function find($id) {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM tipoproduto WHERE id_tipoproduto = :i");
                $query->bindValue(':i',$id, PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());

                $linha = $query->fetch(PDO::FETCH_ASSOC);
                $tipoproduto = new Tipoproduto();
                $tipoproduto->setId($linha['id_tipoproduto']);
                $tipoproduto->setDescricao($linha['descricao']);

                return $tipoproduto;
            }
            catch(PDOException $e) {
                echo "Erro #3: " . $e->getMessage();
            }
        }

        public function update($tipoproduto) {
            try {
                $query = BD::getConexao()->prepare(
                    "UPDATE tipoproduto 
                     SET descricao = :d 
                     WHERE id_tipoproduto = :i"
                );
                $query->bindValue(':d',$tipoproduto->getDescricao(), PDO::PARAM_STR);
                $query->bindValue(':i',$tipoproduto->getId(), PDO::PARAM_INT);

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
                    "DELETE FROM tipoproduto
                     WHERE id_tipoproduto = :i"
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