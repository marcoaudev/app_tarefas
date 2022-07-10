<?php 

class Conexao{
    private $host = 'localhost';
    private $dbname = 'app_lista';
    private $user = 'root';
    private $senha = '';
    
    public function conectar(){
        try{
    
            $conexao = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                "$this->user",
                "$this->senha"
            );
    
                return $conexao;
    
        } catch(PDOException $e){
            echo "Erro:". $e->getMessage();
        }
    }


}








?>