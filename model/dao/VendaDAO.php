<?php
    class VendaDAO {
        public function create($venda) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO venda(data_venda,cliente_id_cliente) 
                     VALUES (:d, :c)"
                );
                $query->bindValue(':d',$venda->getData(), PDO::PARAM_STR);
                // Bind para a chave estrangeira
                $query->bindValue(':c',$venda->getCliente()->getId(), PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #1: " . $e->getMessage();
            }
        }

        public function read() {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM venda");                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $vendas = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    // Para a associação com o IdCliente
                    $daoVenda = new ClienteDAO();
                    $cliente = $daoVenda->find($linha['cliente_id_cliente']);

                    // Construindo um objeto da Venda
                    $venda = new Venda();
                    $venda->setId($linha['id_venda']);
                    $venda->setData($linha['data_venda']);
                    // Definir o atributo (objeto) Cliente
                    $venda->setCliente($cliente);

                    array_push($vendas,$venda);
                }

                return $vendas;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }
        
        public function find($id) {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM venda WHERE id_venda = :i");
                $query->bindValue(':i',$id,PDO::PARAM_INT);                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $linha = $query->fetch(PDO::FETCH_ASSOC);
                // Para a associação com Cliente
                $daoVenda = new ClienteDAO();
                $cliente = $daoVenda->find($linha['cliente_id_cliente']);

                // Construindo um objeto da Venda
                $venda = new Venda();
                $venda->setId($linha['id_venda']);
                $venda->setData($linha['data_venda']);
                // Definir o atributo (objeto) Cliente
                $venda->setCliente($cliente);

                return $venda;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }

        public function update($venda) {
            try {
                $query = BD::getConexao()->prepare(
                    "UPDATE venda 
                     SET data_venda = :d , cliente_id_cliente = :c
                     WHERE id_venda = :i"
                );
                $query->bindValue(':d',$venda->getData(), PDO::PARAM_STR);
                $query->bindValue(':i',$venda->getId(), PDO::PARAM_INT);
                $query->bindValue(':c',$venda->getCliente()->getId(), PDO::PARAM_INT);

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
                    "DELETE FROM venda 
                     WHERE id_venda = :i"
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