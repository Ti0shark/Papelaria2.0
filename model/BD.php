<?php
    class BD {
        public static function getConexao() {
            $conn = new PDO(
                'mysql:host=localhost;dbname=papelaria', 
                'root', 
                'root'
            );

            return $conn;
        }
    }