<?php
    class ProdutoCompra {
        // Atributos
        private $compra; // Associação com a classe Compra
        private $produto; // Associação com a classe Produto

        // Métodos
        public function getCompra() {
            return $this->compra;
        }

        public function setCompra($compra) {
            $this->compra = $compra;
        }

        public function getProduto() {
            return $this->produto;
        }

        public function setProduto($produto) {
            $this->produto = $produto;
        }

    }