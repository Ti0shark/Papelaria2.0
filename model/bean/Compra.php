<?php
    class Compra {
        // Atributos
        private $id;
        private $data;
        private $distribuidor; // Associação com a classe TipoProduto

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
        public function getDistribuidor() {
            return $this->distribuidor;
        }

        public function setDistribuidor($distribuidor) {
            $this->distribuidor = $distribuidor;
        }

        // Método para retornar uma string do objeto
        public function __toString() {
            return $this->data;
        }
    }