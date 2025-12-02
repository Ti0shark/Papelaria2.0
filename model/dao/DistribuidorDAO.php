<?php
    class DistribuidorDAO {
        public function create($distribuidor) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO distribuidor(cnpj, endereco, telefone) 
                     VALUES (:c, :e, :t)"
                );
                $query->bindValue(':c',$distribuidor->getCnpj(), PDO::PARAM_STR);
                $query->bindValue(':e',$distribuidor->getEndereco(), PDO::PARAM_STR);
                $query->bindValue(':t',$distribuidor->getTelefone(), PDO::PARAM_STR);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #1: " . $e->getMessage();
            }
        }

        public function read() {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM distribuidor");
                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $distribuidores = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    $distribuidor = new Distribuidor();
                    $distribuidor->setId($linha['id_distribuidor']);
                    $distribuidor->setCnpj($linha['cnpj']);
                    $distribuidor->setEndereco($linha['endereco']);
                    $distribuidor->setTelefone($linha['telefone']);

                    array_push($distribuidores,$distribuidor);
                }

                return $distribuidores;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }

        public function find($id) {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM distribuidor WHERE id_distribuidor = :i");
                $query->bindValue(':i',$id, PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());

                $linha = $query->fetch(PDO::FETCH_ASSOC);
                
                $distribuidor = new Distribuidor();
                $distribuidor->setId($linha['id_distribuidor']);
                $distribuidor->setCnpj($linha['cnpj']);
                $distribuidor->setEndereco($linha['endereco']);
                $distribuidor->setTelefone($linha['telefone']);

                return $distribuidor;
            }
            catch(PDOException $e) {
                echo "Erro #3: " . $e->getMessage();
            }
        }

        public function update($distribuidor) {
            try {
                $query = BD::getConexao()->prepare(
                    "UPDATE distribuidor 
                     SET cnpj = :c , endereco = :e, telefone = :t 
                     WHERE id_distribuidor = :i"
                );
                $query->bindValue(':c',$distribuidor->getCnpj(), PDO::PARAM_STR);
                $query->bindValue(':e',$distribuidor->getEndereco(), PDO::PARAM_STR);
                $query->bindValue(':t',$distribuidor->getTelefone(), PDO::PARAM_STR);
                $query->bindValue(':i',$distribuidor->getId(), PDO::PARAM_INT);

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
                    "DELETE FROM distribuidor 
                     WHERE id_distribuidor = :i"
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