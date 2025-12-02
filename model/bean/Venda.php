<?php
    class Venda {
        // Atributos
        private $id;
        private $data;
        private $cliente; // Associação com a classe Cliente

        // Métodos
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getData() {
            return $this->data;
        }

        public function setData($data) {
            $this->data= $data;
        }
        
        // Get e set do atributo que faz associação (normal)
        public function getCliente() {
            return $this->cliente;
        }

        public function setCliente($cliente) {
            $this->cliente = $cliente;
        }

        // Método para retornar uma string do objeto
        public function __toString() {
            return $this->data;
        }
    }