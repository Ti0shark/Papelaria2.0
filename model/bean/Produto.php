<?php
    class Produto {
        // Atributos
        private $id;
        private $nome;
        private $quantidade;
        private $preco;
        private $descricao;
        private $tipoproduto; // Associação com a classe TipoProduto

        // Métodos
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getNome() {
            return $this->nome;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function getQuantidade() {
            return $this->quantidade;
        }

        public function setQuantidade($quantidade) {
            $this->quantidade = $quantidade;
        }

        public function getPreco() {
            return $this->preco;
        }

        public function setPreco($preco) {
            $this->preco = $preco;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function setDescricao($descricao) {
            $this->descricao = $descricao;
        }
        
        // Get e set do atributo que faz associação (normal)
        public function getTipoproduto() {
            return $this->tipoproduto;
        }

        public function setTipoproduto($tipoproduto) {
            $this->tipoproduto = $tipoproduto;
        }

        // Método para retornar uma string do objeto
        public function __toString() {
            return $this->descricao;
        }
    }