<?php
    class CompraDAO {
        public function create($compra) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO compra(data_compra,distribuidor_id_distribuidor) 
                     VALUES (:d, :t)"
                );
                $query->bindValue(':d',$compra->getData(), PDO::PARAM_STR);
                // Bind para a chave estrangeira
                $query->bindValue(':t',$compra->getDistribuidor()->getId(), PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #1: " . $e->getMessage();
            }
        }

        public function read() {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM compra");                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $compras = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    // Para a associação com o Distribuidor
                    $daoCompra = new DistribuidorDAO();
                    $distribuidor = $daoCompra->find($linha['distribuidor_id_distribuidor']);

                    // Construindo um objeto do Compra
                    $compra = new Compra();
                    $compra->setId($linha['id_compra']);
                    $compra->setData($linha['data_compra']);
                    // Definir o atributo (objeto) Distribuidor
                    $compra->setDistribuidor($distribuidor);

                    array_push($compras,$compra);
                }

                return $compras;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }
        
        public function find($id) {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM compra WHERE id_compra = :i");
                $query->bindValue(':i',$id,PDO::PARAM_INT);                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $linha = $query->fetch(PDO::FETCH_ASSOC);
                // Para a associação com o Distribuidor
                $daoCompra = new DistribuidorDAO();
                $distribuidor = $daoCompra->find($linha['distribuidor_id_distribuidor']);

                // Construindo um objeto da Compra
                $compra = new Compra();
                $compra->setId($linha['id_compra']);
                $compra->setData($linha['data_compra']);
                // Definir o atributo (objeto) Distribuidor
                $compra->setDistribuidor($distribuidor);

                return $compra;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }

        public function update($compra) {
            try {
                $query = BD::getConexao()->prepare(
                    "UPDATE compra 
                     SET data_compra = :d , distribuidor_id_distribuidor = :t
                     WHERE id_compra = :i"
                );
                $query->bindValue(':d',$compra->getData(), PDO::PARAM_STR);
                $query->bindValue(':i',$compra->getId(), PDO::PARAM_INT);
                $query->bindValue(':t',$compra->getDistribuidor()->getId(), PDO::PARAM_INT);

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
                    "DELETE FROM compra 
                     WHERE id_compra = :i"
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