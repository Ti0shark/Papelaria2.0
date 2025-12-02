<?php
    class ClienteDAO {
        public function create($cliente) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO cliente(nome_cliente, telefone) 
                     VALUES (:n, :t)"
                );
                $query->bindValue(':n',$cliente->getNome(), PDO::PARAM_STR);
                $query->bindValue(':t',$cliente->getTelefone(), PDO::PARAM_STR);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #1: " . $e->getMessage();
            }
        }

        public function read() {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM cliente");
                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $clientes = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    $cliente = new Cliente();
                    $cliente->setId($linha['id_cliente']);
                    $cliente->setNome($linha['nome_cliente']);
                    $cliente->setTelefone($linha['telefone']);

                    array_push($clientes,$cliente);
                }

                return $clientes;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }

        public function find($id) {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM cliente WHERE id_cliente = :i");
                $query->bindValue(':i',$id, PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());

                $linha = $query->fetch(PDO::FETCH_ASSOC);
                $cliente = new Cliente();
                $cliente->setId($linha['id_cliente']);
                $cliente->setNome($linha['nome_cliente']);
                $cliente->setTelefone($linha['telefone']);

                return $cliente;
            }
            catch(PDOException $e) {
                echo "Erro #3: " . $e->getMessage();
            }
        }

        public function update($cliente) {
            try {
                $query = BD::getConexao()->prepare(
                    "UPDATE cliente 
                     SET nome_cliente = :n , telefone = :t 
                     WHERE id_cliente = :i"
                );
                $query->bindValue(':n',$cliente->getNome(), PDO::PARAM_STR);
                $query->bindValue(':t',$cliente->getTelefone(), PDO::PARAM_STR);
                $query->bindValue(':i',$cliente->getId(), PDO::PARAM_INT);

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
                    "DELETE FROM cliente 
                     WHERE id_cliente = :i"
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